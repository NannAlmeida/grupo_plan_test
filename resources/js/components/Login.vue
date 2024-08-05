<template>
  <div id="app">
    <b-container class="d-flex justify-content-center align-items-center vh-100">
      <b-card class="text-center" style="max-width: 400px">
        <h3>Login</h3>
        <b-card-body>
          <b-alert :show="error" variant="danger" dismissible @dismissed="error = !error">
            {{ errorMessage }}
          </b-alert>
          <b-form @submit.prevent="onSubmit">
            <b-form-group label-for="email">
              <b-form-input
                id="email"
                type="email"
                v-model="form.email"
                required
                placeholder="Email"
                size="lg"
              >
              </b-form-input>
            </b-form-group>

            <b-form-group label-for="password">
              <b-form-input
                id="password"
                type="password"
                v-model="form.password"
                required
                placeholder="Senha"
                size="lg"
              >
              </b-form-input>
            </b-form-group>

            <b-button type="submit" variant="primary" size="lg"
              ><b-spinner v-if="loading" small type="border"></b-spinner>
              {{ loading ? "Entrando..." : "Login" }}</b-button
            >
          </b-form>
        </b-card-body>
      </b-card>
    </b-container>
  </div>
</template>

<script>
export default {
  name: "login",
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
      errorMessage: false,
      error: false,
      loading: false,
    };
  },
  methods: {
    async onSubmit() {
      this.loading = !this.loading;
      try {
        const response = await fetch("/api/login", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(this.form),
          credentials: "include",
        });

        if (response.ok) {
          const data = await response.json();
          localStorage.setItem("authToken", data.token);
          this.$router.push({ name: "dashboard" });
        } else {
          const data = await response.json();

          this.error = !this.error;
          this.errorMessage = data.message;
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>

<style scoped>
#app {
  width: 100vw;
  height: 100vh;
  background: #e9faff;
}
</style>
