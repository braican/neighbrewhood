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

    nearbyBreweries: [],
  },
  mutations: {
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
      fetch('/.netlify/functions/getBreweries').then(resp => resp.json()).then(data => {
        const breweries = data.map(brewery => ({ ...brewery.data, id: brewery.ref['@ref'].id }));
        commit('setBreweries', breweries);
        commit('setBreweriesLoaded', true);
      });
    },
    findNearbyBreweries({ commit, state }, [lat, lng]) {
      const mappedBreweries = state.breweries
        .map(brewery => ({ ...brewery, distance: getDistanceBetween(lat, lng, brewery.latLng[0], brewery.latLng[1]) }))
        .filter(brewery => brewery.distance < 2);

      commit('setNearbyBreweries', mappedBreweries);

    },
  },
});
