<template>
  <component :is="currentComponent" :data-id="id" @switch-component="switchComponent" />
</template>

<script>
import UserCreate from './UserCreate.vue';
import UserDetail from './UserDetail.vue';
import UserList from './UserList.vue';


  export default {
    name: 'UserItem',
    components: {
      UserList,
      UserCreate,
      UserDetail,
    },
    data () {
      return {
        id: null,
        currentComponent: 'UserList',
      }
    },
    methods: {
      switchComponent(componentName,Id=null) {
        localStorage.setItem('subcurrentComponent', componentName);
        this.currentComponent = componentName;
        this.id = Id;
        console.log(componentName);

      },

    },
    mounted(){
    }

  }
</script>

<style lang="scss" scoped>

</style>
