<template>
    <!--  Todo: Fix search bar  -->
    <v-app id="inspire">
        <Sidebar/>
        <v-main>
            <v-container>
                <v-card>
                    <v-card-title>
                        Inventories
                        <v-spacer></v-spacer>
                        <v-text-field
                            v-model="search"
                            append-icon="mdi-magnify"
                            label="Search"
                            single-line
                            hide-details
                        ></v-text-field>
                    </v-card-title>
                    <v-data-table
                        :headers="headers"
                        :items="items"
                        :search="search"
                    >
                        <template v-slot:item.action="{ item }">
                            <div class="d-flex justify-space-around">
                                <v-btn
                                    fab
                                    dark
                                    x-small
                                    color="success"
                                    @click="setEditDialog(item.code)"
                                >
                                    <v-icon dark>
                                        mdi-pencil
                                    </v-icon>
                                </v-btn>
                                <v-btn
                                    fab
                                    dark
                                    x-small
                                    color="red"
                                    @click="deleteProductPrompt(item.code)"
                                >
                                    <v-icon dark>
                                        mdi-delete
                                    </v-icon>
                                </v-btn>
                                <v-btn
                                    color="red"
                                    small
                                    dark
                                    @click="decrease(item.code)"
                                >
                                    <v-icon dark>
                                        mdi-minus
                                    </v-icon>
                                </v-btn>
                                <v-btn
                                    color="primary"
                                    small
                                    dark
                                    @click="increase(item.code)"
                                >
                                    <v-icon dark>
                                        mdi-plus
                                    </v-icon>
                                </v-btn>
                            </div>
                        </template>
                        <template v-slot:item.stock="{ item }">
                            <span class="pa-2 orange text-no-wrap rounded-b-xl" :id="'stock-'+item.code">{{
                                    item.stock
                                }}</span>
                        </template>
                    </v-data-table>
                </v-card>
            </v-container>
        </v-main>


        <!--   Error Message     -->
        <v-dialog
            max-width="500"
            v-model="dialog.value"
        >
            <v-card>
                <v-toolbar
                    color="error"
                    dark
                >Inventory System Error Message
                </v-toolbar>
                <v-card-text>
                    <div class="text-h5 pa-12">{{ dialog.text }}</div>
                </v-card-text>
                <v-card-actions class="justify-end">
                    <v-btn
                        text
                        @click.stop="dialog.value = false"
                    >Close
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <Product :form="form" :categories="categories" :rules="rules" :get-products="getProducts"
                 :edit-dialog="editDialog" :toggle="toggleEditDialog"/>

        <Question :dialog="questionDialog" :toggle="toggleQuestionDialog" :get-products="getProducts"/>
    </v-app>
</template>

<script>
import Sidebar from "./Sidebar";
import api from "../tools/api";
import Form from "../tools/forms";
import Product from "./Dialog/Product";
import Question from "./Dialog/Question";

export default {
    name: "Inventory",
    components: {Question, Product, Sidebar},
    watch: {
        items() {
            return []
        }
    },
    data: () => ({
        form: new Form({
            id: 0,
            title: '',
            stock: 0,
            category_id: 1,
            manufactured_date: new Date().toISOString().substr(0, 10),
            expiration_date: new Date().toISOString().substr(0, 10),
        }),
        rules: {
            title: [v => !!v || 'Name is required'],
            category_id: [v => !!v || 'Category is required'],
            stock: [v => !!v || 'Stock is required'],
            manufactured_date: [v => !!v || 'Manufactured Date is required'],
            expiration_date: [v => !!v || 'Expiration Date is required'],
        },
        items: [],
        search: '',
        dialog: {value: false, text: null},
        questionDialog: {value: false, text: null, userID: null},
        editDialog: false,
        categories: [
            {title: "Foo", id: 1}
        ],
        headers: [
            {text: 'Product Code', value: 'code',},
            {text: 'Product Name', value: 'title'},
            {text: 'Product Category', value: 'category'},
            {text: 'Stock', value: 'stock'},
            {text: 'Manufactured Date', value: 'manufactured_date'},
            {text: 'Expiration Date', value: 'expiration_date'},
            {text: 'Action', value: 'action'},
        ],
    }),
    mounted() {
        this.getProducts()
        api.getCategories()
        .then(r => {
            this.categories = r.data.data
        })
    },
    methods: {
        toggleEditDialog() {
            this.editDialog = !this.editDialog
        },
        toggleQuestionDialog() {
            this.questionDialog.value = !this.questionDialog.value
        },
        setEditDialog(product) {
            api.getProduct(product)
            .then(response => {
                const item = response.data.data
                this.toggleEditDialog()
                this.form.id = item.code
                this.form.title = item.title
                this.form.stock = item.stock
                this.form.category_id = item.category_id
                this.form.manufactured_date = item.manufactured_date
                this.form.expiration_date = item.expiration_date
            })
        },
        deleteProductPrompt(id) {
            this.questionDialog.value = true
            this.questionDialog.userID = id
        },
        increase(id) {
            api.increaseStock(id)
            .then(r => {
                this.getProducts()
            })
            .catch(err => {
                this.dialog.text = err.response.data.message
                this.dialog.value = true
            })
        },
        decrease(id) {
            api.decreaseStock(id)
            .then(r => {
                this.getProducts()
            })
            .catch(err => {
                this.dialog.text = err.response.data.message
                this.dialog.value = true
            })
        },
        getProducts() {
            return api.getProducts()
            .then(r => {
                this.items = r.data.data
            })
        }
    }
}
</script>

<style scoped>

</style>
