<template>
  <div class="home">
    <Locator />

    <BreweryList />
  </div>
</template>

<script>
import Locator from '@/components/Locator';
import BreweryList from '@/components/BreweryList';

export default {
  name: 'Home',
  components: { Locator, BreweryList },
};
</script>

