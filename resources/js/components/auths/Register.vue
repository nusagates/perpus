<template>
    <v-container>
        <v-layout justify-center>
            <v-card max-width="300">
                <v-toolbar dense color="success" dark>Registrasi</v-toolbar>
                <v-card-text class="py-3">
                    <p>Silahkan isi form di bawah ini untuk mendaftar</p>
                    <v-text-field dense outlined label="Nama Lengkap" v-model="field.name"/>
                    <v-text-field dense outlined label="Email" v-model="field.email" type="email"/>
                    <v-text-field dense outlined label="Nomor Telpon" v-model="field.phone" type="tel"/>
                    <v-text-field dense outlined label="Password" v-model="field.password" type="password"/>
                    <v-text-field dense outlined label="Konfirmasi Password" v-model="field.password_confirmation"
                                  type="password"/>
                </v-card-text>
                <v-card-actions>
                    <v-btn href="/login" text color="orange">Masuk</v-btn>
                    <v-spacer/>
                    <v-btn @click="register" :loading="loading.register" :disabled="loading.register" class="success">
                        Kirim
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-layout>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            field: {
                name: null,
                email: null,
                phone: null,
                password: null,
                password_confirmation: null
            },
            loading: {
                register: false
            }
        }
    },
    methods: {
        register() {
            this.loading.register = true
            axios.post('signup', this.field).then(res => {
                if (res.data.code === 200) {
                    alert(res.data.message)
                    this.field = {
                        name: null,
                        email: null,
                        phone: null,
                        password: null,
                        password_confirmation: null
                    }
                } else {
                    alert(res.data.message)
                }
            }).finally(f => {
                this.loading.register = false
            })
        }
    }
}
</script>

<style scoped>

</style>
