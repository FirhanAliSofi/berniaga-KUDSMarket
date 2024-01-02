<template>
  <div class="auth-wrapper auth-v1 px-2">
    <div class="auth-inner py-2">

      <!-- Register v1 -->
      <b-card>
        <b-link class="brand-logo">
          <vuexy-logo />
          <h2 class="brand-text text-primary ml-1">
            Kudsmarket
          </h2>
        </b-link>

        <b-card-title class="mb-1">
          Daftar Sebagai Seller
        </b-card-title>

        <!-- form -->
        <validation-observer ref="registerForm">
          <b-form
            class="auth-register-form mt-2"
            @submit.prevent="validationForm"
          >
            <!-- Form Nama -->
            <b-form-group
              label="Nama"
              label-for="nama"
            >
              <validation-provider
                #default="{ errors }"
                name="Nama"
                rules="required"
              >
                <b-form-input
                  id="nama"
                  v-model="data.nama"
                  :state="errors.length > 0 ? false:null"
                  name="register-nama"
                  placeholder="Sugeng Santoso"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>

            <!-- Form Email -->
            <b-form-group
              label="Email"
              label-for="email"
            >
              <validation-provider
                #default="{ errors }"
                name="Email"
                rules="required|email"
              >
                <b-form-input
                  id="email"
                  v-model="data.emailSeller"
                  :state="errors.length > 0 ? false:null"
                  name="register-email"
                  placeholder="john@example.com"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>

            <!-- Form Password -->
            <b-form-group
              label="Password"
              label-for="password"
            >
              <validation-provider
                #default="{ errors }"
                name="Password"
                rules="required"
              >
                <b-input-group
                  class="input-group-merge"
                  :class="errors.length > 0 ? 'is-invalid':null"
                >
                  <b-form-input
                    id="password"
                    v-model="data.password"
                    :type="passwordFieldType"
                    :state="errors.length > 0 ? false:null"
                    class="form-control-merge"
                    name="register-password"
                    placeholder="············"
                  />
                  <b-input-group-append is-text>
                    <feather-icon
                      :icon="passwordToggleIcon"
                      class="cursor-pointer"
                      @click="togglePasswordVisibility"
                    />
                  </b-input-group-append>
                </b-input-group>
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>

            <!-- Form Profesi -->
            <b-form-group
              label="Profesi"
              label-for="profesi"
            >
              <validation-provider
                #default="{ errors }"
                name="Profesi"
                rules="required"
              >
                <b-form-input
                  id="profesi"
                  v-model="data.profesi"
                  :state="errors.length > 0 ? false:null"
                  name="register-profesi"
                  placeholder="Pedagang Kelontong"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>

            <!-- Form Jenis Kelamin -->
            <b-form-group
              label="Jenis Kelamin"
              label-for="jenis_kelamin"
            >
              <validation-provider
                #default="{ errors }"
                name="Jenis Kelamin"
                rules="required"
              >
                <b-form-select
                  v-model="data.jenis_kelamin"
                  :options="jenis_kelamin_menu"
                  :state="errors.length > 0 ? false:null"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>

            <!-- Form Nomor Telepon -->
            <b-form-group
              label="No Telpon"
              label-for="no_telp"
            >
              <validation-provider
                #default="{ errors }"
                name="Nomor Telepon"
                rules="required"
              >
                <b-form-input
                  id="no_telp"
                  v-model="data.no_telp"
                  :state="errors.length > 0 ? false:null"
                  name="register-no-telp"
                  placeholder="08123456"
                  type="number"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>

            <!-- Form Tanggal Lahir -->
            <b-form-group
              label="Tanggal Lahir"
              label-for="no_telp"
            >
              <validation-provider
                #default="{ errors }"
                name="Tanggal Lahir"
                rules="required"
              >
              <b-form-datepicker
                id="tanggal-lahir"
                v-model="data.tanggal_lahir"
                class="mb-1"
                :state="errors.length > 0 ? false:null"
              />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>

            <!-- Form NIK -->
            <b-form-group
              label="NIK"
              label-for="nik"
            >
              <validation-provider
                #default="{ errors }"
                name="nik"
                rules="required"
              >
                <b-form-input
                  id="nik"
                  v-model="data.nik"
                  :state="errors.length > 0 ? false:null"
                  name="register-nik"
                  placeholder="35123456789"
                  type="number"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>

            <!-- Form Foto KTP -->
            <b-form-group
              label="Foto KTP"
              label-for="foto_ktp"
            >
              <validation-provider
                #default="{ errors }"
                name="Foto KTP"
                rules="required"
              >
                <b-form-file
                  id="foto_ktp"
                  accept="image/*"
                  v-model="data.foto_ktp"
                  :state="errors.length > 0 ? false:null"
                  name="register-foto-ktp"
                />

                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>

            <!-- Form Foto Wajah -->
            <b-form-group
              label="Foto Wajah"
              label-for="foto_wajah"
            >
              <validation-provider
                #default="{ errors }"
                name="Foto Wajah"
                rules="required"
              >
                <b-form-file
                  id="foto_wajah"
                  accept="image/*"
                  v-model="data.foto_wajah"
                  :state="errors.length > 0 ? false:null"
                  name="register-foto-wajah"
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
                  v-model="data.id_province"
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
                  v-model="data.id_cities"
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
                  v-model="data.id_district"
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
                  v-model="data.id_subdistrict"
                  :options="desaMenu"
                  :state="errors.length > 0 ? false : null"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>

            <!-- Form Alamat Lengkap -->
            <b-form-group
              label="Alamat Lengkap"
              label-for="alamat_lengkap"
            >
              <validation-provider
                #default="{ errors }"
                name="Alamat Lengkap"
                rules="required"
              >
                <b-form-textarea
                  id="alamat_lengkap"
                  v-model="data.alamat_lengkap"
                  :state="errors.length > 0 ? false:null"
                  name="alamat_lengkap"
                  placeholder="JL. Soekarno Hatta 66"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>

            <!-- Form Kodepos -->
            <b-form-group
              label="Kode pos"
              label-for="nik"
            >
              <validation-provider
                #default="{ errors }"
                name="kodepos"
                rules="required"
              >
                <b-form-input
                  id="kodepos"
                  v-model="data.kodepos"
                  :state="errors.length > 0 ? false:null"
                  name="register-kodepos"
                  placeholder="61221"
                  type="number"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>

            <!-- checkbox -->
            <b-form-group>
              <b-form-checkbox
                id="register-privacy-policy"
                v-model="status"
                name="checkbox-1"
              >
                I agree to
                <b-link>privacy policy & terms</b-link>
              </b-form-checkbox>
            </b-form-group>

            <!-- submit button -->
            <b-button
              variant="primary"
              block
              type="submit"
              @click="saveData()"
            >
              Sign up
            </b-button>
          </b-form>
        </validation-observer>

        <b-card-text class="text-center mt-2">
          <span>Sudah punya akun? </span>
          <b-link :to="{name:'login'}">
            <span>Login Disini</span>
          </b-link>
        </b-card-text>
      </b-card>
    <!-- /Register v1 -->
    </div>
  </div>

