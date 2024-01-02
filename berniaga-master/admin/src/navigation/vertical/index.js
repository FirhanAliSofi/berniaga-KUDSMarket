export default [
  {
    title: 'Home',
    route: 'home',
    icon: 'HomeIcon',
  },
  // {
  // title: 'Second Page',
  //   route: 'second-page',
  //   icon: 'FileIcon',
  // },
  {
    title: 'Data Admin',
    route: 'index-admin',
    icon: 'UserIcon',
  },
  {
    title: 'Seller',
    route: 'seller-index',
    icon: 'UserIcon',
    children: [
      {
        title: 'Data Seller',
        route: 'seller-index',
      },
      {
        title: 'Belum Verifikasi',
        route: 'seller-belum-verifikasi',
      },
    ],
  },
  // {
  //   title: 'Kategori Global',
  //   route: 'kategori-global',
  //   icon: 'ServerIcon',
  // },
  // {
  //   title: 'Tipe Varian',
  //   route: 'tipe-varian',
  //   icon: 'ServerIcon',
  // },
  // {
  //   title: 'User Seller ',
  //   route: 'user-seller',
  //   icon: 'FileIcon',
  // },
]
