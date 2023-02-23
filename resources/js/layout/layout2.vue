<template>
    <v-app id="inspire">
        <v-system-bar class="bg-blue">
            <v-spacer></v-spacer>
            <v-tooltip text="Logout">
                <template v-slot:activator="{ props }">
                <v-icon v-bind="props" color="red" @click="logout">mdi mdi-logout</v-icon>
            </template>
            </v-tooltip>
        </v-system-bar>

        <v-navigation-drawer v-model="drawer">
            <v-sheet color="grey-lighten-4" class="pa-4">
                <div>{{ user.nama }} ({{ user.level }})</div>
            </v-sheet>

            <v-divider></v-divider>

            <v-list>
                <Link href="/masyarakat" as="div">
                <v-list-item to="masyarakat">
                    <template v-slot:prepend>
                        <v-icon>mdi mdi-home-account</v-icon>
                    </template>

                    <v-list-item-title>Home</v-list-item-title>
                </v-list-item>
                </Link>
                <Link href="/masyarakat/pengaduan" as="div">
                <v-list-item to="masyarakat">
                    <template v-slot:prepend>
                        <v-icon>mdi mdi-bug</v-icon>
                    </template>

                    <v-list-item-title>Pengaduan</v-list-item-title>
                </v-list-item>
                </Link>
            </v-list>
        </v-navigation-drawer>

        <v-main>
            <v-container class="py-8 px-6" fluid>
                <slot></slot>
            </v-container>
        </v-main>
    </v-app>

</template>

<script>

import { Link, router } from "@inertiajs/vue3";
export default {
    components: {
        Link,
    },
    data: () => ({
        drawer: null,
    }),
    computed: {
        user() {
            return this.$page.props.auth.user
        }
    },
    methods:{
        logout(){
            router.get('/logout')
        }
    }
}
</script>

<style>

</style>
