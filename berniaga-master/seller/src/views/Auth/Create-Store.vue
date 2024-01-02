<template>
  <div class="auth-wrapper auth-v1 px-2">
    <div class="auth-inner py-2">

      <!-- Register v1 -->
      <b-card class="mb-0">
        <b-link class="brand-logo">
          <!-- <vuexy-logo /> -->
          <h2 class="brand-text text-primary ml-1">
            Koperasi Urun Dana Sejahtera
          </h2>
        </b-link>

        <b-card-title class="mb-1">
          Silahkan Daftarkan Toko Anda Di Sini!
        </b-card-title>
        <b-card-text class="mb-2">
          Buat Toko Anda Sebaik Mungkin 🚀
        </b-card-text>

        <!-- form -->
        <validation-observer ref="registerForm">
          <b-form
            class="auth-register-form mt-2"
            @submit.prevent="validationForm"
          >
            <!-- Nama Toko -->
            <b-form-group
              label="Nama Toko"
              label-for="nama-toko"
            >
              <validation-provider
                #default="{ errors }"
                name="Nama Toko"
                rules="required"
              >
                <b-form-input
                  id="nama-toko"
                  v-model="nama_toko"
                  :state="errors.length > 0 ? false:null"
                  name="nama-toko"
                  placeholder="Angop"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>

            <!-- NO Telp Toko -->
            <b-form-group
              label="No Telp Toko"
              label-for="no-telp-toko"
            >
              <validation-provider
                #default="{ errors }"
                name="No Telp Toko"
                rules="required"
              >
                <b-form-input
                  id="no-telp-toko"
                  v-model="no_telp_toko"
                  :state="errors.length > 0 ? false:null"
                  name="no-telp-toko"
                  placeholder="08123456789"
                />
               <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
             </b-form-group>

            <!-- Form Provinsi -->
            <b-form-group
              label="Provinsi"
              label-for="provinsi"
            >
              <validation-provider
                #default="{ errors }"
                name="Provinsi"
                rules="required"
              >
                <b-form-select
                  v-model="id_province"
                  :options="provinsiMenu"
                  :state="errors.length > 0 ? false : null"
                  @change="getDataCities()"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>

            <!-- Form Kabupaten/Kota -->
            <b-form-group
              label="Kabupaten / Kota"
              label-for="kota"
            >
              <validation-provider
                #default="{ errors }"
                name="Kota / Kabupaten"
                rules="required"
              >
                <b-form-select
                  v-model="id_cities"
                  :options="kotaMenu"
                  :state="errors.length > 0 ? false : null"
                  @change="getDataDistrict()"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>

            <!-- Form Kecamatan -->
            <b-form-group
              label="Kecamatan"
              label-for="kecamatan"
            >
              <validation-provider
                #default="{ errors }"
                name="Kecamatan"
                rules="required"
              >
                <b-form-select
                  v-model="id_district"
                  :options="kecamatanMenu"
                  :state="errors.length > 0 ? false : null"
                  @change="getDataSubDistrict()"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>

            <!-- Form Desa atau Kelurahan -->
            <b-form-group
              label="Kelurahan / Desa"
              label-for="kelurahan/desa"
            >
              <validation-provider
                #default="{ errors }"
                name="Kelurahan / Desa"
                rules="required"
              >
                <b-form-select
                  v-model="id_subdistrict"
                  :options="desaMenu"
                  :state="errors.length > 0 ? false : null"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>

            <!-- Form Alamat Lengkap -->
            <b-form-group
              label="Alamat Toko"
              label-for="alamat_toko"
            >
              <validation-provider
                #default="{ errors }"
                name="Alamat Toko"
                rules="required"
              >
                <b-form-textarea
                  id="alamat_lengkap"
                  v-model="alamat_toko"
                  :state="errors.length > 0 ? false:null"
                  name="alamat_toko"
                  placeholder="JL. Soekarno Hatta 66"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>

            <!-- Kode Pos -->
            <b-form-group
              label="Kode Pos"
              label-for="kode-pos"
            >
              <validation-provider
                #default="{ errors }"
                name="Kode Pos"
                rules="required"
              >
                <b-form-input
                  id="kode-pos"
                  v-model="kodepos"
                  :state="errors.length > 0 ? false:null"
                  name="kode-pos"
                  placeholder="622211"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <!-- Jam Buka -->
            <b-form-group
              label="Jam Buka"
              label-for="jam-buka"
            >
              <validation-provider
                #default="{ errors }"
                name="Jam Buka"
                rules="required"
              >
                <b-form-select
                  id="jam-buka"
                  v-model="jam_buka"
                  :state="errors.length > 0 ? false:null"
                  name="jam-buka"
                  :options="menu_jam_buka"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <!-- Jam Tutup -->
            <b-form-group
              label="Jam Tutup"
              label-for="jam-tutup"
            >
              <validation-provider
                #default="{ errors }"
                name="Jam Tutup"
                rules="required"
              >
                <b-form-select
                  id="jam-tutup"
                  v-model="jam_tutup"
                  :state="errors.length > 0 ? false:null"
                  name="jam-tutup"
                  :options="menu_jam_tutup"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <!-- Jenis Usaha -->
            <b-form-group
              label="Jenis Usaha"
              label-for="jenis-usaha"
            >
              <validation-provider
                #default="{ errors }"
                name="Jenis Usaha"
                rules="required"
              >
                <b-form-input
                  id="jenis-usaha"
                  v-model="jenis_usaha"
                  :state="errors.length > 0 ? false:null"
                  name="jenis-usaha"
                  placeholder="Toko Kelontong"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <!-- Logo Toko -->
            <b-form-group
              label="Logo Toko"
              label-for="logo-toko"
            >
              <validation-provider
                #default="{ errors }"
                name="Logo Toko"
                rules="required"
              >
                <b-form-file
                  id="logo-toko"
                  v-model="logo_toko"
                  :state="errors.length > 0 ? false:null"
                  name="logo-toko"
                  accept="image/*"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <!-- Foto Toko 1 -->
            <b-form-group
              label="Foto Toko 1"
              label-for="foto-toko-1"
            >
              <validation-provider
                #default="{ errors }"
                name="Foto Toko 1"
                rules="required"
              >
                <b-form-file
                  id="foto-toko-1"
                  v-model="foto_toko1"
                  :state="errors.length > 0 ? false:null"
                  name="foto-toko-1"
                  accept="image/*"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <!-- Foto Toko 2 -->
            <b-form-group
              label="Foto Toko 2"
              label-for="foto-toko-2"
            >
              <validation-provider
                #default="{ errors }"
                name="Foto Toko 2"
                rules="required"
              >
                <b-form-file
                  id="foto-toko-2"
                  v-model="foto_toko2"
                  :state="errors.length > 0 ? false:null"
                  name="foto-toko-2"
                  accept="image/*"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <!-- Foto Toko 3 -->
            <b-form-group
              label="Foto Toko 3"
              label-for="foto-toko-3"
            >
              <validation-provider
                #default="{ errors }"
                name="Foto Toko 3"
                rules="required"
              >
                <b-form-file
                  id="foto-toko-3"
                  v-model="foto_toko3"
                  :state="errors.length > 0 ? false:null"
                  name="foto-toko-3"
                  accept="image/*"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <!-- Deskripsi -->
            <b-form-group
              label="Deskripsi"
              label-for="deskripsi"
            >
              <validation-provider
                #default="{ errors }"
                name="Deskripsi"
                rules="required"
              >
                <b-form-textarea
                  id="deskripsi"
                  v-model="deskripsi"
                  :state="errors.length > 0 ? false:null"
                  name="deskripsi"
                  placeholder="Deskripsikan Toko Anda"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <!-- submit button -->
            <b-button
              variant="primary"
              block
              type="submit"
              @click="saveData()"
            >
              Daftar
            </b-button>
          </b-form>
        </validation-observer>
      </b-card>
    <!-- /Register v1 -->
    </div>
  </div>

