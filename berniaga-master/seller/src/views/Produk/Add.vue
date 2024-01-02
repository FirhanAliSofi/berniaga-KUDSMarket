<template>
  <b-form class="produk-tambahProduk-form mt-2" @submit.prevent="tambahprodukForm">
    <b-card>
      <validation-observer ref="tambahprodukForm">
      <b-row>
        <b-col md="4">
          <h4>Nama Produk</h4>
          <p>
            Pilihlah nama yang singkat, jelas, dan mudah diingat oleh pelanggan
            potensial. Hindari penggunaan kata-kata yang rumit atau sulit dieja.
            Nama yang pendek dan sederhana akan lebih mudah dikenali dan
            diingat.
          </p>
        </b-col>
        <b-col md="8">
        <b-form-group>
          <ValidationProvider
              #default="{ errors }"
              name="Nama Produk"
              rules="required"
          >
          <b-form-input
            id="v-nama-produk"
            v-model="data.nama_produk"
            :state="errors.length > 0 ? false:null"
            placeholder="Beras, Minyak, dll"
            />
            <small class="text-danger">{{ errors[0] }}</small>
          </ValidationProvider>
        </b-form-group>
        </b-col>
        <b-col md="4">
          <h4>Merek</h4>
          <p>Masukkan merek dari produk anda.</p>
        </b-col>
        <b-col md="8">
        <b-form-group>
          <ValidationProvider
              #default="{ errors }"
              name="Merek"
              rules="required"
          >
          <b-form-input
            id="v-merek"
            v-model="data.merek"
            :state="errors.length > 0 ? false:null"
            placeholder="Raja Lele, Minyak Kita, dll"
          />
          <small class="text-danger">{{ errors[0] }}</small>
          </ValidationProvider>
        </b-form-group>
        </b-col>
        <b-col cols="4" class="mt-1">
          <h4>Kondisi</h4>
        </b-col>
        <b-col cols="8" class="mt-1">
          <b-form-group>
            <ValidationProvider
              #default="{ errors }"
              name="Kondisi"
              rules="required"
          >
          <b-form-select
            id="v-merek"
            v-model="data.kondisi"
            :state="errors.length > 0 ? false:null"
            :options="kondisi_menu"
          />
          <small class="text-danger">{{ errors[0] }}</small>
          </ValidationProvider>
        </b-form-group>
        </b-col>
        <b-col cols="4" class="mt-2">
          <h4>Deskripsi Produk</h4>
          <p>
            Pastikan deskripsi produk mencakup penjelasan rinci tentang produk
            Anda agar calon pembeli dapat dengan mudah memahami dan menemukan
            informasi tentang produk tersebut. Kami menyarankan agar Anda tidak
            menyertakan informasi kontak pribadi seperti nomor telepon, alamat
            email, dan sejenisnya dalam deskripsi produk. Hal ini bertujuan
            untuk melindungi data pribadi Anda dan menjaga privasi Anda.
          </p>
        </b-col>
        <b-col cols="8" class="mt-2">
          <b-form-group>
            <ValidationProvider
              #default="{ errors }"
              name="Deskripsi"
              rules="required"
            >
          <b-form-textarea
            id="v-deskripsi-produk"
            v-model="data.deskripsi_produk"
            :state="errors.length > 0 ? false:null"
            placeholder="Deskripsikan Produk Anda"
            rows="8"
          />
          <small class="text-danger">{{ errors[0] }}</small>
          </ValidationProvider>
        </b-form-group>
        </b-col>
        <b-col cols="4">
          <h4>Foto Produk 1</h4>
          <p>
            Pastikan Anda menggunakan format gambar .jpg, .jpeg, atau .png
            dengan ukuran minimum 300 x 300 piksel (Namun, untuk kualitas gambar
            optimal, disarankan menggunakan ukuran minimum 700 x 700 piksel).
          </p>
        </b-col>
        <b-col cols="8">
          <b-form-group>
            <ValidationProvider
              #default="{ errors }"
              name="Foto Produk 1"
              rules="required"
            >
          <b-form-file
            id="v-foto-produk1"
            v-model="data.foto_produk1"
            :state="errors.length > 0 ? false:null"
            accept="image/*"
          />
          <small class="text-danger">{{ errors[0] }}</small>
         </ValidationProvider>
        </b-form-group>
        </b-col>
        <b-col cols="4" class="mt-2">
          <h4>Foto Produk 2</h4>
          <p>
            Pastikan Anda menggunakan format gambar .jpg, .jpeg, atau .png
            dengan ukuran minimum 300 x 300 piksel (Namun, untuk kualitas gambar
            optimal, disarankan menggunakan ukuran minimum 700 x 700 piksel).
          </p>
        </b-col>
        <b-col cols="8" class="mt-2">
        <b-form-group>
          <ValidationProvider
              #default="{ errors }"
              name="Foto Produk 2"
              rules="required"
            >
          <b-form-file
            id="v-foto-produk2"
            v-model="data.foto_produk2"
            :state="errors.length > 0 ? false:null"
            accept="image/*"
          />
          <small class="text-danger">{{ errors[0] }}</small>
          </ValidationProvider>
        </b-form-group>
        </b-col>
        <b-col cols="4" class="mt-2">
          <h4>Foto Produk 3</h4>
          <p>
            Pastikan Anda menggunakan format gambar .jpg, .jpeg, atau .png
            dengan ukuran minimum 300 x 300 piksel (Namun, untuk kualitas gambar
            optimal, disarankan menggunakan ukuran minimum 700 x 700 piksel).
          </p>
        </b-col>
        <b-col cols="8" class="mt-2">
          <b-form-group>
            <ValidationProvider
              #default="{ errors }"
              name="Foto Produk 3"
              rules="required"
            >
          <b-form-file
            id="v-foto-produk3"
            v-model="data.foto_produk3"
            :state="errors.length > 0 ? false:null"
            accept="image/*"
          />
          <small class="text-danger">{{ errors[0] }}</small>
          </ValidationProvider>
        </b-form-group>
        </b-col>
        <b-col cols="4" class="mt-2">
          <h4>Etalase</h4>
        </b-col>
        <b-col cols="8" class="mt-2">
        <b-form-group>
          <ValidationProvider
              #default="{ errors }"
              name="Etalase"
              rules="required"
            >
          <b-form-select
            id="v-etalase"
            v-model="data.id_etalase"
            :state="errors.length > 0 ? false:null"
            :options="id_etalase_menu"
          />
          <small class="text-danger">{{ errors[0] }}</small>
          </ValidationProvider>
        </b-form-group>
        </b-col>
        <b-col cols="4" class="mt-2">
          <h4>Kategori</h4>
        </b-col>
        <b-col cols="8" class="mt-2">
        <b-form-group>
          <ValidationProvider
              #default="{ errors }"
              name="Kategori"
              rules="required"
            >
          <b-form-select
            id="v-kategori"
            v-model="data.id_kategori"
            :state="errors.length > 0 ? false:null"
            :options="id_kategori_menu"
          />
          <small class="text-danger">{{ errors[0] }}</small>
          </ValidationProvider>
        </b-form-group>
        </b-col>
        <b-col cols="3" class="mt-2" xl="4">
          <h4>Ukuran Produk</h4>
          <p>
            Mohon sertakan ukuran produk setelah dikemas agar dapat menghitung
            berat volume.
          </p>
        </b-col>
        <b-col md="3" xl="2" class="mt-2">
  <b-form-group id="v-panjang" v-model="data.panjang">
    <b-input-group append="cm">
      <b-form-input placeholder="Panjang"></b-form-input>
    </b-input-group>
    <ValidationProvider v-slot="{ errors }" name="panjang" rules="required">
      <small class="text-danger">{{ errors[0] }}</small>
    </ValidationProvider>
  </b-form-group>
