<template>
  <div>
    <button
      type="button"
      :class="classCss"
      v-clipboard:copy="text"
      v-clipboard:success="onCopy"
    >
      <i class="fa fa-clone text-primary" aria-hidden="true">
        <strong class="message">{{ message }}</strong>
      </i>
    </button>
  </div>
</template>

<script>
export default {
  props: ["text", "classCss"],
  data() {
    return {
      message: "Copy",
    };
  },
  methods: {
    onCopy() {
      this.message = "Copied";
      setTimeout(() => {
        this.message = "Copy";
      }, 3000);
    },
  },
};
</script>

<style scoped>
.message {
  font-size: 11px;
  margin-left: 0.4em;
}
</style>