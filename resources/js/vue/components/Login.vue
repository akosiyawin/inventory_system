<template>
  <div class="row login">
    <form class="col-md-4" @submit.prevent="submitForm">
        <h2>Inventory System</h2>
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input
          type="email"
          v-model="form.email"
          :class="{ 'is-invalid': form.errors.has('email') }"
          class="form-control"
          id="exampleInputEmail1"
          aria-describedby="emailHelp"
          placeholder="Enter email"
        />
        <div class="invalid-feedback" v-text="form.errors.get('email')"></div>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input
          type="password"
          v-model="form.password"
          :class="{ 'is-invalid': form.errors.has('password') }"
          class="form-control"
          id="exampleInputPassword1"
          placeholder="Password"
        />
        <div
          class="invalid-feedback"
          v-text="form.errors.get('password')"
        ></div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
import Form from "../../vue/tools/forms";

export default {
  name: "Login",
  data() {
    return {
      form: new Form({
        email: "",
        password: "",
      }),
    };
  },
  methods: {
    submitForm() {
      this.form
        .post("/api/user/login")
        .then((response) => {
          this.$router.push({ name: "dashboard" });
        })
        .catch((err) => {
          this.form.errors.set(err.errors);
        });
    },
  },
};
</script>

<style scoped>
.login {
  height: 80vh;
  width: 100vw;
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
