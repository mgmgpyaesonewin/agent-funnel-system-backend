<template>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Age</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(applicant,i) in applicants.data" :key="i">
          <th scope="row">{{ applicant.id}}</th>
          <td>{{ applicant.name}}</td>
          <td>{{ applicant.email}}</td>
          <td>{{ applicant.phone}}</td>
          <td>{{ applicant.age}}</td>
          <td>{{ applicant.status}}</td>
          <slot :applicant="applicant"></slot>
        </tr>
      </tbody>
    </table>
    <v-pagination :data="applicants" @pagination-change-page="getApplicants" align="center"></v-pagination>
  </div>
</template>

<script>
import Pagination from "laravel-vue-pagination";
import { EventBus } from "../event-bus.js";

export default {
  components: {
    "v-pagination": Pagination
  },
  props: ["status"],
  data() {
    return {
      applicants: []
    };
  },
  methods: {
    updateApplicantsList(id) {
      console.log(`Applicant ${id}`);
      this.applicants.data = this.applicants.data.filter(
        applicant => applicant.id != id
      );
    },
    getApplicants(page = 1, status = 1, email = "", name = "") {
      status = this.status || status;
      window.API_URL = "http://127.0.0.1:8000/api";
      axios
        .get(
          `http://127.0.0.1:8000/api/applicants?status=${status}&email=${email}&name=${name}&page=${page}`
        )
        .then(({ data }) => {
          this.applicants = data;
        });
    }
  },
  mounted() {
    EventBus.$on("update-table", this.updateApplicantsList);
    EventBus.$on("filter-table", this.getApplicants);
    this.getApplicants(1, this.status, "", "");
  },
  destroyed() {
    EventBus.$off("update-table", this.updateApplicantsList);
    EventBus.$off("filter-table", this.getApplicants);
  }
};
</script>

<style>
</style>