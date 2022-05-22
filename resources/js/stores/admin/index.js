import { defineStore } from 'pinia';
import {parse, format} from 'date-format-parse';
import {func} from '../../func';

// Tournaments

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

const useTournamentStore = defineStore('tournament', {
    state: () => ({
        tournaments: [],
    }),
    actions: {
        refresh() {
            axios
                .get('/api/tournament')
                .then((res) => this.tournaments = res.data.data)
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

//Users
const useUserStore = defineStore('user', {
    state: () => ({
        users: [],
    }),
    actions: {
        refresh() {
            axios
                .get('/api/user')
                .then((res) => this.users = res.data.data)
                .catch(e => console.error(e));
        }
    }
});

//PaymentPlans
const usePaymentPlanStore = defineStore('paymentPlan', {
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
const usePaymentStore = defineStore('payment', {
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
                        time = func.toLocal(time);
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
const useAdStore = defineStore('ad', {
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
const useNotificationStore = defineStore('notification', {
    state: () => ({
        notifications: [],
    }),
    actions: {
        refresh() {
            return (
                axios
                .get('/api/notification')
                .then((res) => this.notifications = res.data.data)
                .catch(e => console.error(e))
            );
        }
    }
});

// Insights
const useInsightsStore = defineStore('insights', {
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

export {
    useTournamentTypeStore, useTournamentPlatformStore, useTournamentStore,
    useUserStore, usePaymentPlanStore, usePaymentStore,
    useAdStore, useNotificationStore,
    useInsightsStore
};