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
    <v-pagination :data="applicants" @pagination-change-page="getPendingApplicants" align="center"></v-pagination>
  </div>
</template>

<script>
import Pagination from "laravel-vue-pagination";
import { EventBus } from "../event-bus.js";

export default {
  components: {
    "v-pagination": Pagination
  },
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
    getPendingApplicants(page = 1) {
      window.API_URL = "http://localhost:8000/api";
      axios
        .get(`${API_URL}/applicants?status=1&page=${page}`)
        .then(({ data }) => {
          this.applicants = data;
        });
    }
  },
  mounted() {
    EventBus.$on("update-table", this.updateApplicantsList);
    this.getPendingApplicants();
  },
  destroyed() {
    EventBus.$off("update-table", this.updateApplicantsList);
  }
};
</script>

<style>
</style>