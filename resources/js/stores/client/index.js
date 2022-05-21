import { defineStore } from 'pinia';

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
        }
    }
});

export {useTournamentStore, useTournamentTypeStore, useTournamentPlatformStore, useNotificationStore};