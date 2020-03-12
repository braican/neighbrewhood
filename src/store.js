import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    currentUser: null,
    userProfile: {},

    breweries: {},
    breweriesLoaded: false,
  },
  mutations: {
    setBreweries(state, val) {
      state.breweries = val;
    },
    setBreweriesLoaded(state, val) {
      state.breweriesLoaded = val;
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
    addBrewery({ commit, state }) {

    },
  },
});
