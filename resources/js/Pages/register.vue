<template>
    <v-app style="background-color: background: rgb(2,45,69);
    background: linear-gradient(90deg, rgba(2,45,69,1) 0%, rgba(244,244,244,1) 50%, rgba(2,45,69,1) 100%);">
        <v-main>
            <div class="d-flex justify-center mt-15 ">
                <v-card elevation="2" width="400" height="600" class="mt-7 rounded-xl">
                    <div class="text-center">
                        <h2 class="text-center mt-5" style="font-family: fantasy;">Register</h2>
                    </div>
                    <v-card-text>
                        <v-text-field label="Nama Lengkap" v-model="form.nama" outline :error-messages="errors.nama"></v-text-field>
                        <v-text-field label="NIK" v-model="form.nik" :error-messages="errors.nik"  outline></v-text-field>
                        <v-text-field label="No Telpon" v-model="form.tlp" outline :error-messages="errors.tlp"></v-text-field>
                        <v-text-field label="Username" v-model="form.username" outline :error-messages="errors.username"></v-text-field>
                        <v-text-field label="Password" v-model="form.password" outline :error-messages="errors.password"></v-text-field>
                        <!-- <v-select v-model="form.level" :items="['admin', 'petugas', 'masyarakat']" label="Level" variant="outlined" :error-messages="errors.level"></v-select> -->
                        <v-btn block class="bg-blue-lighten-4" @click="register">register</v-btn>
                        <div class="mt-5">
                            <v-btn class="bg-red-lighten-2" elevation="2" small x-small @click="login">login</v-btn>
                        </div>
                    </v-card-text>
                </v-card>
            </div>
        </v-main>
    </v-app>
</template>

<script>
import { router } from '@inertiajs/vue3'
export default {
    props:{
        errors:Object
    },
    data() {
        return {
            form: {
                nama: "",
                nik: "",
                tlp: "",
                username: "",
                password: "",
            }
        }
    },
    methods: {
        login() {
            router.get('/');
        },
        register() {
        //     router.visit('/', {
        //         method: 'post',
        //         data: {
        //             id: this.form.id,
        //             nama: this.form.nama,
        //             nik: this.form.nik,
        //             username: this.form.username,
        //             tlp: this.form.tlp,
        //             password: this.form.password,
        //             level: this.form.level,
        //         },
        //         preserveState: false,
        //         preserveScroll: false,
        //         onSuccess: () => {
        //             this.login();
        //         }
        // });
        router.post('/register', this.form)
    }
}
};
</script>

<style>

</style>
