<template>
  <div>
    <h4 class="brewery__name item-header">
      {{ brewery.name }}
    </h4>
    <p class="brewery__address">
      {{ brewery.address }}
    </p>

    <p class="brewery__distance">
      {{ brewery.distance }} miles away
    </p>
  </div>
</template>

<script>
export default {
  name: 'BreweryCard',
  props: {
    brewery: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style lang="scss">
.brewery__address,
.brewery__distance {
  margin-top: .5em;
}
</style>
