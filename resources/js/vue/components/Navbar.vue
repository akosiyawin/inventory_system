<template>
  <nav class="bg-white shadow-sm navbar navbar-expand-md navbar-light">
    <div class="container">
      <a class="navbar-brand" href="wass"> Inventory </a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle Nav"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="mr-auto navbar-nav"></ul>
        <!-- Right Side Of Navbar -->
        <ul class="ml-auto navbar-nav" v-if="!isLoggedIn">
          <!-- Authentication Links -->
          <li class="nav-item">
            <router-link class="nav-link" to="/login">Login</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/register">Register</router-link>
          </li>
        </ul>

        <ul class="ml-auto navbar-nav" v-if="isLoggedIn">
          <li class="nav-item">
            <a class="nav-link" href="#" @click="logout">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import Api from "../tools/api";

export default {
  name: "Navbar",
  data() {
    return {
      isLoggedIn: false,
    };
  },
  methods: {
    setLoggedIn() {
      Api.isLoggedIn()
        .then((r) => {
          this.loggedIn = true;
        })
        .catch((err) => {
          this.loggedIn = false;
        });
    },
    logout() {
      axios.post("/api/user/logout").then(() => {
        this.$root.$emit("toggleLogin", false);
        this.$router.push({ name: "login" });
      });
    },
  },
  mounted() {
    this.setLoggedIn();
    this.$root.$on("toggleLogin", (status) => {
      this.isLoggedIn = status;
    });
  },
};
</script>

<style>
</style>
