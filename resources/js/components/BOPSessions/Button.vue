<template>
  <div>
    <button
      :class="buttonClass"
      class="btn-group-last"
      data-toggle="modal"
      :data-target="`#bopSessionModel-${applicantId}`"
      @click="preFetchSessions"
    >
      <slot></slot>
    </button>
    <div
      class="modal fade"
      :id="`bopSessionModel-${applicantId}`"
      tabindex="-1"
    >

      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Choose BOP Sessions</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <multi-select
                label="title"
                track-by="id"
                v-model="selected_session"
                :options="sessions"
                :show-labels="false"
                placeholder="Type to search sessions"
                open-direction="bottom"
                :searchable="true"
                :loading="isLoading"
                :internal-search="false"
                :close-on-select="true"
                :preserve-search="true"
                :custom-label="titleWithDateTime"
                @search-change="searchSession"
              >
                <span slot="noResult">
                  Oops! No Session found. Consider changing the session title.
                </span>
              </multi-select>
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button
              type="button"
              class="btn btn-primary"
              @click="updateApplicant"
            >
              Assign BOP Session
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../event-bus.js";

export default {
  props: {
    buttonClass: String,
    applicantId: Number,
    oldCurrentStatus: String,
    newCurrentStatus: String,
    oldStatusId: Number,
    newStatusId: Number,
    bopSessions: Array,
    reassign: Boolean,
  },
  data() {
    return {
      sessions: [],
      selected_session: "",
      isLoading: false,
    };
  },
  methods: {
    titleWithDateTime({ title, date, time }) {
      return `${title} (${date} ${time})`;
    },
    preFetchSessions() {
      if (this.reassign) {
        this.searchSession();
      }
    },
    searchSession(query = "") {
      this.isLoading = true;
      axios.get(`sessions?q=${query}&applicant_id=${this.applicantId}`).then(({ data }) => {
        this.isLoading = false;
        this.sessions = data.sessions;
      });
    },
    updateApplicant() {
      let loader = this.$loading.show();
      axios
        .post(`applicants/update/${this.applicantId}`, {
          current_status: this.newCurrentStatus,
          status_id: this.newStatusId,
          session_id: this.selected_session.id,
        })
        .then(({ data }) => {
          if (data.status) {
            $(".modal-backdrop").remove();
            $(`#bopSessionModel-${this.applicantId}`).modal("hide");
            loader.hide();
            EventBus.$emit("update-table", this.tableStatus);
          }
        });
    },
  },
  mounted() {
    this.sessions = this.bopSessions;
  },
};
</script>

<style scoped>
.btn-group-last {
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
}

.btn-group-first {
  border-radius: 0.4285rem 0 0 0.4285rem;
}
</style>
