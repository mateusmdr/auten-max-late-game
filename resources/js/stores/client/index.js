import { defineStore } from 'pinia';
import {parse, format} from 'date-format-parse';
import {func} from '../../func';

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
                    this.enabledTournaments = res.data.data.filter(item => item.isEnabled);
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
    }),
    actions: {
        refresh() {
            axios
                .get('/api/notification')
                .then((res) => this.notifications = res.data.data)
                .then(() => {
                    this.notifications = this.notifications.map(notification =>{
                        let datetime = parse(notification.datetime, 'DD/MM/YYYY HH:mm')
                        datetime = func.toLocal(datetime);
                        return ({
                            ...notification,
                            datetime: format(datetime, 'DD/MM/YYYY HH:mm')
                        })
                    });
                })
        }
    }
});

export {useTournamentStore, useTournamentTypeStore, useTournamentPlatformStore, useNotificationStore};