<template>
    <v-app-bar
        fixed
        app
        dark
        class="light-blue darken-4"
    >
        <v-app-bar-nav-icon 
            v-if="auth.name"
            @click="toggleDrawer" 
        />

        <span v-show="$router.currentRoute.name == 'home'">
            <v-toolbar-title>Stormwind Bank</v-toolbar-title>
        </span>

        <v-spacer></v-spacer>

        <span
            v-if="!loggedIn"
        >
            <v-btn 
                :to="{ name: 'login' }"
                text
            >
                Login
            </v-btn>
        </span>
        <span 
            v-else
        >
            <v-menu offset-y>
            <template v-slot:activator="{ on }">
                <v-btn
                    v-on="on"
                    icon
                >
                    <v-icon>mdi-dots-vertical</v-icon>
                </v-btn>
            </template>
            <v-list>
                <v-list-item>
                    <v-list-item-avatar>
                        <img src="/img/default/default.png">
                    </v-list-item-avatar>

                    <v-list-item-content>
                        <v-list-item-title>{{ auth.name }}</v-list-item-title>
                        <v-list-item-subtitle>{{ authRole.name }}</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item
                    @click="$router.push({ name: 'dashboard' })"
                >
                    <v-list-item-title>Go to Dashboard</v-list-item-title>
                </v-list-item>
                <v-list-item
                    @click="logout"
                >
                    <v-list-item-title>Logout</v-list-item-title>
                </v-list-item>
            </v-list>
            </v-menu>
        </span>

    </v-app-bar>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
    name: 'Navbar',
    computed: mapGetters(['loggedIn', 'auth', 'authRole']),
    methods: {
        logout() {
            this.authLogOut()
        },
        
        ...mapActions(['authLogOut', 'toggleDrawer']),
    }
}
</script>