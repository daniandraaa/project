<template>
    <div class="mx-10 my-10 text-right">
        <v-dialog v-model="dialog_insert">
            <template v-slot:activator="{ props }">
                <v-btn prepend-icon="mdi-plus" color="primary" rounded v-bind="props">
                    Tambah
                </v-btn>
            </template>

            <v-card>
                <v-card-text>
                    <p style="font-size: 20px; margin-bottom: 5px; margin-top: -5px;" class="text-center">Isi Data</p>
                    <v-form>
                        <v-text-field v-model="form.nama" label="Nama Lengkap" variant="outlined"
                            clearable :error-messages="errors.nama"></v-text-field>
                        <v-text-field v-model="form.nik" label="NIK" variant="outlined" clearable></v-text-field>
                        <v-text-field v-model="form.tlp" label="No. Telpon" variant="outlined" clearable :error-messages="errors.tlp"></v-text-field>
                        <v-text-field v-model="form.username" label="Username" variant="outlined"
                            clearable :error-messages="errors.username"></v-text-field>
                        <v-text-field v-model="form.password" label="Password" variant="outlined"
                            clearable :error-messages="errors.password"></v-text-field>
                        <v-select v-model="form.level" :items="['admin', 'petugas', 'masyarakat']" label="Level"
                            variant="outlined" :error-messages="errors.level"></v-select>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-btn color="primary" inline @click="batal"
                        style="margin-top:-30px; border:1px solid black; background-color: pink;;">Batal</v-btn>
                    <v-btn color="primary" inline @click="simpan"
                        style="margin-top:-30px; border:1px solid black; background-color: pink;">Simpan</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="dialog_hapus" width="300">
            <v-card-text>apakah anda ingin menghapus?</v-card-text>
            <v-card-actions>
                    <v-btn color="primary" inline @click="batal">Tidak</v-btn>
                    <v-btn color="red" inline @click="hapus">Ya</v-btn>
                </v-card-actions>
        </v-dialog>
        <v-table class="mx-10 my-10 text-left">
            <thead class="bg-grey">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Username</th>
                    <th>No. Handphone</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(row, i) in data" :key="i++">
                    <td>{{ i }}</td>
                    <td>{{ row.nama }}</td>
                    <td>{{ row.nik }}</td>
                    <td>{{ row.username }}</td>
                    <td>{{ row.tlp }}</td>
                    <td>{{ row.level }}</td>
                    <td>
                        <v-btn color="primary" icon="mdi-pencil" size="small" class="mr-3" @click="edit(row.id)" ></v-btn>
                        <v-btn color="red" icon="mdi-delete-forever" size="small" class="ml-3" @click="konfirmasi(row.id)"></v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>
    </div>
</template>

<script>
import { router } from '@inertiajs/vue3'
import layout from '../../layout/layout.vue';
export default {
    props: {
        data: Array,
        errors:Object
    },
    data() {
        return {
            dialog_insert: false,
            dialog_hapus: false,
            form: {
                id: "",
                nama: "",
                nik: "",
                username: "",
                password: "",
                level: "",
                tlp: "",
            }
        }
    },
    methods: {
        simpan() {
            router.visit('/admin/user', {
                method: 'post',
                data: {
                    id: this.form.id,
                    nama: this.form.nama,
                    nik: this.form.nik,
                    username: this.form.username,
                    tlp: this.form.tlp,
                    password: this.form.password,
                    level: this.form.level,
                },
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => {
                    this.batal();
                }
            });
        },
        batal(){
        this.form.nama="";
        this.form.nik="";
        this.form.password="";
        this.form.tlp="";
        this.form.username="";
        this.form.level="";
        this.form.id="";
        this.dialog_insert=false;
        this.dialog_hapus=false;
    },
    konfirmasi($id){
        this.form.id = $id
        this.dialog_hapus = true
    },
    edit($id){
        fetch('/admin/user/'+$id).then(res => res.json()).then(data => {
            this.form.id=data.id
            this.form.nama=data.nama
            this.form.nik=data.nik
            this.form.username=data.username
            this.form.level=data.level
            this.form.tlp=data.tlp
            this.dialog_insert=true
        })
    },
    hapus(){
        router.visit('/admin/user/' +this.form.id, {
            method:'delete',
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                    this.batal();
                }
        })
    }
    },
    layout: layout
}
</script>

<style>

</style>
