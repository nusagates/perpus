<template>
    <v-snackbar :color="color" v-model="snackbar">{{ message }}</v-snackbar>
</template>

<script>
export default {
    name: "MyAlert",
    data() {
        return {
            snackbar: false,
            message: null,
            color: 'red'
        }
    },
    methods: {
        show(message, color) {
            this.message = message
            this.snackbar = true
            if(color!==undefined){
                this.color = color
            }
        }
    }
}
</script>

<style scoped>

</style>