</template>

<script>
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import {
  BCard, BLink, BCardTitle, BCardText, BForm,
  BButton, BFormInput, BFormGroup, BFormFile, BFormSelect, BFormTextarea,
} from 'bootstrap-vue'
// import VuexyLogo from '@assets/images/logo/koperasi.svg'
import { required, email } from '@validations'
import { togglePasswordVisibility } from '@core/mixins/ui/forms'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
  components: {
    // VuexyLogo,
    // BSV
    BCard,
    BLink,
    BCardTitle,
    BCardText,
    BForm,
    BButton,
    BFormInput,
    BFormGroup,
    BFormFile,
    BFormSelect,
    BFormTextarea,
    // BInputGroup,
    // BInputGroupAppend,
    // BFormCheckbox,
    // validations
    ValidationProvider,
    ValidationObserver,
  },
  mixins: [togglePasswordVisibility],
  data() {
    return {
      menu_jam_buka: [
        { value: '0', text: '00.00' },
        { value: '1', text: '01.00' },
        { value: '2', text: '02.00' },
        { value: '3', text: '03.00' },
        { value: '4', text: '04.00' },
        { value: '5', text: '05.00' },
        { value: '6', text: '06.00' },
        { value: '7', text: '07.00' },
        { value: '8', text: '08.00' },
        { value: '9', text: '09.00' },
        { value: '10', text: '10.00' },
        { value: '11', text: '11.00' },
        { value: '12', text: '12.00' },
        { value: '13', text: '13.00' },
        { value: '14', text: '14.00' },
        { value: '15', text: '15.00' },
        { value: '16', text: '16.00' },
        { value: '17', text: '17.00' },
        { value: '18', text: '18.00' },
        { value: '19', text: '19.00' },
        { value: '20', text: '20.00' },
        { value: '21', text: '21.00' },
        { value: '22', text: '22.00' },
        { value: '23', text: '23.00' },
      ],
      menu_jam_tutup: [
        { value: '0', text: '00.00' },
        { value: '1', text: '01.00' },
        { value: '2', text: '02.00' },
        { value: '3', text: '03.00' },
        { value: '4', text: '04.00' },
        { value: '5', text: '05.00' },
        { value: '6', text: '06.00' },
        { value: '7', text: '07.00' },
        { value: '8', text: '08.00' },
        { value: '9', text: '09.00' },
        { value: '10', text: '10.00' },
        { value: '11', text: '11.00' },
        { value: '12', text: '12.00' },
        { value: '13', text: '13.00' },
        { value: '14', text: '14.00' },
        { value: '15', text: '15.00' },
        { value: '16', text: '16.00' },
        { value: '17', text: '17.00' },
        { value: '18', text: '18.00' },
        { value: '19', text: '19.00' },
        { value: '20', text: '20.00' },
        { value: '21', text: '21.00' },
        { value: '22', text: '22.00' },
        { value: '23', text: '23.00' },
      ],
      provinsiMenu: [],
      kotaMenu: [],
      kecamatanMenu: [],
      desaMenu: [],
      nama_toko: '',
      alamat_toko: '',
      no_telp_toko: '',
      id_province: '',
      id_cities: '',
      id_district: '',
      id_subdistrict: '',
      kodepos: '',
      jam_buka: '',
      jam_tutup: '',
      jenis_usaha: '',
      logo_toko: '',
      foto_toko1: '',
      foto_toko2: '',
      foto_toko3: '',
      deskripsi: '',
      status: '1',
      saldo: 0,
      id_seller: JSON.parse(localStorage.getItem('id_seller')),

      // validation rules
      required,
      email,
    }
  },
  computed: {
    passwordToggleIcon() {
      return this.passwordFieldType === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
  },
  mounted() {
    this.getDataProvince()
  },
  methods: {
    saveData() {
      console.log(this.id_seller)
      const data = new FormData()
      data.append('nama_toko', this.nama_toko)
      data.append('alamat_toko', this.alamat_toko)
      data.append('no_telp_toko', this.no_telp_toko)
      data.append('id_province', this.id_province)
      data.append('id_cities', this.id_cities)
      data.append('id_district', this.id_district)
      data.append('id_subdistrict', this.id_subdistrict)
      data.append('kodepos', this.kodepos)
      data.append('jam_buka', this.jam_buka)
      data.append('jam_tutup', this.jam_tutup)
      data.append('jenis_usaha', this.jenis_usaha)
      data.append('logo_toko', this.logo_toko)
      data.append('foto_toko1', this.foto_toko1)
      data.append('foto_toko2', this.foto_toko2)
      data.append('foto_toko3', this.foto_toko3)
      data.append('deskripsi', this.deskripsi)
      data.append('status', this.status)
      data.append('saldo', this.saldo)
      data.append('id_seller', this.id_seller)

      this.$http.post('/toko-create', data).then(response => {
        if (response.data.status) {
          localStorage.setItem('id_toko', JSON.stringify(response.data.data.id))
          this.$toast({
            component: ToastificationContent,
            props: {
              title: response.data.message,
              icon: 'EditIcon',
              variant: 'success',
            },
          })
          setTimeout(() => {
            this.$router.push({ name: 'home' })
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
    getDataProvince() {
      this.$http.get('lokasi/province').then(response => {
        if (response.data.status) {
          response.data.data.forEach(element => {
            const data = {
              value: element.prov_id,
              text: element.prov_name,
            }
            this.provinsiMenu.push(data)
            this.provinsiMenu.splice(34)
          })
        }
      })
    },
    getDataCities() {
      this.provinsiMenu.length = 0
      this.kotaMenu.length = 0
      this.kecamatanMenu.length = 0
      this.desaMenu.length = 0
      this.id_cities = 0
      this.id_district = 0
      this.id_subdistrict = 0
      if (this.id_province) {
        this.$http.get(`lokasi/cities/${this.id_province}`).then(response => {
          if (response.data.status) {
            response.data.data.forEach(element => {
              const data = {
                value: element.city_id,
                text: element.city_name,
              }
              this.kotaMenu.push(data)
            })
          }
        })
      }
    },
    getDataDistrict() {
      this.desaMenu.length = 0
      this.subdistrict = 0
      this.id_district = 0
      this.id_subdistrict = 0
      if (this.id_cities) {
        this.$http.get(`lokasi/districts/${this.id_cities}`).then(response => {
          if (response.data.status) {
            response.data.data.forEach(element => {
              const data = {
                value: element.dis_id,
                text: element.dis_name,
              }
              this.kecamatanMenu.push(data)
            })
          }
        })
      }
    },
    getDataSubDistrict() {
      this.id_subdistrict = 0
      this.desaMenu.length = 0
      if (this.id_district) {
        this.$http.get(`lokasi/subdistricts/${this.id_district}`).then(response => {
          if (response.data.status) {
            response.data.data.forEach(element => {
              const data = {
                value: element.subdis_id,
                text: element.subdis_name,
              }
              this.desaMenu.push(data)
            })
          }
        })
      }
    },
    validationForm() {
      this.$refs.registerForm.validate().then(success => {
        if (success) {
          this.$toast({
            component: ToastificationContent,
            props: {
              title: 'Form Submitted',
              icon: 'EditIcon',
              variant: 'success',
            },
          })
        }
      })
    },
  },
}
</script>

<style lang="scss">
@import '@core/scss/vue/pages/page-auth.scss';
</style>
