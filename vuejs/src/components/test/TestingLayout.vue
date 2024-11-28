<template>
  <v-card
    class="mx-auto"
    max-width="300"
  >
  <v-list :items="items"></v-list>

  </v-card>
</template>

<script>
export default {
  name: 'TestingLayout',
  data: () => ({
    items: [
      {
        title : '',
        type: 'subheader',
        props: {
          prependIcon: 'mdi-account',
        },
      },
      { title: 'Real-Time', value: 1 ,
        props: {
          prependIcon: 'mdi-api',
        },
      },
      { title: 'Audience', value: 2 ,
        props: {
          prependIcon: 'mdi-account',
        },
      },
      { type: 'divider' },
      {
        title : 'Setting',
        type: 'subheader',
      },
      { title: 'Conversions', value: 3 ,
        props: {
          prependIcon: 'mdi-account',
        },
      },

    ],
  }),
  methods: {
    testing(){
      console.log("");
    }
  },
  mounted(){
    this.testing();
  }
}
</script>

<style lang="scss" scoped>

</style>
