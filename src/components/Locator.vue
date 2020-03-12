<template>
  <div class="app-wrap">
    <button
      v-if="canGeolocate && !located"
      class="button button--fullwidth"
      @click="locate"
    >
      {{ button }}
    </button>

    <p v-if="!canGeolocate">
      Geolocation is not supported by your browser
    </p>

    <p v-if="message">
      {{ message }}
    </p>
  </div>
</template>

<script>

export default {
  name: 'Locator',
  data() {
    return {
      message: '',
      canGeolocate: true,
      located: false,
      button: 'Get my location',
    };
  },
  mounted() {
    if (!navigator.geolocation) {
      this.canGeolocate = false;
    }
  },
  methods: {
    onGeocodeSuccess({ coords: { latitude, longitude } }) {
      this.message = '';
      this.located = true;
      this.$store.dispatch('findNearbyBreweries', [latitude, longitude]);
    },
    onGeocodeError() {
      this.message = 'Unable to get your location';
    },
    locate() {
      if (!navigator.geolocation) {
        return;
      }

      this.button = 'Locating...';
      navigator.geolocation.getCurrentPosition(this.onGeocodeSuccess, this.onGeocodeError, { enableHighAccuracy: true });
    },
  },
};
</script>

<style lang="scss">

</style>
