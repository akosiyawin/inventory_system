<template>
    <v-app id="inspire">
        <Sidebar/>
        <v-main>
            <v-container class="align-center flex-column centerTo justify-center d-flex">
                <h2 class="align-self-start mb-5">Product</h2>
                <v-alert
                    class="w-75 align-self-start"
                    type="success"
                    v-if="success"
                >New Product has been added!</v-alert>
                <v-form
                    class="w-100"
                    ref="form"
                    v-model="valid"
                    lazy-validation
                >
                    <v-select
                        v-model="form.category_id"
                        :items="categories"
                        :rules="rules.category"
                        item-text="title"
                        item-value="id"
                        label="Category"
                        required
                    ></v-select>

                    <v-text-field
                        v-model="form.title"
                        :rules="rules.title"
                        label="Name"
                        :error-messages="form.errors.get('title')"
                        required
                        @keydown="success = false; form.errors.clear('title')"
                    ></v-text-field>

                    <v-text-field
                        v-model="form.stock"
                        :rules="rules.stock"
                        label="Stock"
                        :error-messages="form.errors.get('stock')"
                        required
                        class="mt-3"
                        type="number"
                        @change="success = false; form.errors.clear('stock')"
                    ></v-text-field>

                    <v-menu
                        ref="menu"
                        v-model="menu"
                        :close-on-content-click="false"
                        :return-value.sync="form.manufactured_date"
                        transition="scale-transition"
                        offset-y
                        min-width="auto"
                    >
                        <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                v-model="form.manufactured_date"
                                label="Manufactured Date"
                                prepend-icon="mdi-calendar"
                                :rules="rules.manufactured_date"
                                :error-messages="form.errors.get('manufactured_date')"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            ></v-text-field>
                        </template>
                        <v-date-picker
                            v-model="form.manufactured_date"
                            no-title
                            scrollable
                        >
                            <v-spacer></v-spacer>
                            <v-btn
                                text
                                color="primary"
                                @click="menu = false"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                text
                                color="primary"
                                @click="$refs.menu.save(form.manufactured_date)"
                            >
                                OK
                            </v-btn>
                        </v-date-picker>
                    </v-menu>

                    <v-menu
                        ref="menuExp"
                        v-model="menuExp"
                        :close-on-content-click="false"
                        :return-value.sync="form.expiration_date"
                        transition="scale-transition"
                        offset-y
                        min-width="auto"
                    >
                        <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                v-model="form.expiration_date"
                                label="Expiration Date"
                                prepend-icon="mdi-calendar"
                                :rules="rules.expiration_date"
                                :error-messages="form.errors.get('expiration_date')"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            ></v-text-field>
                        </template>
                        <v-date-picker
                            v-model="form.expiration_date"
                            no-title
                            scrollable
                            @change="success = false; form.errors.clear('expiration_date')"
                        >
                            <v-spacer></v-spacer>
                            <v-btn
                                text
                                color="primary"
                                @click="menuExp = false"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                text
                                color="primary"
                                @click="$refs.menuExp.save(form.expiration_date)"
                            >
                                OK
                            </v-btn>
                        </v-date-picker>
                    </v-menu>

                    <v-btn
                        :disabled="!valid"
                        color="success"
                        class="mt-4 btn-block"
                        @click="submit"
                    >
                        Submit
                    </v-btn>

                </v-form>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import Form from "../tools/forms";
import Sidebar from "./Sidebar";
import api from "../tools/api";

export default {
    components: {Sidebar},
    data: () => ({
        valid: true,
        menu: false,
        success: false,
        menuExp: false,
        form: new Form({
            title: '',
            stock: 0,
            category_id: null,
            manufactured_date: new Date().toISOString().substr(0, 10),
            expiration_date: new Date().toISOString().substr(0, 10),
        }),
        rules: {
            title: [v => !!v || 'Name is required'],
            category: [v => !!v || 'Category is required'],
            stock: [v => !!v || 'Stock is required'],
            manufactured_date: [v => !!v || 'Manufactured Date is required'],
            expiration_date: [v => !!v || 'Expiration Date is required'],
        },
        categories: []
    }),
    methods: {
        submit() {
            if(this.$refs.form.validate()){
                this.form.post(api.productStore)
                .then(r=>{
                    this.$refs.form.reset()
                    this.success = true
                })
                .catch(r=>{
                    this.form.errors.set(r.errors)
                })
            }
        },

    },
    mounted() {
        api.getCategories()
        .then(r=>{
            this.categories = r.data.data
            this.form.category_id = r.data.data[0].id
        })
    }

}
</script>

<style scoped>
    .centerTo{
        height: 70vh;
    }
</style>
