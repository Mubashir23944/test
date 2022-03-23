<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <center>
            <h2>Edit Parcel Status</h2>
          </center>
          <form class="modal-content animate" method="post">
            <div class="container">
              <label for="pick_up"><b>Parcel Status</b></label>
              <select v-model="status" id="inputState" class="form-control">
                <option value="way">On the Way</option>
                <option value="delivered">Delivered</option>
              </select>

              <a class="btn btn-success" @click="submit">Change Status</a>
            </div>
          </form>
        </div>
        <button @click="logout">Logout</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { Link } from "@inertiajs/inertia-vue3";
export default {
  components: { Link },
  props: {
    parcel: Object,
  },
  data() {
    return {
      status: this.parcel.status,
    };
  },
  methods: {
    submit() {
      axios
        .post("/api/auth/biker/parcel/edit", {
          status: this.status,
          parcel_id: this.parcel.id,
          token: localStorage.getItem("token"),
        })
        .then((response) => {
          console.log(response);
          this.$inertia.visit(
            "/biker/parcels/" + localStorage.getItem("user_id")
          );
        })
        .catch((response) => {
          console.log("error found");
        });
    },
    logout() {
      axios
        .post("/api/auth/logout", {
          token: localStorage.getItem("token"),
        })
        .then((response) => {
          console.log(response);
          localStorage.removeItem("token");
          this.$inertia.visit("/login");
        })
        .catch((response) => {
          console.log("error found");
        });
    },
  },
  mounted() {
    if (!localStorage.getItem("token")) {
      this.$inertia.visit("/login");
    }
  },
};
</script>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Full-width input fields */
input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #04aa6d;
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