</b-col>
<b-col md="3" xl="2" class="mt-2">
  <b-form-group id="v-lebar" v-model="data.lebar">
    <b-input-group append="cm">
      <b-form-input placeholder="Lebar"></b-form-input>
    </b-input-group>
    <ValidationProvider v-slot="{ errors }" name="lebar" rules="required">
      <small class="text-danger">{{ errors[0] }}</small>
    </ValidationProvider>
  </b-form-group>
</b-col>
<b-col md="3" xl="2" class="mt-2">
  <b-form-group id="v-tinggi" v-model="data.tinggi">
    <b-input-group append="cm">
      <b-form-input placeholder="Tinggi"></b-form-input>
    </b-input-group>
    <ValidationProvider v-slot="{ errors }" name="tinggi" rules="required">
      <small class="text-danger">{{ errors[0] }}</small>
    </ValidationProvider>
  </b-form-group>
</b-col>
      </b-row>
    </validation-observer>
    </b-card>
    <b-card>
      <b-row>
        <b-col cols="4" class="mt-2">
          <h4>Status Varian</h4>
          <p>
            Tambahkan opsi varian agar pembeli dapat memilih produk yang paling
            sesuai dengan kebutuhan mereka.
          </p>
        </b-col>
        <b-col cols="8">
          <b-form-radio-group
          id="v-status-varian"
          v-model="data.status_varian"
          :options="status_varian_menu"
          class="demo-inline-spacing mb-1"
          value-field="value"
          text-field="text"
          />
        </b-col>
        <b-col cols="12" class="mt-2" v-if="data.status_varian == 1">
          <h4>Tipe Varian</h4>
          <p>Anda Hanya Dapat Memasukkan 1 Tipe Varian</p>
          </b-col>
          <b-col v-if="data.status_varian == 1">
          <b-form-group>
            <ValidationProvider
              #default="{ errors }"
              name="Kategori"
              rules="required"
            >
            <b-form-select
              class="mt-2"
              id="v-nama-varian"
              v-model="data.nama_varian"
              :state="errors.length > 0 ? false:null"
              :options="nama_varian_menu"
            />
            <small class="text-danger">{{ errors[0] }}</small>
            </ValidationProvider>
          </b-form-group>
          </b-col>
          <b-col v-if="data.status_varian == 1">
          <label for="tags-basic">Ketik untuk menambahkan tipe varian. Kemudian pencet enter</label>
        <b-form-group>
          <ValidationProvider
              #default="{ errors }"
              name="Kategori"
              rules="required"
            >
          <b-form-tags
          v-model="id_tipe_varian"
          :state="errors.length > 0 ? false:null"
          input-id="v-id-tipe-varian"
          class="mb-2"
          placeholder="Masukkan Tipe Varian"
          v-if="data.status_varian == 1"
          />
          {{ id_tipe_varian }}
          {{ panjang }}
          <small class="text-danger">{{ errors[0] }}</small>
          </ValidationProvider>
        </b-form-group>
        </b-col>
        <b-col cols="12" v-if="data.status_varian == 1">
          <h4>Tabel Stok Produk</h4>
        </b-col>
        <b-col md="3" v-if="data.status_varian == 1">
          <div v-for="id_tipe in id_tipe_varian" :key="id_tipe">
          <b-form-group
              label="Stok Produk"
              label-for="stok-produk"
              v-model="data.stok"
            >
              <b-form-input
                id="stok-produk"
                type="text"
                placeholder="Stok Produk Anda"
              />
            </b-form-group>
          </div>
        </b-col>
        <b-col md="3" v-if="data.status_varian == 1">
          <div v-for="id_tipe in id_tipe_varian" :key="id_tipe">
            <b-form-group
              label="Harga"
              label-for="harga"
              v-model="data.harga"
            >
            <b-input-group prepend="Rp.">
              <b-form-input
                id="harga"
                type="number"
                placeholder="Harga"
              />
            </b-input-group>
            </b-form-group>
          </div>
        </b-col>
        <b-col md="3" v-if="data.status_varian == 1">
          <div v-for="id_tipe in id_tipe_varian" :key="id_tipe">
          <b-form-group
          label="Berat"
          label-for="berat"
          v-model="data.berat"
            >
            <b-input-group append="gram">
              <b-form-input
                id="berat"
                type="number"
                placeholder="Berat"
              />
            </b-input-group>
            </b-form-group>
          </div>
        </b-col>
        <b-col md="3" v-if="data.status_varian == 1">
          <div v-for="id_tipe in id_tipe_varian" :key="id_tipe">
          <b-form-group
              label="Status"
              label-for="status"
              v-model="data.status"
            >
              <b-form-input
                id="status"
                type="text"
                placeholder="Status"
              />
            </b-form-group>
          </div>
        </b-col>
      </b-row>
    </b-card>
    <b-card v-if="data.status_varian == 0">
      <b-row>
  <b-col md="4">
  <h4>Stok Produk</h4>
  <p>Tentukan jumlah stok produk yang Anda miliki.</p>
