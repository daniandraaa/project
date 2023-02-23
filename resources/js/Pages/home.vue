<template>
    <v-app>
        <div class="d-flex justify-center">
            <v-card elevation="2" width="400" height="350" class="mt-15">
                <div class="text-center" style="margin-top: 15px">
                    
                    <h2 class="text-center">login</h2>
                </div>
                <v-card-text>
                    <v-text-field label="Username" outline v-model="form.username" :error-messages="errors.username"></v-text-field>
                    <v-text-field label="Password" type="password" v-model="form.password" outline :error-messages="errors.password"></v-text-field>
                    <v-btn block color="primary" @click="login">login</v-btn>
                    <div class="mt-5">
                        <v-btn elevation="2" small x-small @click="register">register</v-btn>
                    </div>
                </v-card-text>
            </v-card>
        </div>
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
