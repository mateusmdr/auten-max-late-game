import { defineStore } from 'pinia';
import {parse, format} from 'date-format-parse';
import {func} from '../../func';
import axios from 'axios';

// Tournaments
const useTournamentStore = defineStore('tournament', {
    state: () => ({
        tournaments: [],
        errors: [],
        enabledTournaments: [],
    }),
    actions: {
        refresh() {
            axios
                .get('/api/tournament')
                .then((res) => {
                    this.tournaments = res.data.data;
                    this.enabledTournaments = res.data.data.filter(item => item.isNotifiable);
                    this.errors = res.data.errors;
                })
                .then(() => {
                    this.tournaments = this.tournaments.map(tournament =>{
                        const subscription = tournament.subscription.split(' ');
                        let begin = parse(subscription[0], 'HH:mm')
                        let end = parse(subscription[2], 'HH:mm')
                        begin = func.toLocal(begin);
                        end = func.toLocal(end);

                        begin = format(begin, 'HH:mm');
                        end = format(end, 'HH:mm');

                        return ({
                            ...tournament,
                            subscription: `${begin} ${subscription[1]} ${end}`
                        })
                    });
                })
                .catch(e => console.error(e));
        }
    }
});

const useTournamentTypeStore = defineStore('tournamentType', {
    state: () => ({
        tournamentTypes: [],
    }),
    actions: {
        refresh() {
            axios
                .get('/api/tournament_type')
                .then((res) => this.tournamentTypes = res.data.data)
                .catch(e => console.error(e));
        }
    }
});

const useTournamentPlatformStore = defineStore('tournamentPlatform', {
    state: () => ({
        tournamentPlatforms: [],
    }),
    actions: {
        refresh() {
            axios
                .get('/api/tournament_platform')
                .then((res) => this.tournamentPlatforms = res.data.data)
                .catch(e => console.error(e));
        }
    }
});

const useNotificationStore = defineStore('notification', {
    state: () => ({
        notifications: [],
        due: [],
        timeouts: [],
    }),
    actions: {
        getNotificationTitle(notification) {
            if(notification.type === 'tournament') {
                return notification.tournament.name;
            }
            
            if(notification.type === 'administrative') {
                return 'Administração';
            }

            return 'Financeiro';
        },
        refresh() {
            this.notifications = [];
            this.due = [];
            axios
                .get('/api/notification')
                .then((res) => res.data.data)
                .then((data) => {
                    data.forEach(notification => {
                        let datetime = func.toLocal(parse(notification.datetime, 'DD/MM/YYYY HH:mm'));
                        const title = this.getNotificationTitle(notification);
                        if(datetime.getTime() <= Date.now()) { // Show notification history
                            this.notifications.push(
                                {
                                    ...notification,
                                    title,
                                    datetime: format(datetime, 'DD/MM/YYYY HH:mm')
                                }
                            );
                        }else {
                            this.due.push(
                                {
                                    ...notification,
                                    title,
                                    datetime
                                }
                            );
                        }
                    });
                })
                .then(this.schedule);
        },
        schedule() {
            // Clear all standard timeouts
            this.timeouts.forEach(timeout => {
                clearTimeout(timeout);
            });
            this.timeouts = [];

            Notification
                .requestPermission()
                .then(permission => {
                    if (permission !== 'granted') {
                        return alert('É necessário permitir as notificações para fazer bom uso da plataforma.');
                    }

                    // Process notifications in the main tab

                    this.due.forEach(notification => {
                        const timeout = notification.datetime.getTime() - Date.now();

                        if(timeout <= 24*60*60*1000) {
                            this.timeouts.push(setTimeout(() => 
                                {
                                    new Notification(
                                        notification.title,
                                        {
                                            tag: notification.id, // a unique ID
                                            body: notification.type !== 'tournament' ? notification.description : `
                                                Inscrição: ${notification.tournament.subscription}
                                                Plataforma: ${notification.tournament.platform_name}
                                            `, // content of the push notification
                                            data: {
                                                url: window.location.href, // pass the current url to the notification
                                            },
                                            badge: './assets/badge.png',
                                            icon: './assets/icon.png',
                                        }
                                    );

                                    this.refresh();
                                },
                                timeout
                            ));
                        }
                    });
                });
        }
    }
});

// NotificationIntervals
const useNotificationIntervalStore = defineStore('notificationInterval', {
    state: () => ({
        notificationIntervals: [],
    }),
    actions: {
        refresh() {
            axios
                .get('/api/notification_interval')
                .then((res) => this.notificationIntervals = res.data.data)
                .then(() => {
                    this.notificationIntervals = this.notificationIntervals.map(interval => {
                        return ({
                            id: interval.minutes,
                            name: `${interval.minutes} minutos antes`
                        })
                    })
                })
                .catch(e => console.error(e))
        }
    }
});

// Current User data
import {getCurrentInstance} from 'vue';

const useCurrentUserStore = defineStore('currentUser', {
    state: () => ({
        user: getCurrentInstance().appContext.config.globalProperties.user,
    }),
    actions: {
        refresh() {
            axios
                .get('/api/user/' + this.user.id)
                .then((res) => this.user = res.data.data)
                .catch(e => console.error(e))
        }
    }
});

export {useTournamentStore, useTournamentTypeStore, useTournamentPlatformStore, useNotificationStore, useNotificationIntervalStore, useCurrentUserStore};