</b-col>
<b-col md="8">
  <b-form-group>
    <validation-provider
    v-slot="{ errors }"
    name="Stok Produk"
    rules="required"
    >
      <b-form-input
        id="v-stok"
        v-model="data.stok"
        :state="errors.length > 0 ? false : null"
        placeholder="Masukkan Jumlah Stok Produk"
      />
      <small class="text-danger">{{ errors[0] }}</small>
    </validation-provider>
  </b-form-group>
</b-col>

<b-col md="4">
  <h4>Harga</h4>
</b-col>
<b-col md="8">
  <b-form-group>
    <validation-provider v-slot="{ errors }" name="Harga Produk" rules="required">
      <b-input-group prepend="Rp." :state="errors.length > 0 ? false : null">
        <b-form-input placeholder="Masukkan Harga Produk Anda" v-model="data.harga" />
      </b-input-group>
      <small class="text-danger">{{ errors[0] }}</small>
    </validation-provider>
  </b-form-group>
</b-col>

<b-col md="4" class="mt-2">
  <h4>Berat Produk</h4>
  <p>
    Mohon sertakan berat produk setelah dikemas dengan menggunakan timbangan.
    Silakan timbang produk setelah dikemas dan masukkan beratnya di sini.
  </p>
</b-col>
<b-col md="8" class="mt-2">
  <b-form-group>
    <validation-provider v-slot="{ errors }" name="Berat Produk" rules="required">
      <b-input-group append="gram" :state="errors.length > 0 ? false : null">
        <b-form-input placeholder="Masukkan Berat Produk Anda" v-model="data.berat" />
      </b-input-group>
      <small class="text-danger">{{ errors[0] }}</small>
    </validation-provider>
  </b-form-group>
