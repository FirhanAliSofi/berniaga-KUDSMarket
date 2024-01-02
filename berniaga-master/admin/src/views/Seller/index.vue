<template>
  <b-card title="Data Seller 📃">
    <b-row>
      <b-col>
        <b-button
          v-ripple.400="'rgba(113, 102, 240, 0.15)'"
          variant="success"
          size="lg"
          @click="excel()"
        >
        <feather-icon
          icon="DownloadIcon"
          class="mr-75"
          size="25"
          />
          <span class="align-middle">Download Data Seller</span>
        </b-button>
      </b-col>
    </b-row>
    <b-row>
    <b-col
      md="2"
      sm="2"
      class="my-1"
    >
      <b-form-group
        class="mb-0"
      >
        <label class="d-inline-block text-sm-left mr-50">Per page</label>
        <b-form-select
          id="perPageSelect"
          v-model="perPage"
          size="sm"
          :options="pageOptions"
          class="w-50"
        />
      </b-form-group>
    </b-col>
    <b-col
      md="4"
      sm="8"
      class="my-1"
    >
      <b-form-group
        label="Sort"
        label-cols-sm="3"
        label-align-sm="right"
        label-size="sm"
        label-for="sortBySelect"
        class="mb-0"
      >
        <b-input-group size="sm">
          <b-form-select
            id="sortBySelect"
            v-model="sortBy"
            :options="sortOptions"
            class="w-75"
          >
            <template v-slot:first>
              <option value="">
                -- none --
              </option>
            </template>
          </b-form-select>
          <b-form-select
            v-model="sortDesc"
            size="sm"
            :disabled="!sortBy"
            class="w-25"
          >
            <option :value="false">
              Asc
            </option>
            <option :value="true">
              Desc
            </option>
          </b-form-select>
        </b-input-group>
      </b-form-group>
    </b-col>
    <b-col
      md="6"
      class="my-1"
    >
      <b-form-group
        label="Filter"
        label-cols-sm="3"
        label-align-sm="right"
        label-size="sm"
        label-for="filterInput"
        class="mb-0"
      >
        <b-input-group size="sm">
          <b-form-input
            id="filterInput"
            v-model="filter"
            type="search"
            placeholder="Type to Search"
          />
          <b-input-group-append>
            <b-button
              :disabled="!filter"
              @click="filter = ''"
            >
              Clear
            </b-button>
          </b-input-group-append>
        </b-input-group>
      </b-form-group>
    </b-col>
    <b-col cols="12">
      <b-table
        striped
        hover
        responsive
        :per-page="perPage"
        :current-page="currentPage"
        :items="items"
        :fields="fields"
        :sort-by.sync="sortBy"
        :sort-desc.sync="sortDesc"
        :sort-direction="sortDirection"
        :filter="filter"
        :filter-included-fields="filterOn"
        @filtered="onFiltered"
      >
      <template #cell(id)="data">
          {{ data.index + 1 }}
          </template>
          <template #cell(nama)="data">
            <div class="row">
              <span class="col-12 mb-1" v-html="data.item.nama" />
              <b-img class="col-12 mb-1" style="min-width: 120px; height: auto;" :src="data.item.foto_wajah" v-if="data.item.foto_wajah" fluid alt="Tidak ada gambar Wajah"/>
            </div>
          </template>
          <template #cell(nik)="data">
            <div class="row">
              <span class="col-12 mb-1" v-html="data.item.nik" />
              <b-img class="col-12 mb-1" style="min-width: 120px; height: auto;" :src="data.item.foto_ktp" v-if="data.item.foto_ktp" fluid alt="Tidak ada gambar KTP"/>
            </div>
          </template>
          <template #cell(status_verifikasi)="data">
            <b-badge :variant="status[1][data.value]">
              {{ status[0][data.value] }}
            </b-badge>
        </template>
        <template #cell(action)="data">
          <b-button-group>
            <b-button
            v-ripple.400="'rgba(113, 102, 240, 0.15)'"
            variant="success"
            size="sm"
            @click="pdf(data.item.id)"
          >
            <span class="align-middle">Download Data</span>
        </b-button>
            <b-button
              v-ripple.400="'rgba(40, 199, 111, 0.15)'"
              size="sm"
              variant="danger"
              @click="deleteData(data.item.id)"
            >
              <span class="align-middle">Delete</span>
            </b-button>
          </b-button-group>
        </template>
      </b-table>
    </b-col>
    <b-col
      cols="12"
    >
      <b-pagination
        v-model="currentPage"
        :total-rows="totalRows"
        :per-page="perPage"
        align="center"
        size="sm"
        class="my-0"
      />
    </b-col>
  </b-row>
  </b-card>
