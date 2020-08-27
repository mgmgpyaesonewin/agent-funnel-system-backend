<template>
    <div>
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label>Role</label>
            <select class="form-control" name="role" v-model="role">
                <option value="is_admin">Admin</option>
                <option value="is_bdm">BDM</option>
                <option value="is_ma">MA</option>
                <option value="partner">Partner</option>
            </select>
        </div>
        <div class="form-group" v-if="show_partner">
            <label>Partner</label>
            <select class="form-control" v-model="selected_partner" name="partner_id">
                <option v-for="option in partnerArray" v-bind:value="option.id">
                    {{ option.company_name }}
                </option>
            </select>
        </div>
        <div class="form-group" v-if="show_bdm">
            <label>BDMs</label>
            <select class="form-control" name="user_id">
              <option value="">-- Choose --</option>
              <option v-for="item in bdms" :value="item.id">{{ item.name }}</option>
            </select>
        </div>
    </div>
</template>
<script>
import { EventBus } from "../event-bus.js";
import Constant from "../constant.js";

export default {
  props: [
    "partnerArray"
  ],
  data() {
    return {
      show_partner:false,
      show_bdm: false,
      role:"",
      selected_partner: "",
      bdms : []
    };
  },
  watch: {
      'role': function(val, preVal){
        if (val == 'partner') 
          this.show_partner = true;
        else
          this.show_partner = false;
        
        if (val == 'is_ma') 
        { 
            axios
                .get(
                `/user/get_bdm_list`,
                {},
                { responseType: "blob" }
                )
                .then((res) => {
                console.log(res.data);
                this.bdms = res.data;
                })
                .catch((e) => {
                console.log(e);
                });

            this.show_bdm = true;
        }          
        else
          this.show_bdm = false;
      }
  }
};
</script>

<style>
</style>
