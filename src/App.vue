<template>
  <div id="app" class="app">
    <Header />
    <router-view />
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
  padding-bottom: $spacing * 2;
}
</style>

