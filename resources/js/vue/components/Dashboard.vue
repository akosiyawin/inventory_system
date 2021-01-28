<template>
    <v-app id="inspire">
        <Sidebar/>
        <v-main class="ma-4">
            <div class="container-fluid">
                <v-row>
                    <v-col>
                        <v-card
                            max-width="725"
                            outlined
                        >
                            <v-list-item three-line>
                                <v-list-item-content>
                                    <div class="overline mb-4">
                                        PRODUCTS
                                    </div>
                                    <v-list-item-title class="headline mb-1">
                                        Available Products
                                    </v-list-item-title>
                                </v-list-item-content>
                                <v-list-item-avatar
                                    size="80"
                                    color="error"
                                >{{products}}
                                </v-list-item-avatar>
                            </v-list-item>
                            <v-card-actions>
                                <v-btn
                                    outlined
                                    rounded
                                    text
                                    :to="{name: 'inventory'}"
                                >
                                    View
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                    <v-col>
                        <v-card
                            max-width="725"
                            outlined
                        >
                            <v-list-item three-line>
                                <v-list-item-content>
                                    <div class="overline mb-4">
                                        STOCKS
                                    </div>
                                    <v-list-item-title class="headline mb-1">
                                        Total Stocks
                                    </v-list-item-title>
                                </v-list-item-content>
                                <v-list-item-avatar
                                    size="80"
                                    color="green"
                                >{{stocks}}
                                </v-list-item-avatar>
                            </v-list-item>
                            <v-card-actions>
                                <v-btn
                                    outlined
                                    rounded
                                    text
                                    :to="{name: 'inventory'}"
                                >
                                    View
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                    <v-col>
                        <v-card
                            max-width="725"
                            outlined
                        >
                            <v-list-item three-line>
                                <v-list-item-content>
                                    <div class="overline mb-4">
                                        CATEGORIES
                                    </div>
                                    <v-list-item-title class="headline mb-1">
                                        Total Categories
                                    </v-list-item-title>
                                </v-list-item-content>
                                <v-list-item-avatar
                                    size="80"
                                    color="orange"
                                >{{categories}}
                                </v-list-item-avatar>
                            </v-list-item>
                            <v-card-actions>
                                <v-btn
                                    outlined
                                    rounded
                                    text
                                    :to="{name: 'category'}"
                                >
                                    View
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </div>
            <v-container>
                <v-row>
                    <v-col>
                        <v-card
                            outlined>
                            <v-list-item-content>
                                <canvas
                                    id="donutChart"
                                    style="
                                      min-height: 350px;
                                      height: 350px;
                                      max-height: 350px;
                                      max-width: 100%;
                                    "
                                ></canvas>
                            </v-list-item-content>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import Sidebar from "./Sidebar";
import api from "../tools/api";

export default {
    components: {Sidebar},
    data: () => ({
        drawer: null,
        products: 0,
        categories: 0,
        stocks: 0,
    }),
    mounted() {
        api.getStatistics()
        .then(r=>{
            this.products = r.data.data.products
            this.categories = r.data.data.categories
            this.stocks = r.data.data.stocks
            this.setStatistics()
        })
    },
    methods: {
        setStatistics() {
            let donutChartCanvas = $("#donutChart").get(0).getContext("2d");
            let donutData = {
                labels: ["Products", "Stocks", "Categories"],
                datasets: [
                    {
                        data: [this.products, this.stocks, this.categories],
                        backgroundColor: [
                            "#f56954",
                            "#00a65a",
                            "#f39c12",
                            "#00c0ef",
                            "#3c8dbc",
                            "#d2d6de",
                        ],
                    },
                ],
            };
            let donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            };
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            let donutChart = new Chart(donutChartCanvas, {
                type: "doughnut",
                data: donutData,
                options: donutOptions,
            });
        }
    }
};
</script>

