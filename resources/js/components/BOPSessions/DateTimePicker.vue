<template>
  <div>
    <date-picker
      :format="format"
      :type="type"
      :placeholder="placeholder"
      value-type="format"
      v-model="value"
      :disabled-date="notBeforeToday"
    >
      <template v-slot:input="slotProps">
        <input
          :name="name"
          type="text"
          ref="input"
          v-bind="slotProps.props"
          v-on="slotProps.events"
          class="form-control"
        />
      </template>
    </date-picker>
  </div>
</template>

<script>
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";

export default {
  components: {
    "date-picker": DatePicker,
  },
  props: {
    format: String,
    type: String,
    placeholder: String,
    name: String,
  },
  data() {
    return {
      value: "",
    };
  },
  methods: {
    notBeforeToday(date) {
      return date < new Date(new Date().setHours(0, 0, 0, 0));
    },
  },
};
</script>

<style scoped>
.mx-datepicker {
  width: 100%;
}
</style>