<template>
    <v-container>
        <v-layout justify-center>
            <v-card max-width="300">
                <v-toolbar dense dark color="success">Login</v-toolbar>
                <v-card-text class="py-3">
                    <v-text-field dense outlined clearable label="Email" v-model="field.email"/>
                    <v-text-field dense outlined clearable label="Password" type="password" v-model="field.password"/>
                </v-card-text>
                <v-card-actions>
                    <v-btn href="/register" text color="orange">Register</v-btn>
                    <v-spacer/>
                    <v-btn :disabled="loading.login" :loading="loading.login" @click="login" color="success">Login
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-layout>
        <my-alert ref="alert"/>
    </v-container>
</template>

<script>
import MyAlert from "../parts/MyAlert";
export default {
    components: {MyAlert},
    data() {
        return {
            field: {
                email: null,
                password: null
            },
            loading: {
                login: false
            }
        }
    },
    methods: {
        login() {
            this.loading.login = true
            axios.post('login', this.field).then(res => {
                if (res.data.code === 200) {
                    this.$refs.alert.show(res.data.message, 'success')
                    location.href = '/home'
                } else {
                    this.$refs.alert.show(res.data.message)
                }
            }).finally(f => {
                this.loading.login = false
            })
        }
    }
}
</script>

<style scoped>

</style>
