import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  scrollBehavior() {
    return { x: 0, y: 0 }
  },
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('@/views/Home.vue'),
      meta: {
        pageTitle: 'Home',
        breadcrumb: [
          {
            text: 'Home',
            active: true,
          },
        ],
      },
    },
    {
      path: '/second-page',
      name: 'second-page',
      component: () => import('@/views/SecondPage.vue'),
      meta: {
        pageTitle: 'Second Page',
        breadcrumb: [
          {
            text: 'Second Page',
            active: true,
          },
        ],
      },
    },
    {
      path: '/user',
      name: 'user-index',
      component: () => import('@/views/User/Index.vue'),
      meta: {
        pageTitle: 'User',
        breadcrumb: [
          {
            text: 'User',
            active: true,
          },
        ],
      },
    },
    {
      path: '/produk/tambah-produk',
      name: 'tambah-produk',
      component: () => import('@/views/Produk/Add.vue'),
      meta: {
        pageTitle: 'Tambah Produk',
        breadcrumb: [
          {
            text: 'Tambah Produk',
            active: true,
          },
        ],
      },
    },
    {
      path: '/toko/create-toko',
      name: 'create-toko',
      component: () => import('@/views/Auth/Create-Store.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('@/views/Auth/Login.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('@/views/Auth/Register.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '/belum-diverifikasi',
      name: 'belum-diverifikasi',
      component: () => import('@/views/LayoutBelumVerifikasi.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '/error-404',
      name: 'error-404',
      component: () => import('@/views/error/Error404.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '*',
      redirect: 'error-404',
    },
  ],
})

// ? For splash screen
// Remove afterEach hook if you are not using splash screen
router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById('loading-bg')
  if (appLoading) {
    appLoading.style.display = 'none'
  }
})

router.beforeEach((to, from, next) => {
  // Check Token
  const token = sessionStorage.getItem('token') ?? null
  if (!token && to.name !== 'login' && to.name !== 'register') {
    // redirect the user to the login page
    next({ name: 'login' })
  } else {
    next()
  }
})

export default router
