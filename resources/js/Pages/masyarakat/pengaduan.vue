<template>
  <div class="d-flex justify-center">
    <v-card width="50%">
      <v-card-text>
        <v-form>
          <v-file-input
            label="pilih foto"
            variant="outlined"
            prepend-icon="mdi-camera"
            @input="form.foto = $event.target.files[0]"
          >
          </v-file-input>
        </v-form>
        <div class="my-3 font-weight-medium">Masukkan Pengaduan Anda</div>
        <QuillEditor v-model:content="form.isi" contentType="html" />
      </v-card-text>
      <v-card-actions class="mt-3">
        <v-btn variant="flat" color="blue" @click="adukan">Adukan</v-btn>
      </v-card-actions>
    </v-card>
  </div>
  <div class="d-flex justify-center">
    <v-card class="my-3" width="50%" v-if="datas.length">
      <v-card-text>
        <v-list lines="three">
          <v-list-item v-for="row in datas" :key="row.id">
            <v-list-item-title>{{ row.tgl_pengaduan }}</v-list-item-title>

            <v-list-item-subtitle>
              <p v-html="row.isi"></p>
            </v-list-item-subtitle>
            <v-list-item-subtitle>
              <span v-if="row.status == '0'" class="text-blue"
                >Status: Belum Diproses</span
              >
              <span v-else class="text-blue">Status: {{ row.status }}</span>
            </v-list-item-subtitle>

            <v-list-item-subtitle>
              <tanggapan1 :id="row.id"/>
            </v-list-item-subtitle>

            <template v-slot:prepend>
              <v-avatar color="grey-lighten-1" size="70">
                <v-img
                  class="bg-blue"
                  :aspect-ratio="1"
                  :src="'/storage/' + row.foto"
                  cover
                >
                </v-img>
              </v-avatar>
            </template>

            <template v-slot:append>
              <v-menu>
                <template v-slot:activator="{ props }">
                  <v-btn
                    color="grey-lighten-1"
                    icon="mdi-information"
                    variant="text"
                    v-bind="props"
                  >
                  </v-btn>
                </template>
                <v-list>
                  <v-list-item @click="hapus(row.id)">Hapus</v-list-item>
                </v-list>
              </v-menu>
            </template>
          </v-list-item>
        </v-list>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
import layout2 from "../../layout/layout2.vue";
import { router, useForm } from "@inertiajs/vue3";
import tanggapan1 from '../components/tanggapan1.vue'
export default {
  layout: layout2,
  components:{
    tanggapan1
  },
  props: {
    datas: Array,
  },
  data() {
    return {
      form: useForm({
        foto: null,
        isi: "",
      }),
    };
  },

  methods: {
    adukan() {
      router.post("/masyarakat/pengaduan", this.form, {
        methods: "post",
        forceFormData: true,
        preserveState: false,
        preserveScroll: false,
        onSuccsess: () => {
          this.batal();
        },
      });
    },
    batal() {
      this.form.foto = null;
      this.form.isi = "";
    },
    hapus($id) {
      router.visit("/masyarakat/pengaduan/" + $id, {
        method: "delete",
        preserveState: false,
        preserveScroll: false,
      });
    },
  }
};
</script>

<style>
</style>
