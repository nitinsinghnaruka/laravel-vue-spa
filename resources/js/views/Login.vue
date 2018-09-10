<template>
  <div>
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card pt-5 shadow-sm">
          <vue-topprogress ref="topProgress" color="#2d995b" colorShadow="none"></vue-topprogress>
          <div class="card-body">
            <form @submit.prevent="login()" @keypress="form.errors.clear()">
              <div class="form-group">
                <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" v-model="form.email">
                <small class="form-text text-danger" v-if="form.errors.has('email')">{{ form.errors.get('email') }}</small>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="password" placeholder="Password" v-model="form.password">
                <small class="form-text text-danger" v-if="form.errors.has('password')">{{ form.errors.get('password') }}</small>
              </div>
              <div class="text-center text-sm">
                <small class="form-text text-danger" v-if="errorMessage">{{ errorMessage }}</small>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-success shadow-sm" :disabled="loading">Login</button>
              </div>
              <div class="text-center text-sm">
                or
                <br/>
                <router-link to="register" class="text-secondary">Register</router-link>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        email: '',
        password: ''
      }),
      errorMessage: null,
      loading: false
    }
  },
  methods: {
    /**
     * Login.
     */
    login: function () {
      this.errorMessage = null;

      // Show top progress.
      this.$refs.topProgress.start();

      // Disable submit button.
      this.loading = true;

      this.form.post('login')
        .then((response) => {
          let data = response.data;

          if (data.status == true) {
            // Store auth data.
            Auth.store(data.token, data.user);

            // Store login user state.
            store.commit('loginUser');

            // Redirect to home.
            this.$router.push('/');

            // Show message.
            this.$showMessage('success', data.message);
          } else {
            // Show error message.
            this.errorMessage = data.message;
            
            // Reset form email. 
            this.form.email = data.email;
          }

          // Hide top progress.
          this.$refs.topProgress.done();

          // Enable submit button.
          this.loading = false;
        })
        .catch((error) => {
          // Show fail top progress.
          this.$refs.topProgress.fail();

          // Enable submit button.
          this.loading = false;
        });
    }
  }
}
</script>
