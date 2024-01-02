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
      title: 'Home - KUDSMARKET',
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
      path: '/seller',
      name: 'seller-index',
      component: () => import('@/views/Seller/index.vue'),
      meta: {
        pageTitle: 'Seller',
        breadcrumb: [
          {
            text: 'Seller',
          },
        ],
      },
    },
    {
      path: '/kategori-global',
      name: 'kategori-global',
      component: () => import('@/views/kategori-global/index.vue'),
      meta: {
        pageTitle: 'Kategori Global',
        breadcrumb: [
          {
            text: 'Kategori global',
            active: true,
          },
        ],
      },
    },
    {
      path: '/seller-belum-verifikasi',
      name: 'seller-belum-verifikasi',
      component: () => import('@/views/Seller/index-seller-belum-verifikasi.vue'),
      meta: {
        pageTitle: 'Seller Belum Verifikasi',
        breadcrumb: [
          {
            text: 'Seller Belum Verifikasi',
          },
        ],
      },
    },
    {
      path: '/create-kategori-global',
      name: 'create-kategori-global',
      component: () => import('@/views/kategori-global/add.vue'),
      meta: {
        pageTitle: 'Create Kategori Global',
        breadcrumb: [
          {
            text: 'Create Kategori global',
            active: true,
          },
        ],
      },
    },
    {
      path: '/tipe-varian',
      name: 'tipe-varian',
      component: () => import('@/views/tipe/index.vue'),
      meta: {
        pageTitle: 'Tipe Varian',
        breadcrumb: [
          {
            text: 'Tipe Varian',
            active: true,
          },
        ],
      },
    },
    {
      path: '/create-tipe-varian',
      name: 'create-tipe-varian',
      component: () => import('@/views/tipe/add.vue'),
      meta: {
        pageTitle: 'Create Tipe Varian',
        breadcrumb: [
          {
            text: 'Create Tipe Varian',
            active: true,
          },
        ],
      },
    },
    {
      path: '/index-admin',
      name: 'index-admin',
      component: () => import('@/views/Admin/Index.vue'),
      meta: {
        pageTitle: 'Data Admin',
        breadcrumb: [
          {
            text: 'Data Admin',
            active: true,
          },
        ],
      },
    },
    {
      path: '/tambah-admin',
      name: 'tambah-admin',
      component: () => import('@/views/Admin/Add.vue'),
      meta: {
        pageTitle: 'Tambah Data Admin',
        breadcrumb: [
          {
            text: 'Tambah Data Admin',
            active: true,
          },
        ],
      },
    },
    {
      path: '/edit-admin/:id',
      name: 'edit-admin',
      component: () => import('@/views/Admin/Edit.vue'),
      meta: {
        pageTitle: 'Edit Data Admin',
        breadcrumb: [
          {
            text: 'Edit Data Admin',
            active: true,
          },
        ],
      },
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('@/views/Login.vue'),
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
  if (!token && to.name !== 'login') {
    // redirect the user to the login page
    next({ name: 'login' })
  } else {
    next()
  }
})

export default router
