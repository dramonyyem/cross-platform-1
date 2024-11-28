<template>
  <div class="mx-4 my-4">
    <div class="d-flex align-center pe-2 mx-4 my-2">
      <v-label>
        <h2 class="px-2">
          Token
        </h2>
      </v-label>
      <v-spacer></v-spacer>
    </div>
    <v-divider class="mx-4" />
    <v-card class="mx-4 my-4 ">
      <v-card-title class="bg-indigo-lighten-1 ">
      List Of Tokens
      </v-card-title>
      <v-divider/>
      <v-card-text>
        <v-data-table
          :headers="headers"
          :items="items"
          :search="search"
          item-value="name"
          items-per-page="10"
        >
          <template v-slot:top>
            <v-text-field
              v-model="search"
              class="pa-2"
              label="Search"
            ></v-text-field>
          </template>
        </v-data-table>
      </v-card-text>
    </v-card>
    <br>
  </div>
</template>
<script>
import api from '@/auth';


  export default {
    name : 'TokenList',
    data(){
      return {
        search: '',
        headers: [
          { title: 'ID', key: 'id' },
          { title: 'Name', key: 'name' },
          { title: 'Token', key: 'token' },
          { title: 'Expired', key: 'expires_at' },
        ],
        items: [],
      }
    },
    methods:{
      async getData(){
        try {
          const response = await api.get('/api');
          this.items = response.data;
        }catch(error){
          console.log(error);
        }

      }
    },
    mounted(){
      this.getData();
    }
  }
</script>

<style lang="scss" scoped>

</style>
