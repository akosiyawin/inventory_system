<template>
    <v-dialog
        v-model="dialog.value"
        persistent
        max-width="290"
    >
        <v-card>
            <v-card-title class="headline">
                Delete Product?
            </v-card-title>
            <v-card-text>Please confirm, if you wish to delete this product.
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="green darken-1"
                    text
                    @click="toggle"
                >
                    Cancel
                </v-btn>
                <v-btn
                    color="error darken-1"
                    text
                    @click="deleteProduct"
                >
                    Confirm
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import api from "../../tools/api";

export default {
    name: "Question",
    props: {
        toggle: Function,
        dialog: Object,
        getProducts: Function
    },
    methods: {
        deleteProduct() {
            api.deleteProduct(this.dialog.userID)
                .then(r => {
                    this.getProducts()
                    this.toggle()
                })
        }
    }

}
</script>

<style scoped>

</style>
