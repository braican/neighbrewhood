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

    <p v-if="message" class="message">
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
      this.$store.commit('setLocated', true);
      this.$store.dispatch('findNearbyBreweries', [latitude, longitude]);
    },
    onGeocodeError(error) {
      this.button = 'Get my location';

      if (error.code === 1) {
        this.message = 'Please enable geolocation for this app on your device.';
      } else if (error.code === 2) {
        this.message = error.message;
      } else if (error.code === 3) {
        this.message = error.message;
      } else {
        this.message = 'Unable to get your location. Please contact support.';
      }
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

<style lang="scss" scoped>
@import '@/styles/_abstracts.scss';

.message {
  margin-top: $spacing;
}

</style>
