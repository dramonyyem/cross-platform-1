<template>
  <component :is="currentComponent" @switch-component="switchComponent" />
</template>

<script>
import PermissionList from './PermissionList.vue';

  export default {
    name: 'PermissionItem',
    components: {
      PermissionList
    },
    data () {
      return {
        currentComponent: 'PermissionList',
      }
    },
    methods: {
      switchComponent(componentName) {
        console.log(componentName);
      },
      currentComponentData(){

      }
    },


  }
</script>

<style lang="scss" scoped>

</style>
