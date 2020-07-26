<template>
  <div class="table-responsive">
    <div class="row">
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
          :disabled="isWebniarListEmpty"
        >Invite to Webinar</button>
      </div>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th v-show="webinarInvite === true"></th>
          <th>#</th>
          <th>Name</th>
          <th>Phone</th>
          <th>Age</th>
          <th>Gender</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(applicant,i) in applicants.data" :key="i">
          <td v-show="webinarInvite === true">
            <fieldset v-show="applicant.status_id === 3">
              <div class="vs-checkbox-con vs-checkbox-primary">
                <input type="checkbox" v-model="webinarList" :value="applicant.id" />
                <span class="vs-checkbox">
                  <span class="vs-checkbox--check">
                    <i class="vs-icon feather icon-check"></i>
                  </span>
                </span>
              </div>
            </fieldset>
          </td>
          <th scope="row">{{ applicant.id}}</th>
          <td>{{ applicant.name}}</td>
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

export default {
  components: {
    "v-pagination": Pagination,
    "date-picker": DatePicker,
  },
  props: ["status", "webinarInvite"],
  data() {
    return {
      applicants: [],
      webinarList: [],
      date: "",
      time: "",
      url: "",
    };
  },
  computed: {
    isWebniarListEmpty() {
      return this.webinarList.length === 0;
    },
  },
  methods: {
    updateApplicantsList(status) {
      axios
        .post(
          `http://mpt-portal.test/api/applicants?page=${this.applicants.meta.current_page}`,
          {
            status: status,
          }
        )
        .then(({ data }) => {
          this.applicants = data;
        });
    },
    getApplicants() {
      console.log("get applicants inside");
      axios
        .post(`applicants?page=${page}`, {
          current_status: STATE.PRE_FILTER,
          status_id: STATE.NEW,
        })
        .then(({ data }) => {
          console.log(data);
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
  },
  mounted() {
    console.log("get applicants");
    this.getApplicants();
  },
  destroyed() {
    EventBus.$off("update-table", this.updateApplicantsList);
    EventBus.$off("filter-table", this.getApplicants);
  },
};
</script>

<style>
</style>
