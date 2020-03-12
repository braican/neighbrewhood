<template>
  <header class="masthead app-wrap">
    <span class="logo"><Logo /></span>
    <h1 class="branding">
      Neighbrewhood
    </h1>
  </header>
</template>

<script>
import Logo from '../static/svg/logo.svg';

export default {
  name: 'Header',
  components: { Logo },
};
</script>

<style lang="scss">
@import '@/styles/_abstracts.scss';

.masthead {
  background-color: $c--white;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: $spacing;
  padding-bottom: $spacing * 2;
}

.logo {
  flex: 0 0 36px;
  margin-right: $spacing;
}


.branding {
  font-weight: $fw--bold;
  flex: 1;
  letter-spacing: 1px;
}

</style>
