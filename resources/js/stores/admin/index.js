import { defineStore } from 'pinia';
import {parse, format} from 'date-format-parse';
import axios from "axios";

// Tournaments

export const useTournamentTypeStore = defineStore('tournamentType', {
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

export const useTournamentPlatformStore = defineStore('tournamentPlatform', {
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

export const useTournamentStore = defineStore('tournament', {
    state: () => ({
        tournaments: [],
    }),
    actions: {
        refresh(qtd=7, filters={}) {
            axios
                .get('/api/tournament', {params: {...filters, qtd}})
                .then((res) => this.tournaments = res.data.data)
                .then(() => {
                    this.tournaments = this.tournaments.map(tournament =>{
                        const subscription = tournament.subscription.split(' ');
                        let begin = parse(subscription[0], 'HH:mm')
                        let end = parse(subscription[2], 'HH:mm')

                        begin = format(begin, 'HH:mm');
                        end = format(end, 'HH:mm');

                        const formattedDate = format(parse(tournament.date, "DD/MM/YYYY"), "DD/MM");

                        return ({
                            ...tournament,
                            formattedDate,
                            subscription: `${begin} ${subscription[1]} ${end}`
                        })
                    });
                })
                .catch(e => console.error(e));
        }
    }
});

//Users
export const useUserStore = defineStore('user', {
    state: () => ({
        users: [],
        user: null,
    }),
    actions: {
        refresh() {
            return axios
                .get('/api/user')
                .then((res) => this.users = res.data.data)
                .catch(e => console.error(e));
        },
        getUser(id) {
            this.user = this.users.find(item => item.id == id);
            this.refresh()
            .then(() => {
                this.user = this.users.find(item => item.id == id);
            })
        }
    }
});

//PaymentPlans
export const usePaymentPlanStore = defineStore('paymentPlan', {
    state: () => ({
        paymentPlans: {
            monthly: null,
            biannual: null,
            yearly: null,
        },
        isLoading: true
    }),
    actions: {
        refresh() {
            return (
                axios
                .get('/api/payment_plan')
                .then((res) => res.data.data)
                .then(plans => {
                    this.paymentPlans = {
                        monthly: plans.find(item => item.period === 'monthly'),
                        biannual: plans.find(item => item.period === 'biannual'),
                        yearly: plans.find(item => item.period === 'yearly'),
                    }
                })
                .catch(e => console.error(e))
                .finally(() => this.isLoading = false)
            );
        }
    }
});

// Payments
export const usePaymentStore = defineStore('payment', {
    state: () => ({
        payments: [],
    }),
    actions: {
        refresh() {
            return (
                axios
                .get('/api/payment')
                .then((res) => this.payments = res.data.data)
                .then(() => {
                    this.payments = this.payments.map(payment =>{
                        let time = parse(payment.time, 'HH:mm')
                        return ({
                            ...payment,
                            time: format(time, 'HH:mm')
                        })
                    });
                })
                .catch(e => console.error(e))
            );
        }
    }
});

// Ads
export const useAdStore = defineStore('ad', {
    state: () => ({
        ads: [],
    }),
    actions: {
        refresh() {
            return (
                axios
                .get('/api/ad')
                .then((res) => this.ads = res.data.data)
                .catch(e => console.error(e))
            );
        }
    }
});

// Notifications
export const useNotificationStore = defineStore('notification', {
    state: () => ({
        notifications: [],
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
            return (
                axios
                .get('/api/notification')
                .then((res) => this.notifications = res.data.data.map((notification) => {
                    let datetime = parse(notification.datetime, 'DD/MM/YYYY HH:mm');
                    const title = this.getNotificationTitle(notification);
                    return ({
                        ...notification,
                        title,
                        date: format(datetime, 'DD/MM/YYYY'),
                        time: format(datetime, 'HH:mm')
                    })
                }))
                .catch(e => console.error(e))
            );
        }
    }
});

// Insights
export const useInsightsStore = defineStore('insights', {
    state: () => ({
        insights: null,
    }),
    actions: {
        refresh() {
            return (
                axios
                .get('/api/insights')
                .then((res) => this.insights = res.data)
                .catch(e => console.error(e))
            );
        }
    }
});
