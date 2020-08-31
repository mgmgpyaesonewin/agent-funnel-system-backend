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
          if (this.eLearning && this.newStatusId == 3) {
            this.$swal
              .fire({
                title: "Enter your e-learing URL",
                html: `<input id="swal-input-url" class="swal2-input" placeholder="Enter your e-learing URL" type="url">
                  <input id="swal-input-username" class="swal2-input" placeholder="Enter Username" type="text">
                  <input id="swal-input-password" class="swal2-input" placeholder="Enter Password" type="password">
                  `,
                preConfirm: () => {
                  return {
                    url: document.getElementById("swal-input-url").value,
                    username: document.getElementById("swal-input-username")
                      .value,
                    password: document.getElementById("swal-input-password")
                      .value,
                  };
                },
              })
              .then(({ value }) => {
                let { url, username, password } = value;
                axios
                  .post("/applicants/learning", {
                    id: this.applicantId,
                    url,
                    username,
                    password,
                  })
                  .then((res) => {
                    if (res.status) {
                      this.updateApplicant();
                    }
                  });
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