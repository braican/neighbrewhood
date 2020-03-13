<template>
  <header class="masthead">
    <div class="app-wrap">
      <span class="logo"><Logo /></span>
      <h1 class="branding">
        Neighbrewhood
      </h1>

      <div>
        <button v-if="located" class="update-location button--secondary">
          <LocationIcon />
          <span>Update location</span>
        </button>
      </div>
    </div>
  </header>
</template>

<script>
import { mapState } from 'vuex';
import Logo from '@/static/svg/logo.svg';
import LocationIcon from '@/static/svg/icon-location.svg';

export default {
  name: 'Header',
  components: { Logo, LocationIcon },
  computed: {
    ...mapState(['located']),
  },
};
</script>

<style lang="scss">
@import '@/styles/_abstracts.scss';

.masthead {
  background-color: $c--white;
  padding-top: $spacing;
  padding-bottom: $spacing * 2;

  .app-wrap {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
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

.update-location {
  display: flex;
  align-items: center;

  svg {
    width: 20px;
  }
}

</style>
