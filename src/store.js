import Vue from 'vue';
import Vuex from 'vuex';
import { getDistanceBetween } from '@/utils';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    currentUser: null,
    userProfile: {},
    breweries: [],
    breweriesLoaded: false,
    located: false,
    nearbyBreweries: [],
  },
  mutations: {
    setLocated(state, val) {
      state.located = val;
    },
    setBreweries(state, val) {
      state.breweries = val;
    },
    setBreweriesLoaded(state, val) {
      state.breweriesLoaded = val;
    },
    setNearbyBreweries(state, val) {
      state.nearbyBreweries = val;
    },
  },
  actions: {
    fetchBreweries({ commit }) {
      fetch('/.netlify/functions/getBreweries').then(resp => resp.json()).then(breweries => {
        console.log(breweries.length);
        commit('setBreweries', breweries);
        commit('setBreweriesLoaded', true);
      });
    },
    findNearbyBreweries({ commit, state }, [lat, lng]) {
      const mappedBreweries = state.breweries
        .map(brewery => ({ ...brewery, distance: getDistanceBetween(lat, lng, brewery.latLng[0], brewery.latLng[1]) }))
        .filter(brewery => brewery.distance < 1.5)
        .sort((a, b) => {
          if (a.distance < b.distance) {
            return -1;
          }

          if (a.distance > b.distance) {
            return 1;
          }

          return 0;
        });

      commit('setNearbyBreweries', mappedBreweries);

    },
  },
});
