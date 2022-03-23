<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <center>
            <h2>Parcels To Be Delivered</h2>
          </center>

          <table class="table table-striped table-dark">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Width</th>
                <th scope="col">Height</th>
                <th scope="col">Weight</th>
                <th scope="col">Pick Up</th>
                <th scope="col">Drop Off</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(parcel, index) in parcels" :key="index">
                <th scope="row">{{ parcel.id }}</th>
                <td>{{ parcel.width }} cm</td>
                <td>{{ parcel.height }} cm</td>
                <td>{{ parcel.weight }} kg</td>
                <td>{{ parcel.pick_up ? parcel.pick_up : "N/A" }}</td>
                <td>{{ parcel.drop_off ? parcel.drop_off : "N/A" }}</td>
                <td style="color: green" v-if="parcel.status == 'delivered'">
                  {{ parcel.status }}
                </td>
                <td v-else>{{ parcel.status }}</td>
                <td v-if="parcel.status != 'delivered'">
                  <Link :href="'/biker/parcel/edit/' + parcel.id">Edit</Link>
                </td>
              </tr>
            </tbody>
          </table>

          <button @click="logout">Logout</button>
        </div>
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
    parcels: Object,
  },
  data() {
    return {};
  },
  methods: {
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

