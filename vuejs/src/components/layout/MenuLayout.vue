<template>
  <v-card>
    <v-layout>
      <v-navigation-drawer
        v-model="drawer"
        :rail="rail"
        permanent
        @click="rail = false"
        @mouseover="mouseOn"
        @mouseleave="mouseOff">
        <v-list-item
          prepend-avatar="https://randomuser.me/api/portraits/men/85.jpg"
          :title="username"
          >
          <template v-slot:append>
            <v-btn
              icon="mdi-chevron-left"
              variant="text"
              @click.stop="rail = !rail"
            ></v-btn>
          </template>
        </v-list-item>

        <v-divider></v-divider>

        <v-list density="compact" nav>
          <v-list-item
            v-for="item in menu"
            :prepend-icon="item.menuicon"
            :title="item.menuTitle"
            :value="item.menuValue"
            :active="item.menuStatus" @click="updateComponent(item.menuComponent)"
            @mouseover="mouseOn"
            @mouseleave="mouseOff"

          ></v-list-item>
        </v-list>
        <v-divider></v-divider>
        <v-list density="compact" nav>
          <v-list-item
            prepend-icon="mdi-door"
            title="Log Out"
            value="logout"
            @click="logout"
            @mouseover="mouseOn"
            @mouseleave="mouseOff"

            ></v-list-item>
        </v-list>

      </v-navigation-drawer>
      <v-main>
        <component :is="currentComponent" />
        <v-footer class="bg-indigo-lighten-1 text-center d-flex flex-column">
          <div>
            <v-btn
              v-for="icon in icons"
              :key="icon"
              :icon="icon"
              class="mx-4"
              variant="text"
            ></v-btn>
          </div>

          <div class="pt-0">
            Phasellus feugiat arcu sapien, et iaculis ipsum elementum sit amet. Mauris cursus commodo interdum. Praesent ut risus eget metus luctus accumsan id ultrices nunc. Sed at orci sed massa consectetur dignissim a sit amet dui. Duis commodo vitae velit et faucibus. Morbi vehicula lacinia malesuada. Nulla placerat augue vel ipsum ultrices, cursus iaculis dui sollicitudin. Vestibulum eu ipsum vel diam elementum tempor vel ut orci. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
          </div>

          <v-divider></v-divider>

          <div>
            {{ new Date().getFullYear() }} — <strong>Vuetify</strong>
          </div>
        </v-footer>
      </v-main>

    </v-layout>

  </v-card>
  <v-snackbar
    v-model="snackbar"
    :timeout="timeout">
    {{ text }}
  </v-snackbar>
  <div class="text-center pa-4">

    <v-dialog
      v-model="dialog"
      width="auto"
    >
      <v-card
        max-width="400"
        prepend-icon="mdi-update"
        text="Please Log in again"
        title="Session expired"
      >
        <template v-slot:actions>
          <v-btn
            class="ms-auto"
            text="Ok"
            @click="dialog = false"
          ></v-btn>
        </template>
      </v-card>
    </v-dialog>

  </div>
</template>
<script>
import api from '@/auth';
import axios from 'axios';
import UserItem from '../user/UserItem.vue';
import PermissionItem from '../permission/PermissionItem.vue';
import TokenItem from '../token/TokenItem.vue';

  export default {
    name: 'MenuLayout',
    components: {
      UserItem,
      PermissionItem,
      TokenItem,
    },
    data () {
      return {
        snackbar: true,
        icons: [
          'mdi-facebook',
          'mdi-twitter',
          'mdi-linkedin',
          'mdi-instagram',
        ],
        timeout: 2000,
        text: 'Welcome back',
        username : null,
        drawer: true,
        rail: true,
        menu : [
          {menuicon : 'mdi-account', menuStatus: false , menuTitle: 'User', menuValue: 'user', menuComponent: 'UserItem'},
          {menuicon : 'mdi-wrench', menuStatus: false , menuTitle: 'Permission', menuValue: 'permission', menuComponent: 'PermissionItem'},
          {menuicon : 'mdi-api', menuStatus: false , menuTitle: 'Token', menuValue: 'token', menuComponent: 'TokenItem'},

        ],
        currentComponent : '',
      }
    },
    mounted(){
      this.connection();
      if(localStorage.getItem('authToken') == null){
        return this.$router.push('/');
      }else{
        this.connection();
        this.auth();
        const storedComponent = localStorage.getItem('currentComponent');
        if (storedComponent) {
          this.currentComponent = storedComponent;
          this.rail = false;
          this.updateComponent(storedComponent); // Ensure menu status is correct
        } else {
          this.updateComponent('UserItem');
        }
      }
    },
    methods: {
      updateComponent(componentName) {
        // Update the menu status
        this.menu.forEach(item => {
          item.menuStatus = false;
        });
        const menuItem = this.menu.find(item => item.menuComponent === componentName);
        menuItem.menuStatus = true;
        if (menuItem) {
          this.currentComponent = componentName;
          // Store the current component in localStorage
          localStorage.setItem('currentComponent', componentName);
          setTimeout(() => {
            this.rail = true;
          }, 3000);
        }
        console.log(componentName);
      },
      async auth(){
        try {
          const response = await api.get('/auth'); // Replace with your API endpoint
          this.username = response.data.name;
          console.log(response);

        } catch (error) {
          console.error('Error fetching data:', error);
        }
      },
      connection(){
        axios.get('http://first-project.local:8000/api/connection').then(response => {
          console.log(response);
          if(response.data.status == "fail"){
            localStorage.removeItem('authToken');
            localStorage.removeItem('currentComponent');
            return this.$router.push('/');
          }
        }).catch(error => {
        });
      },
      mouseOn(){
        this.rail = false;
      },
      mouseOff(){
        this.rail = true;
      },
      logout() {
        // console.log(localStorage.getItem('token'))
        localStorage.removeItem('authToken');
        localStorage.removeItem('currentComponent');
        return this.$router.push('/');
      },

    },
  }
</script>

<style>
</style>
