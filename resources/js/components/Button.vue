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
    "eLearning",
  ],
  methods: {
    update() {
      this.$swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, update it!",
      }).then((result) => {
        if (result.value) {
          if (this.eLearning) {
            this.$swal
              .fire({
                title: "Input email address",
                input: "url",
                inputPlaceholder: "Enter your e-learing URL",
              })
              .then((url) => {
                console.log(url);
                console.log("url entered");
                this.updateApplicant();
              });
          } else {
            this.updateApplicant();
          }
        }
      });
    },
    updateApplicant() {
      let loader = this.$loading.show();

      axios
        .post(`applicants/update/${this.applicantId}`, {
          current_status: this.newCurrentStatus,
          status_id: this.newStatusId,
        })
        .then(({ data }) => {
          if (data.status) {
            loader.hide();
            EventBus.$emit("update-table", this.tableStatus);
          }
        });
    },
  },
};
</script>