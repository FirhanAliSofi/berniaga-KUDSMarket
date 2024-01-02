<template>
  <b-card title="Tambah Kategori Global ➕">
    <b-form @submit.prevent>
      <b-row>
        <!-- first name -->
        <b-col cols="12">
          <b-form-group
            label="Nama Kategori Global"
            label-for="v-nama-kategori-global"
          >
            <b-form-input
              id="v-nama-kategori-global"
              v-model="data.nama_kategori"
              placeholder="Nama Kategori Global"
            />
          </b-form-group>
        </b-col>
        <!-- submit and reset -->
        <b-col cols="12">
          <b-button
            v-ripple.400="'rgba(255, 255, 255, 0.15)'"
            type="submit"
            variant="primary"
            class="mr-1"
            @click="saveData()"
          >
            Submit
          </b-button>
          <b-button
            v-ripple.400="'rgba(186, 191, 199, 0.15)'"
            type="reset"
            variant="outline-secondary"
          >
            Reset
          </b-button>
        </b-col>
      </b-row>
    </b-form>
  </b-card>
</template>

<script>
import {
  BCard, BRow, BCol, BFormGroup, BFormInput, BForm, BButton,
} from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
  components: {
    BCard,
    BRow,
    BCol,
    BFormGroup,
    BFormInput,
    BForm,
    BButton,
  },
  directives: {
    Ripple,
  },

  data() {
    return {
      data: {
        nama_kategori: '',
      },
    }
  },
  methods: {
    saveData() {
      const data = {
        nama_kategori: this.data.nama_kategori,
      }
      this.$http.post('kategori-global-create', data).then(response => {
        if (response.data.status) {
          this.$toast({
            component: ToastificationContent,
            props: {
              title: response.data.message,
              icon: 'EditIcon',
              variant: 'success',
            },
          })
          setTimeout(() => {
            this.$router.push({ name: 'kategori-global' })
          }, 500)
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

<style lang="scss">
@import '@core/scss/vue/libs/vue-select.scss';
</style>
