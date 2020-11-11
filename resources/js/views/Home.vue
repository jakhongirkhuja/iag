<template>
  <div class="main fx">
    <Filter_s />
    <TableShow
      v-bind:estates="estates"
      v-bind:count_all="count_all"
      v-bind:next_page="next_page"
      v-bind:prev_page="prev_page"
      v-bind:cur_page="cur_page"
      v-bind:last_page="last_page"
      v-bind:empty_estate="empty_estate"
    />
    <RigtSideBar />
  </div>
</template>
<script>
import Filter_s from "../layouts/Filter_s";
import TableShow from "../views/TableShow";
import RigtSideBar from "../layouts/RigtSideBar";
export default {
  name: "home",
  components: {
    Filter_s,
    RigtSideBar,
    TableShow,
  },
  data: function () {
    return {
      estates: [],
      url: "api/show/estate",
      pagination: [],
      latest: 1,
      itemsOrder: 1,
      cur_page: 1,
      next_page: null,
      prev_page: null,
      count_all: 0,
      last_page: 1,
      empty_estate: false,
    };
  },
  mounted() {
    //  [App.vue specific] When App.vue is finish loading finish the progress bar
  },
  created() {
    this.getEstates();
  },
  methods: {
    changeRouterULR() {
      var query = JSON.parse(JSON.stringify(this.$route.query));

      query.latest = this.latest;
      query.itemsorder = this.itemsOrder;

      return query;
    },
    changeRouterULRPagination() {
      var query = JSON.parse(JSON.stringify(this.$route.query));

      query.page = this.cur_page;

      return query;
    },
    changeLatest(id, id2) {
      this.latest = id;
      this.itemsOrder = id2;
      let que = this.changeRouterULR();

      this.$router
        .replace({
          path: "/",
          query: que,
        })
        .catch((err) => {});
      this.getEstates();
    },
    changeItemsOrder(id, id2) {
      this.latest = id2;
      this.itemsOrder = id;
      let que = this.changeRouterULR();
      this.$router
        .replace({
          path: "/",
          query: que,
        })
        .catch((err) => {});
      this.getEstates();
    },
    changePagination(page) {
      this.cur_page = page;
      let que = this.changeRouterULRPagination();
      this.$router
        .replace({
          path: "/",
          query: que,
        })
        .catch((err) => {});
      this.getEstates();
    },
    getEstates() {
      this.estates = [];
      this.$Progress.start();
      // const { query }  = this.$route;
      axios
        .get(this.$api_url + "/" + this.url + "/" + this.$route.fullPath)
        .then((response) => {
          if (response.data.status) {
            if (response.data.estate.data.length != 0) {
              this.count_all = response.data.estate.total;
              this.cur_page = response.data.estate.current_page;

              let next_page_get = response.data.estate.next_page_url;
              if (next_page_get != null) {
                this.next_page = next_page_get.split("?")[1].split("=")[1];
              }

              let prev_page_get = response.data.estate.prev_page_url;
              if (prev_page_get != null) {
                this.prev_page = prev_page_get.split("?")[1].split("=")[1];
              }
              this.last_page = response.data.estate.last_page;
              this.estates = response.data.estate.data;
              this.empty_estate = false;
            } else {
              this.count_all = 0;
              this.estates = [];
              this.empty_estate = true;
              this.cur_page = 1;
              this.next_page = null;
              this.prev_page = null;
              this.count_all = 0;
              this.last_page = 1;
            }

            this.$Progress.finish();
            window.scrollTo(0, 0);
          }
        })
        .catch((error) => {
          console.log(error);
          this.empty_estate = true;
        });
    },

    filterAllEstates(
      type,
      house_type,
      room,
      area_from,
      area_to,
      currency,
      price_sum_from,
      price_sum_to,
      price_sum_y_from,
      price_sum_y_to,
      floor,
      remont_id,
      selected_city
    ) {
      this.$router.replace({
        path: "/",
        query: {
          type: type,
          latest: this.latest,
          itemsorder: this.itemsOrder,
          house_type: house_type,
          room: room,
          currency: currency,
          price_sum_from: price_sum_from,
          price_sum_to: price_sum_to,
          price_sum_y_from: price_sum_y_from,
          price_sum_y_to: price_sum_y_to,
          area_from: area_from,
          area_to: area_to,
          floor: floor,
          remont_id: remont_id,
          selected_city: selected_city,
          page: this.cur_page,
        },
      });
      this.getEstates();
    },
  },
};
</script>