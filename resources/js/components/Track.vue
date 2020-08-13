<template>
  <div>
    <button
      class="btn btn-info"
      data-toggle="modal"
      :data-target="`#traineeModal-${applicant.id}`"
    >Track</button>
    <button
      v-show="applicant.status_id == 3"
      class="btn btn-warning"
      data-toggle="modal"
      :data-target="`#traineeExamDateModal-${applicant.id}`"
    >Set Exam</button>
    <div
      class="modal fade"
      :id="`traineeModal-${applicant.id}`"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">User Training</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div
                class="form-check d-flex mx-2 my-1"
                v-for="(training, key) in trainings"
                :key="key"
              >
                <input
                  type="checkbox"
                  class="form-check-input"
                  :value="training.id"
                  v-model="completed"
                />
                <label class="form-check-label" for="exampleCheck1">{{ training.name }}</label>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="updateTrack">Update Track</button>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      :id="`traineeExamDateModal-${applicant.id}`"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Exam Date</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <date-picker
                format="DD-MM-YYYY"
                type="date"
                value-type="format"
                v-model="date"
                placeholder="dd-mm-yyyy"
              />
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button
              type="button"
              class="btn btn-primary"
              @click="setExam(applicant.id)"
            >Save Exam Date</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { EventBus } from "../event-bus.js";
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";

export default {
  props: ["applicant"],
  components: {
    "date-picker": DatePicker,
  },
  data() {
    return {
      trainings: [],
      completed: [],
      date: "",
    };
  },
  methods: {
    getTrainings() {
      axios
        .get(`/trainings/${this.applicant.id}`)
        .then(({ data }) => {
          this.trainings = data.data;
          this.completed = data.completed;
        })
        .catch((e) => {
          console.log(e);
        });
    },
    updateTrack() {
      axios
        .post(`/applicants/training/update/${this.applicant.id}`, {
          training_ids: this.completed,
        })
        .then(({ data }) => {
          if (data.status) {
            $(".modal-backdrop").remove();
            $(`#traineeModal-${this.applicant.id}`).modal("hide");
            EventBus.$emit("update-table");
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
    setExam(applicant_id) {
      axios
        .post(`applicant/exam`, {
          applicant_id,
          exam_date: this.date,
        })
        .then(({ data }) => {
          if (data.status) {
            $(".modal-backdrop").remove();
            $(`#traineeExamDateModal-${this.applicant.id}`).modal("hide");
            EventBus.$emit("update-table");
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },
  mounted() {
    this.getTrainings();
  },
};
</script>

<style>
</style>