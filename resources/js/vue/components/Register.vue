<template>
  <div class="row login">
    <form class="col-md-4" @submit.prevent="submitForm">
      <h2>Registration Form</h2>
      <hr class="my-4" />
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input
          type="email"
          v-model="form.email"
          class="form-control"
          :class="{ 'is-invalid': form.errors.has('email') }"
          id="exampleInputEmail1"
          aria-describedby="emailHelp"
          placeholder="Enter email"
        />
        <small
          id="emailHelp"
          v-if="!form.errors.has('email')"
          class="form-text text-muted"
          >We'll never share your email with anyone else.</small
        >
        <div class="invalid-feedback" v-text="form.errors.get('email')"></div>
      </div>
      <div class="form-group">
        <label for="fName">First Name</label>
        <input
          type="text"
          v-model="form.first_name"
          :class="{ 'is-invalid': form.errors.has('first_name') }"
          class="form-control"
          id="fName"
          aria-describedby="fname"
          placeholder="Enter First Name"
        />
        <div
          class="invalid-feedback"
          v-text="form.errors.get('first_name')"
        ></div>
      </div>
      <div class="form-group">
        <label for="lName">Last Name</label>
        <input
          type="text"
          v-model="form.last_name"
          :class="{ 'is-invalid': form.errors.has('last_name') }"
          class="form-control"
          id="lName"
          aria-describedby="lName"
          placeholder="Enter Last Name"
        />
        <div
          class="invalid-feedback"
          v-text="form.errors.get('last_name')"
        ></div>
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
      <div class="form-group">
        <label for="confirmPassword">Confirm Password</label>
        <input
          type="password"
          v-model="form.password_confirmation"
          class="form-control"
          id="confirmPassword"
          placeholder="Password"
        />
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
import Form from "../tools/forms";

export default {
  name: "Register",
  data() {
    return {
      form: new Form({
        email: "",
        first_name: "",
        last_name: "",
        password: "",
        password_confirmation: "",
      }),
    };
  },
  methods: {
    submitForm() {
      this.form
        .post("/api/user/register")
        .then((response) => {
          this.$root.$emit("toggleLogin", true);
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
