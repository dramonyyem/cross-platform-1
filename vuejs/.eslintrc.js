module.exports = {
  root: true,
  env: {
    node: true,
  },
  extends: [
    'plugin:vue/vue3-essential',
    'eslint:recommended',
  ],
  "vue/valid-v-slot": ["error", {
    "allowModifiers": false
  }]
}
