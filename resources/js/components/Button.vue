<template>
  <button :class="buttonClass" @click="update()">
    <slot></slot>
  </button>
</template>


<script>
import { EventBus } from "../event-bus.js";
console.log(EventBus);

export default {
  props: [
    "buttonClass",
    "applicantId",
    "oldStatusId",
    "newStatusId",
    "reasonId",
    "tableStatus"
  ],
  methods: {
    update() {
      let payload = {
        old_status: this.oldStatusId,
        new_status: this.newStatusId
      };

      if (this.reasonId) {
        payload.reason_id = this.reasonId;
      }

      axios
        .post(`${API_URL}/applicants/update/${this.applicantId}`, payload)
        .then(({ data }) => {
          console.log(data);
          if (data.status) {
            EventBus.$emit("update-table", this.tableStatus);
          }
        });
    }
  }
};
</script>