<template>
  <button :class="cssClass" @click="comingSoon">
    <slot></slot>
  </button>
</template>

<script>
export default {
  props: ["cssClass"],
  methods: {
    comingSoon() {
      this.$swal(
        "Detail",
        "Will appear here after the frontend integration",
        "info"
      );
    },
  },
};
</script>

<style>
</style>