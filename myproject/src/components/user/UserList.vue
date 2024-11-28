<template>
  <div class="mx-4 my-4">
    <div class="d-flex align-center pe-2 mx-4 my-2">
      <v-label>
        <h2 class="px-2">
          User
        </h2>
      </v-label>
      <v-spacer></v-spacer>
      <v-btn @click="$emit('switch-component','UserCreate')">Add User</v-btn>
    </div>
    <v-divider class="mx-4" />
    <v-card class="mx-4 my-4 ">
      <v-card-title class="bg-indigo-lighten-1 ">
        List Of Users
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

          <template v-slot:item.actions="{ item }">
            <v-btn @click="$emit('switch-component','UserDetail',item.id)">
              Detail
            </v-btn>
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
    name: 'UserList',
    data () {
      return {
        search: '',
        headers: [
          { title: 'ID', key: 'id' },
          { title: 'Username', key: 'name' },
          { title: 'First Name', key: 'firstname' },
          { title: 'Last Name', key: 'lastname' },
          { title: 'Actions',name : 'action', value: 'actions', sortable: false }, // Add a column for actions

        ],
        items: [],
      }
    },
    methods: {
      async getItem(){
        try {
          const response = await api.get('/user'); // Replace with your API endpoint
          this.items = response.data;
          console.log(response);
        } catch (error) {
          console.error('Error fetching data:', error);
        }
      },
      viewDetails(item) {

      },
    },
    mounted(){
      this.getItem();
    }
  }
</script>


<style lang="scss" scoped>

</style>
