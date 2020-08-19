<template>
  <div class="d-flex">
    <div class="px-2">
      <fieldset class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" placeholder="Name" v-model="name" />
      </fieldset>
    </div>
    <div class="px-2" v-show="channelForm">
      <fieldset class="form-group">
        <label for="name">Channel</label>
        <input type="email" class="form-control" placeholder="Channel" v-model="email" />
      </fieldset>
    </div>
    <div class="px-2" v-show="assignField">
      <fieldset class="form-group">
        <label for="name">Assign</label>
        <input type="text" class="form-control" placeholder="Name" />
      </fieldset>
    </div>
    <div class="px-2">
      <fieldset class="form-group">
        <label for="name">Status</label>
        <multi-select
          v-model="selected_status"
          :options="statusesArray"
          :multiple="true"
          :close-on-select="false"
          :clear-on-select="false"
          :preserve-search="true"
          placeholder="Pick some"
          label="title"
          track-by="id"
        >
          <template slot="selection" slot-scope="{ values, isOpen }">
            <span
              class="multiselect__single"
              v-if="values.length && !isOpen"
            >{{ values.length }} options selected</span>
          </template>
        </multi-select>
      </fieldset>
    </div>
    <div class="px-2" v-show="examDate">
      <fieldset class="form-group">
        <label for="name">Exam Date</label>
        <date-picker
          format="DD-MM-YYYY"
          type="date"
          value-type="format"
          v-model="date"
          placeholder="dd-mm-yyyy"
          :disabled-date="notBeforeToday"
        />
      </fieldset>
    </div>
    <div class="px-2">
      <div class="row mt-2">
        <button
          type="button"
          class="btn btn-primary waves-effect waves-light mr-1"
          @click="search"
        >Search</button>
        <button
          v-show="enableExport"
          type="button"
          class="btn btn-info waves-effect waves-light"
          @click="exportSheet()"
        >Export</button>
      </div>
    </div>
  </div>
</template>

<script>
import { EventBus } from "../event-bus.js";
import DatePicker from "vue2-datepicker";
import fileDownload from "js-file-download";
import "vue2-datepicker/index.css";

export default {
  props: [
    "statusesArray",
    "currentStatus",
    "assignField",
    "examDate",
    "channelForm",
    "exportUrl",
    "enableExport",
  ],
  data() {
    return {
      email: "",
      name: "",
      selected_status: [],
      date: "",
    };
  },
  methods: {
    search() {
      let selected_status = this.selected_status.map((status) => status.id);
      EventBus.$emit(
        "filter-table",
        this.currentStatus,
        selected_status,
        this.name,
        this.date
      );
    },
    exportSheet() {
      axios
        .post(
          `/applicants/export/${this.exportUrl}`,
          {},
          { responseType: "blob" }
        )
        .then((res) => {
          console.log(res);
          fileDownload(res.data, "export.xlsx");
        })
        .catch((e) => {
          console.log(e);
        });
    },
    notBeforeToday(date) {
      return date < new Date(new Date().setHours(0, 0, 0, 0));
    },
  },
};
</script>

<style>
</style>