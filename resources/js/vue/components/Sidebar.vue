<template>
  <div>
    <v-navigation-drawer v-model="drawer" app>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="title">INVENTORY SYSTEM</v-list-item-title>
          <v-list-item-subtitle> BY Computer Science</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
      <v-divider></v-divider>
      <v-list dense nav>
        <v-list-item v-for="item in items" :key="item.title" :to="item.to" link>
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
      <template v-slot:append>
        <div class="pa-2 d-flex flex-column align-center">
          <v-progress-circular
            v-if="isLoggingOut"
            :size="50"
            color="primary"
            indeterminate
          ></v-progress-circular>
          <v-btn block color="error" v-if="!isLoggingOut" @click="logout()">
            Logout
          </v-btn>
        </div>
      </template>
    </v-navigation-drawer>
    <v-app-bar app>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>
        {{ pageName }}
      </v-toolbar-title>
    </v-app-bar>
  </div>
</template>

<script>
import api from "../tools/api";

export default {
  name: "Sidebar",
  data: () => ({
    drawer: null,
    pageName: null,
    items: [
      { title: "Dashboard", icon: "mdi-view-dashboard", to: "/dashboard" },
      { title: "Inventory", icon: "mdi-archive", to: "/inventory" },
      {
        title: "New Product",
        icon: "mdi-archive-arrow-down",
        to: "/create-product",
      },
      { title: "Category", icon: "mdi-shape", to: "/create-category" },
    ],
    isLoggingOut: false,
  }),
  methods: {
    logout() {
      this.isLoggingOut = true;
      api.logout().then((r) => {
        this.$router.push("login");
      });
    },
    setPageName() {
      if (this.$route.name === "create") {
        this.pageName = "New Product";
      }
      if (this.$route.name === "inventory") {
        this.pageName = "Inventory";
      }
      if (this.$route.name === "dashboard") {
        this.pageName = "Dashboard";
      }
      if (this.$route.name === "category") {
        this.pageName = "Categories";
      }
    },
  },
  created() {
    this.setPageName();
  },
};
</script>

<style scoped>
</style>
