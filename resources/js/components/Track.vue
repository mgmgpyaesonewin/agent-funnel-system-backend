<template>
  <div>
    <button
      class="btn btn-info"
      data-toggle="modal"
      :data-target="`#traineeModal-${applicantId}`"
    >Track</button>
    <div
      class="modal fade"
      :id="`traineeModal-${applicantId}`"
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
  </div>
</template>

<script>
export default {
  props: ["applicantId"],
  data() {
    return {
      trainings: [],
      completed: [],
    };
  },
  methods: {
    getTrainings() {
      axios
        .get(`/trainings/${this.applicantId}`)
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
        .post(`/applicants/training/update/${this.applicantId}`, {
          training_ids: this.completed,
        })
        .then(({ data }) => {
          if (data.status) {
            $(".modal-backdrop").remove();
            $(`#traineeModal-${this.applicantId}`).modal("hide");
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