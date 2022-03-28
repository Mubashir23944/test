<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
            <center>
                <h2>Sender Login Form</h2>
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

              <a class="btn btn-success" @click="submit">Login</a>
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
                if(response.data.token){

                    // Storing Data in Local Storage
                    localStorage.setItem('token', response.data.token);
                    localStorage.setItem('user_id', response.data.user.id);
                    localStorage.setItem('role_id', response.data.user.role_id);

                    // Redirect Conditions
                    if(response.data.user.role_id == 1){

                        this.$inertia.visit('sender/parcels/'+response.data.user.id)
                    }
                    else if(response.data.user.role_id == 2){
                        this.$inertia.visit('biker/parcels/'+response.data.user.id)

                    }
                }
            }).catch(response => {
                    console.log('error found')

            })
        }
  },
};
</script>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

</style>
