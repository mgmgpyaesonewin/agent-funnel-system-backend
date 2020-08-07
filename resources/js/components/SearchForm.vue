<template>
  <div class="row">
    <div class="col-3">
      <fieldset class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" placeholder="Name" v-model="name" />
      </fieldset>
    </div>
    <div class="col-2">
      <fieldset class="form-group">
        <label for="name">Channel</label>
        <input type="email" class="form-control" placeholder="Channel" v-model="email" />
      </fieldset>
    </div>
    <div class="col-2" v-show="assignField">
      <fieldset class="form-group">
        <label for="name">Assign</label>
        <input type="text" class="form-control" placeholder="Name" />
      </fieldset>
    </div>
    <div class="col-2">
      <fieldset class="form-group">
        <label for="name">Status</label>
        <select class="form-control" id="basicSelect" v-model="selected_status">
          <option
            v-for="(status,index) in statusesArray"
            :key="index"
            :value="status.id"
          >{{ status.title }}</option>
        </select>
      </fieldset>
    </div>
    <div class="col-3">
      <div class="row mt-2">
        <button
          type="button"
          class="btn btn-primary waves-effect waves-light mr-1"
          @click="search"
        >Search</button>
        <button type="button" class="btn btn-info waves-effect waves-light">Export</button>
      </div>
    </div>
  </div>
</template>

<script>
import { EventBus } from "../event-bus.js";

export default {
  props: ["statusesArray", "assignField"],
  data() {
    return {
      email: "",
      name: "",
      selected_status: "",
    };
  },
  methods: {
    search() {
      EventBus.$emit(
        "filter-table",
        1,
        this.selected_status,
        this.email,
        this.name
      );
    },
  },
};
</script>

<style>
</style>