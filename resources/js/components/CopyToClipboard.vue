<template>
  <div>
    <button type="button" :class="classCss" v-clipboard:copy="text" v-clipboard:success="onCopy">
      <slot></slot>
    </button>
  </div>
</template>

<script>
export default {
  props: ["text", "classCss"],
  methods: {
    onCopy() {
      alert("Copied");
    },
  },
};
</script>

<style>
</style>