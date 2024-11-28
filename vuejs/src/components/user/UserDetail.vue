<template>
  <div class="mx-4 my-4">
    <div class="d-flex align-center pe-2 mx-4 my-2">
      <v-label>
        <h2 class="px-2">
          User Detail
        </h2>
      </v-label>
      <v-spacer></v-spacer>
      <v-btn @click="$emit('switch-component','UserList')">Back</v-btn>
    </div>
    <v-divider class="mx-4" />
    <v-card class="mx-4 my-4 ">
      <v-card-title class="bg-indigo-lighten-1 ">
        Detail
      </v-card-title>
      <v-divider/>
      <v-card-text>
        ID : {{ dataId }}
      </v-card-text>
    </v-card>
    <br>
  </div>
</template>

<script>
export default {
  name: 'UserDetail',
  props: {
    dataId: {
      type: Number,
      default: null
    }
  },
  data(){

    return {

    }
  }
}
</script>

<style lang="scss" scoped>

</style>
