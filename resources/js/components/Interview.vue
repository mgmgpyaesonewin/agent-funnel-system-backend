<template>
  <div>
    <button
      class="btn btn-info"
      data-toggle="modal"
      :data-target="`#webinarModal-${applicantId}`"
    >Interview</button>
    <div
      class="modal fade"
      :id="`webinarModal-${applicantId}`"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              class="modal-title"
              id="exampleModalLabel"
            >Invite selected Applicants to attend Webinar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col">
                  <date-picker format="DD-MM-YYYY" type="date" value-type="format" v-model="date" />
                </div>
                <div class="col">
                  <date-picker
                    v-model="time"
                    format="hh:mm a"
                    value-type="format"
                    type="time"
                    placeholder="Select time"
                  />
                </div>
              </div>
              <div class="row mt-1">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Webinar URL" v-model="url" />
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="inviteToWebinar">Send Invites</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";

export default {
  components: {
    "date-picker": DatePicker,
  },
  props: ["applicantId"],
  data() {
    return {
      date: "",
      time: "",
      url: "",
    };
  },
  methods: {
    resetWebinarForm() {
      this.date = "";
      this.time = "";
      this.url = "";
    },
    inviteToWebinar() {
      axios
        .post("/applicants/schedule", {
          date: this.date,
          time: this.time,
          url: this.url,
          rescheduled: 0,
          applicant_id: this.applicantId,
        })
        .then(({ data }) => {
          if (data.status) {
            $(".modal-backdrop").remove();
            $(`#webinarModal-${this.applicantId}`).modal("hide");
            // TODO reload applicants
            this.resetWebinarForm();
          }
        });
    },
  },
};
</script>

<style>
</style>