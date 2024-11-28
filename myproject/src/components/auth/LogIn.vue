<template>
  <v-sheet class="pa-12" rounded>
    <v-card class="mx-auto px-6 py-8" max-width="344">
      <v-form>
        <v-text-field
          v-model="formData.name"
          class="mb-2"
          label="Name"
          clearable
        ></v-text-field>

        <v-text-field
          v-model="formData.password"
          label="Password"
          type="password"
          placeholder="Enter your password"
        ></v-text-field>

        <br>

        <v-btn
          :loading="loading"
          color="success"
          size="large"
          type="button"
          variant="elevated"
          block
          @click="onSubmitForm"
        >
          Sign In
        </v-btn>
        <br>
      </v-form>
    </v-card>
  </v-sheet>
  <v-snackbar
      v-model="snackbar"
      :timeout="timeout">
      {{ text }}
  </v-snackbar>
</template>

<script>

import axios from 'axios';

export default {
  name: "LogInItem",
  data(){
    return {
      snackbar: false,
      text: 'Connection Lost',
      formData: {
        name: null,
        password: null,
      },
      loading: false,
    }
  },
  methods: {
     onSubmitForm () {
      this.loading = true;
      console.log(this.$data.formData);
      axios.post('http://first-project.local:8000/api/login',this.$data.formData).then(response => {
        // Save token to local storage
        // console.log(response);
        if(response.data.status == "success"){
          localStorage.setItem('authToken', response.data.token);
          return this.$router.push('/welcome');
        }
        // if(localStorage.getItem('token') != null && localStorage.getItem('token') != ''){
        //   return this.$router.push('/welcome');
        // }
      }).catch(error => {
        this.snackbar = true;
        this.loading = false;
      });
    },
    // btnRegistration(){
    //   return this.$router.push('/registration');
    // },
    // required (v) {
    //   return !!v || 'Field is required'
    // },
  },
  mounted(){
    console.log(localStorage.getItem('authToken'));
    if(localStorage.getItem('authToken') != null && localStorage.getItem('authToken') != ""){
    }
  }
}
</script>

<style>

</style>
