   <template>
  <div>
    <br />
    <input
      type="text"
      v-model="searchTerm"
      class="form-control"
      style="width: 300px"
      placeholder="Search Here"
    />

    <br />

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
            <h6 class="m-0 font-weight-bold text-primary">Peminjaman</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Nama Koordinator</th>
                  <th>Nim</th>
                  <th>Kelas</th>
                  <th>Smester</th>
                  <th>praktikum</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="order in filtersearch" :key="order.id">
                  <td>{{ order.name }}</td>
                  <td>{{ order.nim }}</td>
                  <td>{{ order.kelas }}</td>
                  <td>{{ order.semester }}</td>
                  <td>{{ order.praktikum }}</td>

                  <td>
                    <router-link
                      :to="{ name: 'view-order', params: { id: order.id } }"
                      class="btn btn-sm btn-primary"
                      >View</router-link
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer"></div>
        </div>
      </div>
    </div>
    <!--Row-->
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
      pinjam_alats: [],
      searchTerm: "",
    };
  },
  computed: {
    filtersearch() {
      return this.pinjam_alats.filter((order) => {
        return order.name.match(this.searchTerm);
      });
    },
  },

  methods: {
    allOrder() {
      axios
        .get("/api/orders/")
        .then(({ data }) => (this.pinjam_alats = data))
        .catch();
    },
  },
  created() {
    this.allOrder();
  },
};
</script>


<style type="text/css">
#em_photo {
  height: 40px;
  width: 40px;
}
</style>