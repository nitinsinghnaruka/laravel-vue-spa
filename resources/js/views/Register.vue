<template>
  <div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="card pt-5 shadow-sm">
            <vue-topprogress ref="topProgress" color="#2d995b" colorShadow="none"></vue-topprogress>
            <div class="card-body">
              <form @submit.prevent="register()" @keypress="form.errors.clear()">
                <div class="form-group">
                  <input type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Name" v-model="form.name">
                  <small class="form-text text-danger" v-if="form.errors.has('name')">{{ form.errors.get('name') }}</small>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" v-model="form.email">
                  <small class="form-text text-danger" v-if="form.errors.has('email')">{{ form.errors.get('email') }}</small>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="password" placeholder="Password" v-model="form.password">
                  <small class="form-text text-danger" v-if="form.errors.has('password')">{{ form.errors.get('password') }}</small>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password" v-model="form.password_confirmation">
                  <small class="form-text text-danger" v-if="form.errors.has('password_confirmation')">{{ form.errors.get('password_confirmation') }}</small>
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-warning shadow-sm" :disabled="loading">Register</button>
                </div>
                <div class="text-center text-sm">
                  or
                  <br/>
                  <router-link to="login" class="text-secondary">Login</router-link>
                </div>
              </form>
            </div>
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
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }),
      loading: false
    }
  },
  methods: {
    /**
     * Register.
     */
    register: function () {
      // Show top progress.
      this.$refs.topProgress.start();

      // Disable submit button.
      this.loading = true;

      this.form.post('register')
        .then((response) => {
          let data = response.data;

          // Set user data.
          if (data.status == true) {
            // Store auth data.
            Auth.store(data.token, data.user);

            // Store login user state.
            store.commit('loginUser');

            // Redirect to home.
            this.$router.push('/');

            // Show message.
            this.$showMessage('success', data.message);
          }

          // Hide top progess.
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
