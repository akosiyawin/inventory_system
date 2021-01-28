<template>
    <v-app id="inspire">
        <Sidebar/>
        <v-main>
            <v-container class="align-center flex-column h-50 justify-end d-flex">
                <h2 class="align-self-start mb-5">New Category</h2>
                <v-alert
                    class="w-75 align-self-start"
                    type="success"
                    v-if="success"
                >New Category has been added!</v-alert>
                <v-form
                    class="w-100 mb-10"
                    ref="form"
                    v-model="valid"
                    lazy-validation
                    @submit.prevent="submit"
                >
                    <v-text-field
                        v-model="form.title"
                        :rules="rules.title"
                        label="Name"
                        :error-messages="form.errors.get('title')"
                        @keydown="form.errors.clear('title'); success = false; deleted = false"
                        required
                    ></v-text-field>
                    <v-btn
                        type="submit"
                        :disabled="!valid"
                        color="success"
                        class="mt-4 btn-block"
                    >
                        Submit
                    </v-btn>
                </v-form>
            </v-container>
            <v-container >
                <div class="align-center flex-column h-50 d-flex">
                    <h2 class="align-self-start my-5">Available Categories</h2>
                    <v-alert
                        class="w-75 align-self-start"
                        type="error"
                        v-if="deleted"
                    >Category has been deleted</v-alert>
                    <v-simple-table class="w-100 table-responsive">
                        <template v-slot:default>
                            <thead>
                            <tr>
                                <th class="text-left">
                                    Name
                                </th>
                                <th class="text-left">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr
                                v-for="item in categories"
                                :key="item.id"
                            >
                                <td>{{ item.title }}</td>
                                <td>
                                    <v-btn
                                        tile
                                        color="error"
                                        @click="onDelete(item.id)"
                                    >
                                        <v-icon left>
                                            mdi-delete
                                        </v-icon>
                                        Delete
                                    </v-btn>
                                </td>
                            </tr>
                            </tbody>
                        </template>
                    </v-simple-table>
                </div>
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
                    <div class="text-h5 pa-12">{{dialog.text}}</div>
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
    </v-app>
</template>

<script>
import Form from "../tools/forms";
import Sidebar from "./Sidebar";
import api from "../tools/api";

export default {
    name: "CreateCategory",
    components: {Sidebar},
    data: () => ({
        dialog: {value:false,text:null},
        valid: false,
        success: false,
        deleted: false,
        form: new Form({
            title: ''
        }),
        rules: {
            title: [v => !!v || 'Category name is required']
        },
        categories: []
    }),
    methods: {
        submit() {
            if (this.$refs.form.validate())
                this.form.post(api.categoryStore)
                .then(r => {
                    this.success = true
                    this.$refs.form.reset()
                    this.getCategories()
                })
                .catch(error=>{
                    this.form.errors.set(error.errors)
                })
        },
        getCategories() {
            api.getCategories()
                .then(r=>{
                    this.categories = r.data.data
                })
        },
        titleChange(){
            this.form.errors.clear('title')
            console.log(1)
        },
        onDelete(id){
            api.deleteCategory(id)
            .then(r=>{
                this.deleted = true
                this.getCategories()
            })
            .catch(err=>{
                this.dialog.text = err.response.data.message
                this.dialog.value = true
            })
            this.success = false
        }
    },
    mounted() {
        this.getCategories()
    }
}
</script>
