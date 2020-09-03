<template>
  <div class="col-8">
    <div class="row mb-2" v-for="(data, index) in info_data" :key="index">
      <label class="form-check-label" for="template_name">Additional Info</label>
      <div class="input-group">
        <input
          type="text"
          class="form-control"
          placeholder="Additional Information"
          name="additional_info[]"
          :value="data"
        />
        <div class="input-group-append">
          <button class="btn btn-outline-primary" type="button" @click="remove(index)">
            <i class="fa fa-times" aria-hidden="true"></i> Remove
          </button>
        </div>
      </div>
    </div>
    <div class="row">
      <button type="button" class="btn btn-flat-primary mr-1 mb-1" @click="add()">
        <i class="fa fa-plus" aria-hidden="true"></i> Add More
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["additionalInfo"],
  data() {
    return {
      info_data: [],
    };
  },
  methods: {
    add() {
      this.info_data.push("");
    },
    remove(index) {
      this.info_data.splice(index, 1);
    },
  },
  mounted() {
    this.info_data = this.additionalInfo;
  },
};
</script>

<style>
</style>