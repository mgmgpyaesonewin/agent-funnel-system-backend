<template>
  <div class="table-responsive">
    <div class="row" v-if="!isApplicantsEmpty">
      <div class="col-9">
        <h5 style="text-align: initial;line-height: 3rem;">
          Total
          <span class="badge badge-primary">{{ applicants.meta.total }}</span> records found.
        </h5>
      </div>
      <div v-show="webinarInvite === true" class="col-3">
        <button
          class="btn btn-info"
          data-toggle="modal"
          data-target="#webinarModal"
        >Invite to Webinar</button>
      </div>
      <div v-show="userAssign === true" class="col-3">
        <multi-select
          v-model="value"
          :options="options"
          :show-labels="false"
          :allow-empty="false"
          track-by="id"
          label="name"
          deselect-label="You must choose at least one user"
          placeholder="Choose a BDM"
          @select="onSelect"
        >
          <template slot="singleLabel" slot-scope="{ option }">
            <strong>{{ option.name }}</strong> is selected as admin
          </template>
        </multi-select>
      </div>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th v-show="userAssign === true"></th>
          <th>#</th>
          <th>Name</th>
          <th>Phone</th>
          <th>Age</th>
          <th>Gender</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(applicant,i) in applicants.data" :key="i">
          <td v-show="userAssign === true">
            <fieldset v-show="applicant.status_id !== 1">
              <div class="vs-checkbox-con vs-checkbox-primary">
                <input type="checkbox" v-model="selectedApplicants" :value="applicant.id" />
                <span class="vs-checkbox">
                  <span class="vs-checkbox--check">
                    <i class="vs-icon feather icon-check"></i>
                  </span>
                </span>
              </div>
            </fieldset>
          </td>
          <th scope="row">{{ applicant.id}}</th>
          <td>
            <a href="#">{{ applicant.name}}</a>
          </td>
          <td>{{ applicant.phone}}</td>
          <td>{{ applicant.age}}</td>
          <td>{{ applicant.gender}}</td>
          <slot :applicant="applicant"></slot>
        </tr>
      </tbody>
    </table>
    <v-pagination :data="applicants" @pagination-change-page="getApplicants" align="center"></v-pagination>
    <div
      class="modal fade"
      id="webinarModal"
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
import Pagination from "laravel-vue-pagination";
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
import { EventBus } from "../event-bus.js";
import STATE from "../constant.js";
import Multiselect from "vue-multiselect";

export default {
  components: {
    "v-pagination": Pagination,
    "date-picker": DatePicker,
    "multi-select": Multiselect,
  },
  props: ["currentStatus", "status", "webinarInvite", "userAssign"],
  data() {
    return {
      applicants: {},
      selectedApplicants: [],
      webinarList: [],
      date: "",
      time: "",
      url: "",
      value: "",
      options: [
        { id: 1, name: "Pyae Sone" },
        { id: 1, name: "Pyae Sone" },
        { id: 1, name: "Pyae Sone" },
        { id: 1, name: "Pyae Sone" },
        { id: 1, name: "Pyae Sone" },
      ],
    };
  },
  computed: {
    isApplicantsEmpty() {
      return (
        Object.keys(this.applicants).length === 0 &&
        this.applicants.constructor === Object
      );
    },
  },
  methods: {
    updateApplicantsList(status) {
      let payload = {};

      if (this.currentStatus) {
        payload.current_status = this.currentStatus;
      }

      if (this.currentStatus) {
        payload.status_id = this.status;
      }
      axios
        .post(`applicants?page=${this.applicants.meta.current_page}`, payload)
        .then(({ data }) => {
          this.applicants = data;
        });
    },
    getApplicants(page = 1) {
      let payload = {};

      if (this.currentStatus) {
        payload.current_status = this.currentStatus;
      }

      if (this.currentStatus) {
        payload.status_id = this.status;
      }
      axios
        .post(`applicants?page=${page}`, payload)
        .then(({ data }) => {
          this.applicants = data;
        })
        .catch((e) => {
          console.log(e);
        });
    },
    inviteToWebinar() {
      axios
        .post("http://mpt-portal.test/api/applicants/schedule", {
          date: this.date,
          time: this.time,
          url: this.url,
          rescheduled: 0,
          applicants: this.webinarList,
        })
        .then(({ data }) => {
          if (data.status) {
            $(".modal-backdrop").remove();
            $("#webinarModal").modal("hide");
            this.getApplicants(this.applicants.meta.current_page, [2, 3]);
            this.resetWebinarForm();
          }
        });
    },
    resetWebinarForm() {
      this.date = "";
      this.time = "";
      this.url = "";
    },
    onSelect({ id }) {
      console.log(id);
      axios
        .post("applicants/assign", {
          user_id: id,
          applicants_ids: this.selectedApplicants,
        })
        .then(({ data }) => {
          this.applicants = data;
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },
  mounted() {
    this.getApplicants();
    EventBus.$on("update-table", this.updateApplicantsList);
  },
  destroyed() {
    EventBus.$off("update-table", this.updateApplicantsList);
    EventBus.$off("filter-table", this.getApplicants);
  },
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
</style>
