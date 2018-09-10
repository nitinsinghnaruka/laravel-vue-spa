<template>
  <div>
    <!-- Header -->
    <div v-if="$store.state.auth.isUserLoggedIn">
      <nav class="navbar navbar-expand-lg navbar-light no-bg">
        <div class="container">
          <!--
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <div class="collapse navbar-collapse p-0" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-lg-0">
            </ul>
          </div>
          -->
          
          <div class="dropdown user-options ml-auto ">
            <button class="dropdown-toggle btn btn-light no-bg p-2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span>{{ $store.state.auth.user.name }}</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right mt-1" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="#" @click.prevent="logout()"><span class="ti-power-off"></span> Logout</a>
            </div>
          </div>
        </div>
      </nav>
    </div>

    <!-- Content-->
    <div class="container">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
export default {
  created: function () {
    // Listen to unauthorized event.
    Event.$on('unauthorized', () => {
      this.unauthorized();
    });
  },
  computed: {
    /**
     * Show navbar when page is not login, register and user is logged in.
     */
    showNavbar() {
      return (
        this.$route.path != '/login' && 
        this.$route.path != '/register' && 
        this.$store.state.auth.isUserLoggedIn
      );
    }
  },
  methods: {
    /**
     * Logout.
     */
    logout: function () {
      axios.post('logout')
        .then((response) => {
          let data = response.data;

          // If user logged out then emit logout user event.
          if (data.status == true) {
            // Clear Auth.
            Auth.clear();
            
            // Commit user loggout mutation.
            store.commit('logoutUser');
            
            // Redirect user to login.
            this.$router.push('/login');
            
            // Show message.
            this.$showMessage('success', data.message);
          }
        })
        .catch((error) => {
          //
        });
    },

    /**
     * Unauthorized.
     */
    unauthorized: function () {
      // Clear Auth.
      Auth.clear();

      // Commit user loggout mutation.
      store.commit('logoutUser');

      // Redirect user to login.
      this.$router.push('/login');

      // Show message.
      this.$showMessage('error', 'Unauthorized.');
    }
  }
}
</script>
