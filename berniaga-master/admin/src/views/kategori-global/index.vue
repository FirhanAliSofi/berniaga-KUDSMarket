<template>
  <b-card title="Data Kategori Global ">
    <b-row>
      <b-col>
        <b-button
          v-ripple.400="'rgba(113, 102, 240, 0.15)'"
          variant="success"
          size="lg"
          :to="{ name: 'create-kategori-global' }"
        >
          <feather-icon
            icon="PlusCircleIcon"
            class="mr-75"
            size="25"
          />
          <span class="align-middle">Tambah Kategori Global</span>
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
        <template #cell(id_role)="data">
            <b-badge :variant="id_role[1][data.value]">
              {{ id_role[0][data.value] }}
            </b-badge>
          </template>
          <template #cell(action) ="data">
            <b-button-group>
              <b-button
                v-ripple.400="'rgba(40, 199, 111, 0.15)'"
                variant="warning"
                size="sm"
                :to="{ name: 'edit-user', params: { id: data.item.id } }"
              >
                <span class= "align-middle">Edit</span>
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
  BCard, BTable, BRow, BCol, BFormGroup, BFormSelect, BPagination, BInputGroup, BFormInput, BInputGroupAppend, BButton, BButtonGroup, BBadge,
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
      fields: [
        {
          key: 'id', label: 'Id',
        },
        { key: 'nama_kategori', label: 'Nama Kategori', sortable: true },
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
  mounted() {
    // Set the initial number of items
    this.totalRows = this.items.length
    this.getData()
  },
  methods: {
    getData() {
      this.$http.get('kategori-global').then(response => {
        if (response.data.status) {
          this.items = response.data.data
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
          this.$http.delete(`/user/${id}`).then(response => {
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

</style>
