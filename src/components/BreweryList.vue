<template>
  <section class="app-wrap">
    <div v-if="nearbyBreweries.length > 0">
      <header class="list-header">
        <div class="header-left">
          <h3 class="section-header">
            {{ random === null ? 'Nearby' : 'Head to...' }}
          </h3>
        </div>

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
        <div class="random-brewery">
          <BreweryCard :brewery="random" />
        </div>

        <button
          type="button"
          class="back"
          @click="backToAll"
        >
          &larr; Back to all nearby breweries
        </button>
      </div>

      <div v-else>
        <p class="count">
          ({{ nearbyBreweries.length }} breweries)
        </p>
        <ul class="brewery-list">
          <li
            v-for="brewery in nearbyBreweries"
            :key="brewery.id"
            class="brewery"
          >
            <BreweryCard :brewery="brewery" />
          </li>
        </ul>
      </div>
    </div>

    <div v-else>
      <p>There are no nearby breweries</p>
    </div>
  </section>
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
    ...mapState(['nearbyBreweries', 'located']),
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

.list-header {
  display: flex;
  align-items: center;
  margin-top: $spacing * -3.1;
}

.header-left {
  flex: 1;
  margin-right: $spacing;
}

.brewery-list {
  margin-top: $spacing * 2;
}

.brewery {
  padding-top: $spacing;
  border-top: 1px solid $c--gray-e;
  margin-top: $spacing;
}

.random-brewery {
  margin-top: $spacing * 2;
}

.back {
  margin-top: $spacing * 2;
  background-color: $c--gray-e;
  padding: .6em 1em;
}

</style>
