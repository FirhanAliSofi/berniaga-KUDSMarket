<template>
  <div class="p-4">
    <h4 class="mb-2">
      Akun anda belum diverifikasi
    </h4>
    <b-alert
      variant="primary"
      show
    >
      <div class="alert-body">
        <p>
          <strong>Info: </strong>
          <span>Akun anda belum diverifikasi harap menunggu 1-3 hari untuk diverifikasi </span>
          <span> for more details.</span>
        </p>
        <b-button
          variant="gradient-primary"
          class="mt-2 mb-1"
          @click="logout()"
        >
          Kembali ke halaman login
        </b-button>
      </div>
    </b-alert>
  </div>
</template>

<script>
import { BAlert, BButton } from 'bootstrap-vue'
import useJwt from '@/auth/jwt/useJwt'

export default {
  components: {
    BAlert,
    BButton,
  },
  methods: {
    logout() {
      // Remove userData from localStorage
      // ? You just removed token from localStorage. If you like, you can also make API call to backend to blacklist used token
      localStorage.removeItem(useJwt.jwtConfig.storageTokenKeyName)
      localStorage.removeItem(useJwt.jwtConfig.storageRefreshTokenKeyName)

      // Remove Login from localStorage
      sessionStorage.removeItem('token')

      // Remove userData from localStorage
      localStorage.removeItem('userData')
      localStorage.removeItem('userToko')
      localStorage.removeItem('id_seller')
      localStorage.removeItem('id_toko')
      localStorage.removeItem('statusVerifikasi')

      // Reset ability
      // this.$ability.update(initialAbility)

      // Redirect to login page
      this.$router.push({ name: 'login' })
    },
  },
}
</script>
