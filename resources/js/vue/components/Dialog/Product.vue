<template>
    <!--    Modal Form    -->
    <v-dialog
        v-model="editDialog"
        persistent
        max-width="600px"
    >
        <v-card>
            <v-card-title>
                <span class="headline">Product Information</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-form
                            class="w-100"
                            ref="form"
                            v-model="valid"
                            lazy-validation
                        >
                            <v-col cols="12">
                                <v-text-field
                                    v-model="form.id"
                                    label="Code"
                                    disabled
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-select
                                    v-model="form.category_id"
                                    :items="categories"
                                    :rules="rules.category_id"
                                    item-text="title"
                                    item-value="id"
                                    label="Category"
                                    required
                                ></v-select>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    v-model="form.title"
                                    :rules="rules.title"
                                    label="Name"
                                    :error-messages="form.errors.get('title')"
                                    required
                                    @keydown="success = false; form.errors.clear('title')"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    v-model="form.stock"
                                    :rules="rules.stock"
                                    label="Stock"
                                    :error-messages="form.errors.get('stock')"
                                    required
                                    class="mt-3"
                                    type="number"
                                    min="0"
                                    @keydown="success = false; form.errors.clear('stock')"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
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
                            </v-col>
                            <v-col
                                cols="12"
                            >
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
                            </v-col>
                        </v-form>
                    </v-row>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="toggle"
                >
                    Close
                </v-btn>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="submit"
                >
                    Save
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import api from "../../tools/api";

export default {
    name: "Product",
    props: {
        form : Object,
        rules : Object,
        editDialog: Boolean,
        toggle: Function,
        toggleValid: Boolean,
        categories: Array,
        getProducts: Function,
    },
    data: () => ({
        menuExp: false,
        menu: false,
        valid: false,
    }),
    methods: {
        submit() {
            if (this.$refs.form.validate()) {
                this.form.patch(api.productUpdate(this.form.id))
                    .then(res => {
                        this.$refs.form.reset()
                        this.toggle()
                        this.getProducts()
                    })
                    .catch(err => {
                        this.form.errors.set(err.errors)
                    })
            }
        },
    }
}
</script>

<style scoped>

</style>
