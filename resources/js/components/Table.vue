<template>
  <div class="table-responsive">
    <div class="row" v-if="!isApplicantsEmpty">
      <div class="col-3">
        <h5 style="text-align: initial;line-height: 3rem;">
          Total
          <span class="badge badge-primary">{{ applicants.meta.total }}</span> records found.
        </h5>
      </div>
      <div class="col-4" v-show="amlStatus && isPartner == 0">
        <div class="btn-group pull-left">
          <button type="button" class="btn btn-success" @click="updateAMLStatus(1)">Pass</button>
          <button type="button" class="btn btn-danger" @click="updateAMLStatus(2)">Fail</button>
        </div>
      </div>
      <div v-show="userAssign === true && isPartner == 0" class="col-5 d-flex">
        <multi-select
          v-model="selectedUser"
          :options="users"
          :show-labels="false"
          :allow-empty="false"
          openDirection="bottom"
          track-by="id"
          label="name"
          deselect-label="You must choose at least one user"
          placeholder="Choose a User"
        >
          <template slot="singleLabel" slot-scope="{ option }">
            <strong>{{ option.name }}</strong>
            is assign as {{ option.role }}
          </template>
        </multi-select>
        <button class="btn btn-primary small" @click="onSelect(selectedUser)">Assign</button>
      </div>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th v-show="isPartner == 0"></th>
          <th>#</th>
          <th>Name</th>
          <th>Phone</th>
          <th v-show="amlStatus">AML/Compliance Check</th>
          <th v-show="age">Age</th>
          <th v-show="gender">Gender</th>
          <th v-show="exam">Exam Date</th>
          <th v-show="channel">Channel</th>
          <th v-show="assign">Assign</th>
          <th v-show="statusCol">Status</th>
          <th v-show="isPartner == 0">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(applicant,i) in applicants.data" :key="i">
          <td v-show="isPartner == 0">
            <fieldset>
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
            <a :href="`${$location.origin}/applicants/${applicant.id}`">{{ applicant.name}}</a>
            <br />
            <div class="badge badge-primary" v-show="tempId">{{ applicant.temp_id }}</div>
          </td>
          <td>{{ applicant.phone }}</td>
          <td v-show="amlStatus">{{ applicant.aml_status }}</td>
          <td v-show="age">{{ applicant.age}}</td>
          <td v-show="gender">{{ applicant.gender}}</td>
          <td v-show="exam">{{ applicant.exam_date }}</td>
          <td v-show="channel">{{ applicant.utm_source }}</td>
          <td v-show="assign">
            <div class="badge badge-primary">{{ applicant.admin && applicant.admin.name }}</div>
            <div class="badge badge-info">{{ applicant.bdm && applicant.bdm.name }}</div>
            <div class="badge badge-warning">{{ applicant.ma && applicant.ma.name }}</div>
            <div class="badge badge-secondary">{{ applicant.staff && applicant.staff.name }}</div>
          </td>
          <td v-show="statusCol">{{ getApplicantStatus(applicant.status_id) }}</td>
          <td v-show="isPartner == 0">
            <span
              v-if="currentStatus !== 'pmli_filter' || (applicant.aml_status == 'Passed' && currentStatus == 'pmli_filter') "
            >
              <slot :applicant="applicant"></slot>
            </span>
          </td>
        </tr>
      </tbody>
    </table>
    <v-pagination :data="applicants" @pagination-change-page="getApplicants" align="center"></v-pagination>
  </div>
</template>

<script>
import Pagination from "laravel-vue-pagination";
import { EventBus } from "../event-bus.js";
import Constant from "../constant.js";

export default {
  components: {
    "v-pagination": Pagination,
  },
  props: [
    "currentStatus",
    "status",
    "statusCol",
    "userAssign",
    "partner",
    "gender",
    "age",
    "channel",
    "assign",
    "status",
    "tempId",
    "exam",
    "amlStatus",
    "assignCheckbox",
    "isPartner",
  ],
  data() {
    return {
      constant: Constant,
      applicants: {},
      selectedApplicants: [],
      selectedUser: "",
      users: [],
      name: "",
      phone: "",
      current_status: this.currentStatus,
      status_ids: this.status,
      aml_status: "",
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
    updateApplicantsList() {
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
      axios
        .post(`applicants?page=${page}`, {
          current_status: this.current_status,
          status_id: this.status_ids,
          name: this.name,
          phone: this.phone,
          aml_status: this.aml_status,
          date: this.date,
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
    getUsers() {
      axios
        .get("users")
        .then(({ data }) => {
          this.users = data.data;
        })
        .catch((e) => {
          console.log(e);
        });
    },
    onSelect({ id, role }) {
      axios
        .post("applicants/assign", {
          user_id: id,
          applicants_ids: this.selectedApplicants,
          role: this.constant[role],
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
    updateAMLStatus(status) {
      axios
        .post(`/applicants/aml/update`, {
          ids: this.selectedApplicants,
          aml_status: status,
        })
        .then((res) => {
          if (res.status) {
            this.getApplicants();
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },
  mounted() {
    this.getApplicants();
    this.getUsers();
    EventBus.$on("update-table", this.updateApplicantsList);
    EventBus.$on(
      "filter-table",
      (currentStatus, status_ids, name, phone, aml_status, date) => {
        this.current_status = currentStatus;
        this.status_ids = status_ids;
        this.name = name;
        this.phone = phone;
        this.aml_status = aml_status;
        this.date = date;
        this.getApplicants();
      }
    );
  },
  destroyed() {
    EventBus.$off("update-table", this.updateApplicantsList);
    EventBus.$off("filter-table", this.getApplicants);
  },
};
</script>

<style scoped>
.small {
  height: 40px;
}
</style>
