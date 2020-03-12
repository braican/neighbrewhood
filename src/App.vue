<template>
  <div id="app" class="app">
    <Header />

    <div class="app-main">
      <router-view />
    </div>
  </div>
</template>

<script>
import Header from '@/components/Header';
export default {
  name: 'App',
  components: { Header },
};
</script>

<style lang="scss">
@import '@/styles/_abstracts.scss';

.app {
  background-color: $c--gray-f;
  padding-bottom: $spacing * 2;
  min-height: 100vh;
}

.app-main {
  padding-top: $spacing * 2;
}

</style>