</template>
<script>
import {
  BCard, BTable, BRow, BCol, BFormGroup, BFormSelect, BPagination, BInputGroup, BFormInput, BInputGroupAppend, BButton, BButtonGroup, BBadge, BImg,
} from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
  components: {
    BCard,
    BTable,
    BRow,
    BCol,
    BFormGroup,
    BFormSelect,
    BPagination,
    BInputGroup,
    BFormInput,
    BInputGroupAppend,
    BButton,
    BButtonGroup,
    BBadge,
    BImg,
  },
  directives: {
    Ripple,
  },
  data() {
    return {
      perPage: 5,
      pageOptions: [3, 5, 10],
      totalRows: 1,
      currentPage: 1,
      sortBy: '',
      sortDesc: false,
      sortDirection: 'asc',
      filter: null,
      filterOn: [],
      infoModal: {
        id: 'info-modal',
        title: '',
        content: '',
      },
      status: [{
        1: 'Sudah Verifikasi', 0: 'Belum Verifikasi',
      },
      {
        1: 'light-success', 0: 'light-danger',
      }],
      fields: [
        {
          key: 'id', label: 'Nomor',
        },
        {
          key: 'nama', label: 'Nama', sortable: true, class: 'gambar-td',
        },
        { key: 'profesi', label: 'Profesi', sortable: true },
        { key: 'email', label: 'Email', sortable: true },
        { key: 'jenis_kelamin', label: 'Jenis Kelamin', sortable: true },
        { key: 'no_telp', label: 'Nomor Telepon', sortable: true },
        { key: 'tanggal_lahir', label: 'Tanggal Lahir', sortable: true },
        {
          key: 'nik', label: 'NIK', sortable: true, class: 'gambar-td',
        },
        { key: 'alamat_lengkap', label: 'Alamat Lengkap', sortable: true },
        { key: 'kodepos', label: 'Kode Pos', sortable: true },
        { key: 'status_verifikasi', label: 'Status Verifikasi', sortable: true },
        { key: 'provinces', label: 'Provinsi', sortable: true },
        { key: 'cities.city_name', label: 'Kabupaten/Kota', sortable: true },
        { key: 'district.dis_name', label: 'Kecamatan', sortable: true },
        { key: 'subdistrict.subdis_name', label: 'Kelurahan/Desa', sortable: true },
        { key: 'action', label: 'Action' },
      ],
      items: [
      ],
    }
  },
  computed: {
    sortOptions() {
      // Create an options list from our fields
      return this.fields
        .filter(f => f.sortable)
        .map(f => ({ text: f.label, value: f.key }))
    },
  },
  created() {
    this.totalRows = this.items.length
  },
  mounted() {
    // Set the initial number of items
    this.getData()
  },
  filters: {
    strippedContent(string) {
      return string.replace(/<\/?[^>]+>/ig, ' ').substring(0, 30)
    },
  },
  methods: {
    getData() {
      this.$http.get('data-seller').then(response => {
        if (response.data.status) {
          this.items = response.data.data
          this.totalRows = response.data.data.length
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
    excel() {
      this.$http.get('/data-seller-excel', { responseType: 'arraybuffer' }).then(response => {
        const blob = new Blob([response.data], { type: 'application/vnd.ms-excel' })
        const url = window.URL.createObjectURL(blob)
        const link = document.createElement('a')
        link.href = url
        link.download = 'file.xlsx'
        link.click()
        window.URL.revokeObjectURL(url)
        this.$toast({
          component: ToastificationContent,
          props: {
            title: 'Sukses Download data',
            icon: 'DownloadIcon',
            variant: 'success',
          },
        })
      })
    },
    pdf(id) {
      this.$http.get(`export-pdf/${id}`, { responseType: 'arraybuffer' }).then(response => {
        const blob = new Blob([response.data], { type: 'application/pdf' })
        const url = window.URL.createObjectURL(blob)
        window.open(url, '_blank')

        this.$toast({
          component: ToastificationContent,
          props: {
            title: 'Sukses membuka PDF',
            icon: 'DownloadIcon',
            variant: 'success',
          },
        })
      })
    },

    deleteData(id) {
      this.$swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ml-1',
        },
        buttonsStyling: false,
      }).then(result => {
        if (result.value) {
          this.$http.delete(`/seller/delete/${id}`).then(response => {
            if (response.data.status) {
              this.$swal({
                icon: 'success',
                title: 'Deleted!',
                text: 'Your file has been deleted.',
                customClass: {
                  confirmButton: 'btn btn-success',
                },
              })
              this.getData()
            } else {
              this.$swal({
                icon: 'success',
                title: 'Deleted!',
                text: response.data.message,
                customClass: {
                  confirmButton: 'btn btn-success',
                },
              })
            }
          })
        } else if (result.dismiss === 'cancel') {
          this.$swal({
            title: 'Cancelled',
            text: 'Membatalkan untuk menghapus data!',
            icon: 'error',
            customClass: {
              confirmButton: 'btn btn-success',
            },
          })
        }
      })
    },
    info(item, index, button) {
      this.infoModal.title = `Row index: ${index}`
      this.infoModal.content = JSON.stringify(item, null, 2)
      this.$root.$emit('bv::show::modal', this.infoModal.id, button)
    },
    resetInfoModal() {
      this.infoModal.title = ''
      this.infoModal.content = ''
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length
      this.currentPage = 1
    },
  },
}
</script>
<style>
.gambar-td{
  min-width: 300px;
}
</style>
