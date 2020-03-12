<template>
  <div class="home">
    <Locator />

    <BreweryList v-if="located" />
  </div>
</template>

<script>
import { mapState } from 'vuex';
import Locator from '@/components/Locator';
import BreweryList from '@/components/BreweryList';

export default {
  name: 'Home',
  components: { Locator, BreweryList },
  computed: {
    ...mapState(['located']),
  },
};
</script>

