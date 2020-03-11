<template>
  <div class="home">
    <h1>Neighbrewhood</h1>

    {{ breweries }}
  </div>
</template>

<script>
import { mapState } from 'vuex';
export default {
  name: 'Home',
  computed: {
    ...mapState(['breweries']),
  },
};
</script>

<style scoped lang="scss">
</style>
