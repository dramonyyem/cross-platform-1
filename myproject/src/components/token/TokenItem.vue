<template>
  <component :is="currentComponent" @switch-component="switchComponent" />
</template>

<script>
import TokenList from './TokenList.vue';

  export default {
    name: 'TokenItem',
    components: {
      TokenList
    },
    data () {
      return {
        currentComponent: 'TokenList',
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
