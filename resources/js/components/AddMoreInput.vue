<template>
  <div class="col-8">
    <div class="row mb-2" v-for="(n, index) in length" :key="index">
      <label class="form-check-label" for="template_name">Additional Info</label>
      <div class="input-group">
        <input
          type="text"
          class="form-control"
          placeholder="Additional Information"
          name="additional_info[]"
        />
        <div class="input-group-append">
          <button class="btn btn-outline-primary" type="button" @click="remove">
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
  data() {
    return {
      length: 0,
    };
  },
  methods: {
    add() {
      this.length += 1;
    },
    remove() {
      this.length -= 1;
    },
  },
};
</script>

<style>
</style>