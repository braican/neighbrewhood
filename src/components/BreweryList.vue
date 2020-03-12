<template>
  <div class="brewery-list">
    <ul>
      <li
        v-for="brewery in breweries"
        :key="brewery.id"
        class="brewery"
      >
        <h4 class="brewery__name item-header">
          {{ brewery.name }}
        </h4>
        <p class="brewery__address">
          {{ brewery.address }}
        </p>
      </li>
    </ul>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  name: 'BreweryList',
  computed: {
    ...mapState(['breweries']),
  },
};
</script>

<style lang="scss">
@import '@/styles/_abstracts.scss';

.brewery-list {
  padding: $spacing;
}

.brewery + .brewery {
  margin-top: $spacing;
}

.brewery__address {
  margin-top: .5em;
}

</style>
