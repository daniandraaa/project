<template>
  <h1>ini register</h1>

  <v-table class="mx-10 my-10 text-left">
            <thead class="bg-grey">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Username</th>
                    <th>No. Handphone</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(row, i) in reg" :key="i++">
                    <td>{{ i }}</td>
                    <td>{{ row.nama }}</td>
                    <td>{{ row.nik }}</td>
                    <td>{{ row.username }}</td>
                    <td>{{ row.tlp }}</td>

                    <td>
                        <v-btn color="primary" @click="Konfirmasi(row.id)">konfirmasi</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>
</template>

<script>
import {router} from '@inertiajs/vue3';
import layout from '../../layout/layout.vue'
export default{
    props:{
        reg:Array
    },
    layout:layout,
   methods:{
        Konfirmasi($id){
            router.visit('/admin/register/'+$id,{
                method:'get',
                preserveState:true,
                preserveScroll: true,
            })
        }
    }
}
</script>

<style>

</style>
