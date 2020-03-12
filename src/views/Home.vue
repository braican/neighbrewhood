<template>
  <div class="home">
    <h1>Neighbrewhood</h1>

    <BreweryList />
  </div>
</template>

<script>
import BreweryList from '@/components/BreweryList';

export default {
  name: 'Home',
  components: { BreweryList },
};
</script>

