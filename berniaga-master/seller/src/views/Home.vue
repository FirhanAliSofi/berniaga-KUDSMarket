<template>
<b-form>
  <b-card>
    <b-row>
      <!-- Penjual Aktif -->
      <div class="d-flex flex-sm-row flex-column justify-content-between align-items-start">
        <b-media>
          <template #aside>
            <b-avatar variant="success">
            <feather-icon icon="UserPlusIcon" />
            </b-avatar>
          </template>
          <h6>Penjual Aktif</h6>
          <span class="text-muted">jumlah penjual aktif</span>
        </b-media>
    </div>
    <!-- Pengguna Aktif -->
    <div class="d-flex flex-sm-row flex-column justify-content-between align-items-start">
        <b-media>
          <template #aside>
            <b-avatar variant="success" style="margin-left: 3rem;">
            <feather-icon icon="UserIcon" />
            </b-avatar>
          </template>
          <h6>Pengguna Aktif</h6>
          <span class="text-muted">jumlah pengguna aktif</span>
        </b-media>
    </div>
    <!-- Transaksi -->
    <div class="d-flex flex-sm-row flex-column justify-content-between align-items-start">
        <b-media>
          <template #aside>
            <b-avatar variant="success" style="margin-left: 3rem;">
            <feather-icon icon="DollarSignIcon" />
            </b-avatar>
          </template>
          <h6>Total Transaksi</h6>
          <span class="text-muted">total transaksi</span>
        </b-media>
    </div>
    <!-- Produk -->
    <div class="d-flex flex-sm-row flex-column justify-content-between align-items-start" >
        <b-media>
          <template #aside>
            <b-avatar variant="success" style="margin-left: 3rem;">
            <feather-icon icon="ShoppingBagIcon" />
            </b-avatar>
          </template>
          <h6>Produk</h6>
          <span class="text-muted">produk</span>
        </b-media>
    </div>
  </b-row>
  </b-card>
</b-form>
</template>

<script>
import {
  BAvatar,
  BCard,
  BRow,
  BForm,
  BMedia,
}
from 'bootstrap-vue'

export default {
  components: {
    BAvatar,
    BCard,
    BRow,
    BForm,
    BMedia,
  },
}
</script>

<style>

</style>
