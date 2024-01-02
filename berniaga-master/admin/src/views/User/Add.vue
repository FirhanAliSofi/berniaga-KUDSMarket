<template>
  <b-card title="Tambah User ➕">
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
              placeholder="Nama"
              v-model="data.name"
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

        <!-- mobile -->
        <b-col cols="12">
          <b-form-group
            label="No. HP"
            label-for="v-mobile"
          >
            <b-form-input
              id="v-mobile"
              type="number"
              placeholder="No. HP"
              v-model="data.no_hp"
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
              placeholder="Password"
              v-model="data.password"
            />
          </b-form-group>
        </b-col>

        <!-- jenis kelamin -->
        <b-col cols="12">
          <b-form-group
            label="Jenis Kelamin"
            label-for="v-jenis-kelamin"
          >
            <b-form-select
            v-model="selected"
            :options="options_jenis_kelamin"
          />
          </b-form-group>
        </b-col>

        <!--Role-->
        <b-col cols="12">
          <b-form-group
            label="Role"
            label-for="v-role"
          >
            <b-form-select
            v-model="selected"
            :options="options_role"
            placeholder="Anjay"
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
  BCard, BRow, BCol, BFormGroup, BFormInput, BForm, BButton, BFormSelect,
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
    BFormSelect,
  },
  directives: {
    Ripple,
  },

  data() {
    return {
      data: {
        name: '',
        email: '',
        no_hp: '',
        jenis_kelamin: '',
        id_role: '',
      },
      options_jenis_kelamin: [
        { value: 'L', text: 'Laki-Laki' },
        { value: 'P', text: 'Perempuan' },
      ],
      options_role: [
        { value: '1', text: 'Admin' },
      ],
    }
  },
  method: {
    saveData() {
      const data = {
        name: this.data.name,
        email: this.data.email,
        no_hp: this.data.no_hp,
        jenis_kelamin: this.data.jenis_kelamin,
        id_role: this.data.id_role,
      }
      this.$http.post('/user', data).then(response => {
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
            this.$router.push({ name: 'user-index' })
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
