<template>
  <b-card title="Edit User ➕">
    <b-form @submit.prevent>
      <b-row>
        <!-- first name -->
        <b-col cols="12">
          <b-form-group
            label="Nama"
            label-for="v-first-name"
          >
            <b-form-input
              id="v-first-name"
              v-model="data.nama"
              placeholder="Nama"
            />
          </b-form-group>
        </b-col>

        <!-- email -->
        <b-col cols="12">
          <b-form-group
            label="Email"
            label-for="v-email"
          >
            <b-form-input
              id="v-email"
              type="email"
              placeholder="Email"
              v-model="data.email"
            />
          </b-form-group>
        </b-col>

        <!-- password -->
        <b-col cols="12">
          <b-form-group
            label="Password"
            label-for="v-password"
          >
            <b-form-input
              id="v-password"
              type="password"
              v-model="data.password"
              placeholder="Password"
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
        nama: '',
        email: '',
        password: '',
      },
    }
  },
  mounted() {
    this.getData()
  },
  methods: {
    getData() {
      this.$http.get(`/admin/${this.$route.params.id}`).then(response => {
        if (response.data.status) {
          this.data = response.data.data
        }
      })
    },
    saveData() {
      const data = {
        nama: this.data.nama,
        email: this.data.email,
        password: this.data.password,
      }
      this.$http.put(`/admin/update/${this.$route.params.id}`, data).then(response => {
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
            this.$router.push({ name: 'index-admin' })
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
