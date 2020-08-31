<template>
  <button class="btn btn-primary" @click="show">View</button>
</template>

<script>
export default {
  props: ["image"],
  methods: {
    show() {
      this.$swal({
        title: "Payment Information",
        imageUrl: this.image,
        imageAlt: "Custom image",
      });
    },
  },
};
</script>

<style>
</style>