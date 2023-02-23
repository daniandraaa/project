<template>
    <v-app id="inspire">
        <v-navigation-drawer v-model="drawer">
            <v-list density="compact">
                <v-list-subheader>{{ user.nama }}</v-list-subheader>
                <Link  href="/admin" as="div">
                <v-list-item active-color="primary" to="/admin">
                    <template v-slot:prepend>
                        <v-icon icon="mdi-view-dashboard"></v-icon>
                    </template>

                    <v-list-item-title>Dashboard</v-list-item-title>
                </v-list-item>
                </Link>
                <Link v-if="user.level== 'admin'" href="/admin/user" as="div">
                <v-list-item active-color="primary" to="/admin/user">
                    <template v-slot:prepend>
                        <v-icon icon="mdi-account-group"></v-icon>
                    </template>

                    <v-list-item-title>{{ user.level }}</v-list-item-title>
                </v-list-item>
                </Link>
                <Link v-if="user.level == 'admin'" href="/admin/register" as="div">
                <v-list-item active-color="primary" to="/admin/user">
                    <template v-slot:prepend>
                        <v-icon icon="mdi-account-group"></v-icon>
                    </template>

                    <v-list-item-title>User Register</v-list-item-title>
                </v-list-item>
                </Link>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

            <v-toolbar-title>{{ user.level }}</v-toolbar-title>
            <v-spacer />
            <v-btn @click="logout">logout</v-btn>
        </v-app-bar>

        <v-main>
            <v-container>
                <slot />
            </v-container>
        </v-main>
    </v-app>
</template>
<script>
import { router, Link } from '@inertiajs/vue3'
export default {
    components: {
        Link
    },
    data: () => ({ drawer: null }),
    computed:{
        user(){
            return this.$page.props.auth.user
        }
    },
    methods: {
        logout() {
            router.get('/logout');
        }
    }
}
</script>
<style>

</style>
