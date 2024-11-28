
<template>
  <div class="mx-4 my-4">
    <div class="d-flex align-center pe-2 mx-4 my-2">
      <v-label>
        <h2 class="px-2">
          Permission
        </h2>
      </v-label>
      <v-spacer></v-spacer>
    </div>
      <v-divider class="mx-4" />
        <v-card class="mx-4 my-4 ">
          <v-card-title class="bg-indigo-lighten-1 ">
          List Of Permission
          </v-card-title>
          <v-divider/>
          <v-card-text>
          <v-data-table
            :custom-filter="filterOnlyCapsText"
            :headers="headers"
            :items="items"
            :search="search"
            item-value="name"
          >
            <template v-slot:top>
              <v-text-field
                v-model="search"
                class="pa-2"
                label="Search (UPPER CASE ONLY)"
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
    data: () => ({
      search: '',
      headers: [
        {
          title: 'ID',
          key: 'id',
        },
        {
          title: 'Permission Name',
          key: 'permission_name',
        },
        {
          title: 'Value',
          key: 'value',
        },
        {
          title: 'Permission Type',
          key: 'permission_type',
        },
      ],
      items: [],
    }),

    methods: {
      async getData(){
        try {
          const response = await api.get('/permission');
          this.items = response.data;
        }catch(error){

        }
      }
    },
    mounted(){
      this.getData();
    }
  }
</script>
