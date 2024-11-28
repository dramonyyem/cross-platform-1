<template>
  <v-card>
    <v-layout>
      <v-navigation-drawer
        v-model="drawer"
        permanent
      >
        <v-list-item
          prepend-avatar="https://randomuser.me/api/portraits/men/85.jpg"
          :title="username"
          >
        </v-list-item>
        <v-list>
          <v-divider></v-divider>
          <template v-for="item in treemenu">
            <v-list-item :title="item.title" :prepend-icon="item.menuIcon" :value="item.value" v-if="item.menutype == 'testing'">

            </v-list-item>

            <v-list-group v-if="item.menutype == 'tree'">
              <template v-slot:activator="{ props }" >
                <v-list-item
                  v-bind="props"
                  :prepend-icon="item.menuIcon"
                  :title="item.title"
                ></v-list-item>
              </template>
                <v-list-item v-for="subitem in item.submenu"
                  :title="subitem.submenuTitle"
                  :value="subitem.submenuValue">
                </v-list-item>
            </v-list-group>
          </template>

          <!-- <v-list-group v-for="item in treemenu">
            <template v-slot:activator="{ props }" >
              <v-list-item
                v-bind="props"
                :prepend-icon="item.menuIcon"
                :title="item.title"
              ></v-list-item>
            </template>
              <v-list-item v-for="subitem in item.submenu"
                :title="subitem.submenuTitle"
                :value="subitem.submenuValue">
              </v-list-item>
          </v-list-group> -->
        </v-list>
      </v-navigation-drawer>
      <v-main style="height: 600px"></v-main>
    </v-layout>
  </v-card>
</template>
<script>
import api from '@/auth';

  export default {
    data () {
      return {
        drawer: true,
        rail: true,
        username : null,
        // menu: [
        //   {
        //     value: 'home',
        //     title: 'Home',
        //     menuIcon : 'mdi-home-circle',
        //   }
        // ],
        treemenu: [
          {
            value: 'home',
            title: 'Home',
            menuIcon : 'mdi-home-circle',
            menutype : 'testing',
            submenu : [],
          },
          {
            value: 'users',
            title: 'Users',
            menuIcon : 'mdi-account-circle',
            menutype : 'tree',
            submenu : [
              { submenuTitle : 'Permission' , submenuValue : 'permission' },
              { submenuTitle : 'Create' , submenuValue : 'create' },
            ],
          },
          {
            value: 'api',
            title: 'API',
            menuIcon : 'mdi-api',
            menutype : 'testing',
            submenu : [],
          },

        ],
      }
    },
    methods: {
      async auth(){
        try {
          const response = await api.get('/auth'); // Replace with your API endpoint
          this.username = response.data.name;
          console.log(response);

        } catch (error) {
          console.error('Error fetching data:', error);
        }
      },
    },
    created(){
      this.auth();
    }

  }
</script>
