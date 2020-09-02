<template>
  <button :class="cssClass" @click="comingSoon">
    <slot></slot>
  </button>
</template>

<script>
export default {
  props: ["cssClass", "url"],
  methods: {
    comingSoon() {
      window.open(this.url, "_blank");
    },
  },
};
</script>

<style>
</style>