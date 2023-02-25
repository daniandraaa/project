<template>
    <v-app style="background-color: background: rgb(2,45,69);
    background: linear-gradient(90deg, rgba(2,45,69,1) 0%, rgba(244,244,244,1) 50%, rgba(2,45,69,1) 100%);">
        <div class="d-flex justify-center mt-15">
            <v-card elevation="2" width="400" height="350" class="mt-16 rounded-xl">
                <div class="text-center" style="margin-top: 15px">
                    <h2 class="text-center text-blue-lighten-2" style="font-family: fantasy;">login</h2>
                </div>
                <v-card-text>
                    <v-text-field label="Username" outline v-model="form.username"
                        :error-messages="errors.username"></v-text-field>
                    <v-text-field label="Password" type="password" v-model="form.password" outline
                        :error-messages="errors.password"></v-text-field>
                    <v-btn class="bg-blue-lighten-4"  block @click="login">login</v-btn>
                    <div class="mt-5">
                        <v-btn class="bg-red-lighten-2" elevation="2" small x-small @click="register" >register</v-btn>
                    </div>
                </v-card-text>
            </v-card>
        </div>
    </v-app>
</template>

<script>
import { router } from '@inertiajs/vue3'
export default {
    props: {
        errors: Object
    },
    data() {
        return {
            form: {
                username: "",
                password: ""
            }
        };
    },
    methods: {
        login() {
            router.post('/login', this.form);
        },
        register() {
            router.get('/register');
        }
    },
};
</script>