</template>

<script>
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import {
  BCard, BLink, BCardTitle, BCardText, BForm, BFormSelect, BFormDatepicker, BFormFile,
  BButton, BFormInput, BFormGroup, BInputGroup, BInputGroupAppend, BFormCheckbox, BFormTextarea,
} from 'bootstrap-vue'
import VuexyLogo from '@core/layouts/components/Logo.vue'
import { required, email } from '@validations'
import { togglePasswordVisibility } from '@core/mixins/ui/forms'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
  components: {
    VuexyLogo,
    // BSV
    BCard,
    BLink,
    BCardTitle,
    BCardText,
    BForm,
    BButton,
    BFormInput,
    BFormGroup,
    BInputGroup,
    BInputGroupAppend,
    BFormCheckbox,
    BFormSelect,
    BFormDatepicker,
    BFormFile,
    BFormTextarea,
    // validations
    ValidationProvider,
    ValidationObserver,
  },
  mixins: [togglePasswordVisibility],
  data() {
    return {
      jenis_kelamin_menu: [
        { value: 'L', text: 'Laki-laki' },
        { value: 'P', text: 'Perempuan' },
      ],
      provinsiMenu: [],
      kotaMenu: [],
      kecamatanMenu: [],
      desaMenu: [],
      data: {
        nama: '',
        emailSeller: '',
        password: '',
        profesi: '',
        jenis_kelamin: null,
        no_telp: '',
        tanggal_lahir: '',
        nik: '',
        foto_ktp: '',
        foto_wajah: '',
        alamat_lengkap: '',
        kodepos: '',
        id_province: '',
        id_cities: '',
        id_district: '',
        id_subdistrict: '',
        status_verifikasi: '0',
      },

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
      this.data.id_cities = 0
      this.data.id_district = 0
      this.data.id_subdistrict = 0
      if (this.data.id_province) {
        this.$http.get(`lokasi/cities/${this.data.id_province}`).then(response => {
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
      this.data.subdistrict = 0
      this.data.id_subdistrict = 0
      this.data.id_district = 0
      if (this.data.id_cities) {
        this.$http.get(`lokasi/districts/${this.data.id_cities}`).then(response => {
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
      this.data.id_subdistrict = 0
      this.desaMenu.length = 0
      if (this.data.id_district) {
        this.$http.get(`lokasi/subdistricts/${this.data.id_district}`).then(response => {
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
    saveData() {
      const data = new FormData()
      data.append('nama', this.data.nama)
      data.append('profesi', this.data.profesi)
      data.append('email', this.data.emailSeller)
      data.append('password', this.data.password)
      data.append('jenis_kelamin', this.data.jenis_kelamin)
      data.append('no_telp', this.data.no_telp)
      data.append('tanggal_lahir', this.data.tanggal_lahir)
      data.append('nik', this.data.nik)
      data.append('foto_ktp', this.data.foto_ktp)
      data.append('foto_wajah', this.data.foto_wajah)
      data.append('alamat_lengkap', this.data.alamat_lengkap)
      data.append('kodepos', this.data.kodepos)
      data.append('status_verifikasi', this.data.status_verifikasi)
      data.append('id_province', this.data.id_province)
      data.append('id_cities', this.data.id_cities)
      data.append('id_district', this.data.id_district)
      data.append('id_subdistrict', this.data.id_subdistrict)

      this.$http.post('/register-seller', data).then(response => {
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
            this.$router.push({ name: 'login' })
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
    validationForm() {
      this.$refs.registerForm.validate().then(success => {
        if (success) {
          this.$toast({
            component: ToastificationContent,
            props: {
              title: 'Register Berhasil',
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
