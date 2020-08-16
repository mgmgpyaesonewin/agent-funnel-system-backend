<template>
  <div class="table-responsive">
    <div class="row" v-if="!isApplicantsEmpty">
      <div class="col-7">
        <h5 style="text-align: initial;line-height: 3rem;">
          Total
          <span class="badge badge-primary">{{ applicants.meta.total }}</span> records found.
        </h5>
      </div>
      <div class="col-5">
        <date-picker
          format="DD-MM-YYYY"
          type="date"
          value-type="format"
          v-model="date"
          placeholder="dd-mm-yyyy"
        />
        <button class="btn btn-primary" @click="setExam">Set Exam</button>
      </div>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th></th>
          <th>#</th>
          <th>Name</th>
          <th>Phone</th>
          <th>Exam Date</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(applicant, i) in applicants.data" :key="i">
          <td>
            <fieldset v-show="applicant.status_id === 1">
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
          <td>{{ applicant.id}}</td>
          <td>
            <a href="#">{{ applicant.name}}</a>
            <br />
            <div class="badge badge-primary">{{ applicant.temp_id }}</div>
          </td>
          <td>{{ applicant.phone}}</td>
          <td>{{ applicant.exam_date }}</td>
          <td>{{ getApplicantStatus(applicant.status_id) }}</td>
          <td>
            <div class="btn-group mt-1" v-show="applicant.status_id === 1 && applicant.exam_date">
              <button class="btn btn-success" @click="update(applicant.id, 'onboard', 1)">
                <i class="fa fa-check" aria-hidden="true"></i> Passed
              </button>
              <button class="btn btn-danger" @click="update(applicant.id, 'certification', 4)">
                <i class="fa fa-times" aria-hidden="true"></i> Failed
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <v-pagination :data="applicants" @pagination-change-page="getApplicants" align="center"></v-pagination>
  </div>
</template>

<script>
import Pagination from "laravel-vue-pagination";
import DatePicker from "vue2-datepicker";
import Constant from "../../constant.js";

import "vue2-datepicker/index.css";

export default {
  props: ["currentStatus"],
  components: {
    "v-pagination": Pagination,
  },
  data() {
    return {
      constant: Constant,
      applicants: {},
      selectedApplicants: [],
      date: "",
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
    getApplicants() {
      axios
        .post("applicants", {
          current_status: this.currentStatus,
        })
        .then(({ data }) => {
          this.applicants = data;
        })
        .catch((e) => {
          console.log(e);
        });
    },
    getApplicantStatus(status_id) {
      return Object.keys(this.constant).find(
        (key) => this.constant[key] === status_id
      );
    },
    setExam() {
      axios
        .post(`applicants/exam`, {
          applicant_ids: this.selectedApplicants,
          exam_date: this.date,
        })
        .then(({ data }) => {
          if (data.status) {
            this.getApplicants();
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
    update(applicantId, current_status, status_id) {
      axios
        .post(`applicants/update/${applicantId}`, {
          current_status,
          status_id,
        })
        .then(({ data }) => {
          if (data.status) {
            this.getApplicants();
          }
        });
    },
  },
  mounted() {
    this.getApplicants();
  },
};
</script>

<style>
</style>