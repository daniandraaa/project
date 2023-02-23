<template>
    <div class="d-flex justify-center">
        <v-card class="my-3" width="50%" v-if="datas.length">
            <v-card-text>
                <v-list lines="three">
                    <v-list-item v-for="row in datas" :key="row.id">
                        <v-list-item-title>{{ row.nama }} - {{ row.nik }}</v-list-item-title>
                        <v-list-item-title>{{ row.tgl_pengaduan }}</v-list-item-title>

                        <v-list-item-subtitle>
                            <p v-html="row.isi"></p>
                        </v-list-item-subtitle>
                        <v-list-subtitle>
                            <span v-if="row.status == '0'" class="text-red">Status : Belum diproses</span>
                            <span v-else class="text-red">Status : {{ row.status }}</span>
                        </v-list-subtitle>
                        <v-divider/>
                        <v-item-subtitle class="mt-3">
                            ini tanggapan dari admin
                        </v-item-subtitle>
                        <template v-slot:prepend>
                            <v-avatar color="grey-lighten-1" size="75">
                                <v-img class="bg-white" width="300" :aspect-ratio="1" :src="'/storage/' + row.foto"
                                    cover></v-img>
                            </v-avatar>
                        </template>
                      

                    </v-list-item>
                </v-list>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
import layout2 from '../../layout/layout2.vue'
export default {
    layout: layout2,
    props: {
        datas: Array
    }
}
</script>

<style></style>
