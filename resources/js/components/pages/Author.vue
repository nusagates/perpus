<template>
    <v-container>
        <v-card>
            <v-card-text class="py-3">
                <v-list v-if="collection.authors!==null">
                    <v-list-item @click="dialog.author.create=true">
                        <v-list-item-content>
                            <v-list-item-title>
                                <v-icon>mdi-account-plus</v-icon>
                                Tambah Author
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                   <template v-for="(item, index) of collection.authors.data">
                       <v-list-item>
                           <v-list-item-avatar>
                               <v-img :src="item.avatar"/>
                           </v-list-item-avatar>
                           <v-list-item-content>
                               <v-list-item-title>{{item.name}}</v-list-item-title>
                           </v-list-item-content>
                       </v-list-item>
                   </template>
                </v-list>
            </v-card-text>
        </v-card>

        <v-dialog width="300" v-model="dialog.author.create">
            <v-card>
                <v-toolbar dense dark color="success">Tambah Author</v-toolbar>
                <v-card-text class="py-3">
                    <v-text-field v-model="field.author.name" dense outlined clearable label="Nama Author"/>
                </v-card-text>
                <v-card-actions class="justify-end">
                    <v-btn :loading="loading.author.store" :disabled="loading.author.store" @click="store"
                           color="success">Simpan
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <my-alert ref="alert"/>
    </v-container>
</template>

<script>
import MyAlert from "../parts/MyAlert";

export default {
    name: "Author",
    components: {MyAlert},
    data() {
        return {
            dialog: {
                author: {
                    create: false
                }
            },
            loading: {
                author: {
                    store: false,
                    get: false
                }
            },
            field: {
                author: {
                    name: null
                }
            },
            collection: {
                authors: null
            }
        }
    },
    methods: {
        getAuthors() {
            this.loading.author.get = false
            axios.get('/author').then(res => {
                if (res.data.code === 200) {
                    this.collection.authors = res.data.data
                } else {
                    this.$refs.alert.show(res.data.message, 'red')
                }
            }).finally(() => {
                this.loading.author.get = false
            })
        },
        store() {
            this.loading.author.store = true
            axios.post('/author', this.field.author).then(res => {
                if (res.data.code === 200) {
                    this.$refs.alert.show(res.data.message, 'success')
                    this.dialog.author.create = false
                    this.field.author.name = null
                    this.getAuthors()
                } else {
                    this.$refs.alert.show(res.data.message, 'red')
                }
            }).finally(() => {
                this.loading.author.store = false
            })
        }
    },
    mounted() {
        this.getAuthors()
    }
}
</script>

<style scoped>

</style>