</b-col>

        <b-col cols="4" class="mt-2">
          <h4>Status Produk</h4>
          <p>
            Apabila produk Anda dalam status aktif, maka calon pembeli dapat
            melakukan pencarian dan menemukan produk Anda dengan mudah.
          </p>
        </b-col>
        <b-col cols="8">
          <b-form-radio-group
            id="v-status"
            v-model="data.status"
            :options="status_menu"
            class="demo-inline-spacing mb-1"
            value-field="value"
            text-field="text"
          />
    </b-col>
      </b-row>
      </b-card>
      <b-button
        variant="primary"
        type="submit"
        @click.prevent="tambahprodukForm"
      >
        Submit
      </b-button>
      </b-form>
</template>

<script>
import {
  BCard,
  BRow,
  BCol,
  BFormInput,
  BForm,
  BFormSelect,
  BFormTextarea,
  BFormFile,
  BInputGroup,
  BFormRadioGroup,
  BFormTags,
  BFormGroup,
  BButton,
} from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
// eslint-disable-next-line
import "quill/dist/quill.core.css";
// eslint-disable-next-line
import "quill/dist/quill.snow.css";
// eslint-disable-next-line
import "quill/dist/quill.bubble.css";
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import { required } from '@validations'

export default {
  components: {
    BCard,
    BRow,
    BCol,
    BFormInput,
    BForm,
    BFormFile,
    BFormSelect,
    BFormTextarea,
    BInputGroup,
    BFormRadioGroup,
    BFormTags,
    BFormGroup,
    ValidationObserver,
    ValidationProvider,
    BButton,
  },
  directives: {
    Ripple,
  },

  data() {
    return {
      id_tipe_varian: [],
      kondisi_menu: [
        { value: 'baru', text: 'Baru' },
        { value: 'bekas', text: 'Bekas' },
      ],
      id_etalase_menu: [
        { value: 'pakaian-pria', text: 'Pakarian Pria' },
        { value: 'pakaian-wanita', text: 'Pakaian Wanita' },
      ],
      id_kategori_menu: [
        { value: 'elektronik', text: 'Elektronik' },
        { value: 'film & musik', text: 'Film & Musik' },
      ],
      status: 'first',
      status_menu: [
        { text: 'Aktif', value: 'aktif' },
        { text: 'Tidak Aktif', value: 'tidak aktif' },
      ],
      status_varian_menu: [
        { value: '1', text: 'Aktif' },
        { value: '0', text: 'Tidak Aktif' },
      ],
      nama_varian_menu: [
        { value: 'warna', text: 'Warna' },
        { value: 'ukuran', text: 'Ukuran' },
      ],
      selected: '',
      data: {
        nama_produk: '',
        merek: '',
        kondisi: '',
        deskripsi_produk: '',
        foto_produk1: '',
        foto_produk2: '',
        foto_produk3: '',
        status_varian: 0,
        id_etalase: '',
        id_kategori: '',
        stok: '',
        harga: '',
        berat: '',
        status: '',
        panjang: '',
        lebar: '',
        tinggi: '',
        id_tipe_varian: '',
      },
      required,
    }
  },
  mounted() {
    this.getData()
  },
  computed: {
    panjang() {
      return this.id_tipe_varian.length
    },
  },
  methods: {
    saveData() {},
    tambahprodukForm() {
      this.$refs.tambahprodukForm.validate().then(success => {
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
@import "@core/scss/vue/libs/vue-select.scss";
</style>
