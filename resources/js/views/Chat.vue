<template>
  <div>
    <div class="row justify-content-center mt-5">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header bg-white border-0 shadow">Messages</div>
          <div class="card-body">
            <ul class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;" v-if="! $isEmpty(messages)">
              <li class="list-group-item" v-for="(message, index) in messages" :key="index">
                  <div class="font-weight-bold text-muted">{{ message.user.name }}</div>
                  <div>{{ message.body }}</div>
              </li>
            </ul>
            <div v-else class="text-center">No messages</div>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center mt-5">
      <div class="col-md-8">
        <div class="card">
          <vue-topprogress ref="topProgress" color="#2d995b" colorShadow="none"></vue-topprogress>
          <div class="card-body">
            <form @submit.prevent="sendMessage()" @keypress="form.errors.clear()">
              <div class="form-group">
                <label for="exampleInputEmail1">{{ $store.state.auth.user.name }} -</label> 
                <textarea class="form-control" id="message" name="message" rows="3" placeholder="Enter message..." v-model="form.message"></textarea>
                <small class="form-text text-danger" v-if="form.errors.has('message')">{{ form.errors.get('message') }}</small>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-warning" :disabled="loading">Send</button>
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
        message: ''  
      }),
      messages: [],
      loading: false
    }
  },
  created() {
    // Listen.   
    this.listen();
  },
  methods: {
    /**
     * Send message.
     */
    sendMessage: function () {
      // Show top progress.
      this.$refs.topProgress.start();

      // Disable submit button.
      this.loading = true;

      this.form.post('messages')
        .then((response) => {
          let data = response.data;
          
          if (data.status == true) {
            // Show message in messages.
            this.messages.push({
              body: data.body,
              user: {
                name: store.state.auth.user.name
              }
            })

            // Show message.
            this.$showMessage('success', data.message);
          } else {
            // Show message.
            this.$showMessage('error', data.message);
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
    },
    /**
     * Listen.
     */
    listen: function () {
      Echo.private('message')
        .listen('NewMessage', (message) => {
          this.messages.push(message);  
        });
    }
  }
}
</script>
