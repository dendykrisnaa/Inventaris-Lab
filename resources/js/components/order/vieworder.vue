  

<template>
  <div>
    <div class="row">
      <router-link to="/order" class="btn btn-primary">Go Back </router-link>
    </div>

    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Detail Penyimpanan</h1>
                  </div>

                  <div class="row">
                    <div class="col-lg-12 mb-4">
                      <!-- Simple Tables -->
                      <div class="card">
                        <div
                          class="
                            card-header
                            py-3
                            d-flex
                            flex-row
                            align-items-center
                            justify-content-between
                          "
                        >
                          <h6 class="m-0 font-weight-bold text-primary">
                            Details Pinjaman
                          </h6>
                        </div>
                        <div class="table-responsive">
                          <ul class="list-group">
                            <li class="list-group-item">
                              <b>Nama Koordinator:</b> {{ orders.name }}
                            </li>
                            <li class="list-group-item">
                              <b>Phone :</b> {{ orders.phone }}
                            </li>
                            <li class="list-group-item">
                              <b>Address :</b> {{ orders.address }}
                            </li>
                            <li class="list-group-item">
                              <b>Tanggal Pinjam :</b>
                              {{ orders.tanggal_pinjam }}
                            </li>
                            <li class="list-group-item">
                              <b>Tanggal Kembali :</b>
                              {{ orders.tanggal_kembali }}
                            </li>
                          </ul>
                        </div>
                        <div class="card-footer"></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-12 mb-4">
                      <!-- Simple Tables -->
                      <div class="card">
                        <div
                          class="
                            card-header
                            py-3
                            d-flex
                            flex-row
                            align-items-center
                            justify-content-between
                          "
                        >
                          <h6 class="m-0 font-weight-bold text-primary">
                            Detail Alat
                          </h6>
                        </div>
                        <div class="table-responsive">
                          <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                              <tr>
                                <th>Nama Alat</th>
                                <th>Keterangan</th>
                                <th>Gambar</th>
                                <th>Jumlah</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr v-for="detail in details">
                                <td>{{ detail.product_name }}</td>
                                <td>{{ detail.keterangan }}</td>
                                <td>
                                  <img
                                    :src="'/' + detail.image"
                                    id="em_photo"
                                  />
                                </td>
                                <td>{{ detail.pro_quantity }}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="card-footer"></div>
                      </div>
                    </div>
                  </div>

                  <hr />
                  <div class="text-center"></div>
                  <div class="text-center"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>



<script type="text/javascript">
export default {
  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: "/" });
    }
  },

  data() {
    return {
      errors: {},
      orders: {},
      details: {},
    };
  },
  created() {
    let id = this.$route.params.id;
    axios
      .get("/api/order/details/" + id)
      .then(({ data }) => (this.orders = data))
      .catch(console.log("error"));

    axios
      .get("/api/order/orderdetails/" + id)
      .then(({ data }) => (this.details = data))
      .catch(console.log("error"));
  },

  methods: {},
};
</script>


<style type="text/css">
#em_photo {
  height: 40px;
  width: 40px;
}
</style>