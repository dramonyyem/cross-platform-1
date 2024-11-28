
/**
 * router/index.ts
 *
 * Automatic routes for `./src/pages/*.vue`
 */

// Composables
import LogIn from '@/components/auth/LogIn.vue';
import MenuLayout from '@/components/layout/MenuLayout.vue';
import MenuLayout2 from '@/components/layout/MenuLayout2.vue';
// import TestingLayout from '@/components/test/TestingLayout.vue';
// import TokenList from '@/components/token/TokenList.vue';
import { createRouter, createWebHistory } from 'vue-router/auto'
// import { routes } from 'vue-router/auto-routes'

const routes = [
  { path: '/' , component: LogIn },
  { path: '/welcome', component: MenuLayout },
  { path:'/testing', component: MenuLayout2 }
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
})

// Workaround for https://github.com/vitejs/vite/issues/11804
router.onError((err, to) => {
  if (err?.message?.includes?.('Failed to fetch dynamically imported module')) {
    if (!localStorage.getItem('vuetify:dynamic-reload')) {
      console.log('Reloading page to fix dynamic import error')
      localStorage.setItem('vuetify:dynamic-reload', 'true')
      location.assign(to.fullPath)
    } else {
      console.error('Dynamic import error, reloading page did not fix it', err)
    }
  } else {
    console.error(err)
  }
})

router.isReady().then(() => {
  localStorage.removeItem('vuetify:dynamic-reload')
})

export default router
