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
      commit('setBreweriesLoaded', true);
    },
    addBrewery({ commit, state }) {

    },
  },
});
