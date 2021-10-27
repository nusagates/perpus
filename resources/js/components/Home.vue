<template>
    <v-container fluid>
        <v-btn @click="dialog=true" color="success">Testing</v-btn>
        <v-dialog max-width="250" v-model="dialog">
           <v-card>
               <v-toolbar dense color="success" dark>Testing Dialog</v-toolbar>
               <v-card-text class="py-3">
                   Ini dalah tubuh dialog
               </v-card-text>
               <v-card-actions class="justify-end">
                   <v-btn @click="dialog=false" color="success">Tutup</v-btn>
               </v-card-actions>
           </v-card>
        </v-dialog>
    </v-container>
</template>

<script>
export default {
   data(){
       return{
           dialog: false
       }
   }
}
</script>

<style scoped>

</style>
