<template>
  <div v-if="nearbyBreweries.length > 0" class="brewery-list app-wrap">
    <header class="list-header">
      <h3 class="section-header">
        {{ random === null ? 'Nearby' : 'Head to...' }}
      </h3>

      <div>
        <button
          type="button"
          class="button"
          @click="pickRandom"
        >
          Random
        </button>
      </div>
    </header>

    <div v-if="random">
      <BreweryCard :brewery="random" />
    </div>

    <ul v-else>
      <li
        v-for="brewery in nearbyBreweries"
        :key="brewery.id"
        class="brewery"
      >
        <BreweryCard :brewery="brewery" />
      </li>
    </ul>

    <button
      type="button"
      class="back"
      @click="backToAll"
    >
      Back to all nearby breweries
    </button>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import BreweryCard from '@/components/BreweryCard';
import { pickRandom } from '@/utils';

export default {
  name: 'BreweryList',
  components: { BreweryCard },
  props: {
    latLng: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      random: null,
    };
  },
  computed: {
    ...mapState(['nearbyBreweries']),
  },
  methods: {
    pickRandom() {
      this.random = pickRandom(this.nearbyBreweries);
    },
    backToAll() {
      this.random = null;
    },
  },
};
</script>

<style lang="scss">
@import '@/styles/_abstracts.scss';

.brewery-list {
  margin-top: $spacing * 2;
}

.list-header {
  display: flex;
  align-items: center;
  margin-bottom: $spacing;
}

.section-header {
  flex: 1;
}

.brewery + .brewery {
  margin-top: $spacing;
}

.back {
  margin-top: $spacing * 2;
  background-color: $c--gray-f;
  padding: .5em 1em;
}

</style>
