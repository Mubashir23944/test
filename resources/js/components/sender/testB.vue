<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
            <center>
                <h2>B Login Form</h2>
            </center>

          <form class="modal-content animate"
                method="post">

            <div class="container">
              <label for="email"><b>Email</b></label>
              <input
                type="text"
                v-model="email"
                placeholder="Enter Sender Email"
                name="email"
                required
              />

              <label for="password"><b>Password</b></label>
              <input
                v-model="password"
                type="password"
                placeholder="Enter Password"
                name="password"
                required
              />

              <a @click="submit">Login</a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
    data(){
        return{
            email: '',
            password: '',
        }

    },
    methods: {
        submit() {
            axios.post('/api/auth/login', {
                email: this.email,
                password: this.password,
            }).then(response => {
                if(response.data.access_token){
                    red
                }
                console.log(response.data.access_token)
            }).catch(error => {
                    console.log('error found')

            })
        }
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
