<template>
  <button :class="buttonClass" @click="update()">
    <slot></slot>
  </button>
</template>


<script>
import { EventBus } from "../event-bus.js";

export default {
  props: [
    "buttonClass",
    "applicantId",
    "oldCurrentStatus",
    "newCurrentStatus",
    "oldStatusId",
    "newStatusId",
  ],
  methods: {
    update() {
      let loader = this.$loading.show();

      axios
        .post(`applicants/update/${this.applicantId}`, {
          current_status: this.newCurrentStatus,
          status_id: this.newStatusId,
        })
        .then(({ data }) => {
          if (data.status) {
            loader.hide();
            console.log(data);
            EventBus.$emit("update-table", this.tableStatus);
          }
        });
    },
  },
};
</script>