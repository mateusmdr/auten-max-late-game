import { defineStore } from 'pinia';

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

export {useTournamentTypeStore, useTournamentPlatformStore, useTournamentStore, useUserStore, usePaymentPlanStore};