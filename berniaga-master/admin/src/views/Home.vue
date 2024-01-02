<template>
  <div class="combined-card">
    <!-- Penjual Aktif -->
    <div class="horizontal-card">
      <statistic-card-horizontal
        icon="UserPlusIcon"
        :statistic="seller"
        statistic-title="Penjual Aktif"
        style="max-width:300px"
      />
    </div>
    <!-- Pengguna Aktif -->
    <div class="horizontal-card">
      <statistic-card-horizontal
        icon="UserIcon"
        :statistic="user"
        statistic-title="Pengguna Aktif"
        style="max-width:300px"
      />
    </div>
    <!-- Transaksi -->
    <div class="horizontal-card">
      <statistic-card-horizontal
        icon="DollarSignIcon"
        statistic="86%"
        statistic-title="Transaksi"
        style="max-width:300px"
      />
    </div>
    <!-- Produk -->
    <div class="horizontal-card">
      <statistic-card-horizontal
        icon="ShoppingBagIcon"
        :statistic="produk"
        statistic-title="Produk"
        style="max-width:300px"
      />
      {{ seller }}
    </div>
  </div>
</template>

<style>
.combined-card {
  display: flex;
  justify-content: space-between;
}

.vertical-card,
.horizontal-card {
  flex: 1;
  margin-right: 10px;
}
</style>

<script>
import StatisticCardHorizontal from '@core/components/statistics-cards/StatisticCardHorizontal.vue'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
  components: {
    StatisticCardHorizontal,
  },
  data() {
    return {
      seller: 0,
      user: 0,
      transaksi: 0,
      produk: 0,
    }
  },
  created() {
    this.getData()
  },
  mounted() {
    this.getData()
  },
  methods: {
    fetchUserData() {
      // Lakukan permintaan HTTP untuk mengambil data pengguna dari server
      // Misalnya, menggunakan Axios atau Fetch API
      // Setelah mendapatkan data pengguna, perbarui nilai-nilai statistik
      // dengan data yang sesuai
      // Contoh:
      // Misalnya, jumlah penjual aktif yang diperoleh dari server
      // this.user = 600 // Misalnya, jumlah pengguna aktif yang diperoleh dari server
      // this.transactionCount = 500 // Misalnya, jumlah transaksi yang diperoleh dari server
      // this.produk = 1000 // Misalnya, jumlah produk yang diperoleh dari server
    },

    getData() {
      this.$http.get('seller-count').then(response => {
        console.log(response.data.status)
        if (response.data.status) {
          this.seller = response.data.count
        } else {
          this.$toast({
            component: ToastificationContent,
            props: {
              title: response.data.message,
              icon: 'EditIcon',
              variant: 'danger',
            },
          })
        }
      })
      this.$http.get('user-count').then(response => {
        console.log(response.data.status)
        if (response.data.status) {
          this.user = response.data.count
        } else {
          this.$toast({
            component: ToastificationContent,
            props: {
              title: response.data.message,
              icon: 'EditIcon',
              variant: 'danger',
            },
          })
        }
      })
      this.$http.get('produk-count').then(response => {
        console.log(response.data.status)
        if (response.data.status) {
          this.produk = response.data.count
        } else {
          this.$toast({
            component: ToastificationContent,
            props: {
              title: response.data.message,
              icon: 'EditIcon',
              variant: 'danger',
            },
          })
        }
      })
    },
  },
}
</script>
