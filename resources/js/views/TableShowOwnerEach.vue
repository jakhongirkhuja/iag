<template>
  <div class="main__center fx-1">
    <div class="to_whom">
      Все объявления пользователя:
    </div>
    <div class="main__table__header fx vertical_center">
      <div class="main__table__header__items">{{ count_all }} найдено</div>
      <div class="main__table__header__items">
        <div class="main__table__header__items__selection">
          <div class="main__table__header__items__selection-items">
            <div
              @click="latest(date.id)"
              v-for="date in show_date"
              :key="date.id"
              v-bind:class="{ active: date.selected }"
            >
              {{ date.days }}
            </div>
          </div>
        </div>
      </div>
      <div class="main__table__header__items">
        <div class="main__table__header__items__selection">
          <div class="main__table__header__items__selection-items">
            <div
              @click="orderItems(orders.id)"
              v-for="orders in order_items"
              :key="orders.id"
              :class="{ active: orders.selected }"
            >
              {{ orders.order }}
            </div>
          </div>
        </div>
      </div>
      
      
    </div>
    <div class="main__table__body">
      <table class="table table-hover" style="width: 100%">
        <thead>
          <tr >
            <th scope="col">#</th>
            <th scope="col" style="text-align: left; padding-left: 1rem">
              Район
            </th>
            <th scope="col">Комнат</th>
            <th scope="col">Площадь</th>
           
            <th scope="col">Цена</th>
            <th scope="col">Цена за м<sup>2</sup></th>
            <th scope="col">Состояние</th>
           
            <th scope="col">Обновлено</th>
          </tr>
        </thead>
        <tbody class="loading" v-if="estates.length == 0 && !empty_estate">
          <tr v-for="index in 50" :key="index">
            <td style="width: 25px"></td>

            <td style="width: 450px" class=""></td>
            <td style="width: 85px" class=""></td>
            <td style="width: 109px" class=""></td>
            <td style="width: 61px" class=""></td>
            <td style="width: 125px" class=""></td>
            <td style="width: 200px" class=""></td>
            <td style="width: 168px" class=""></td>
          </tr>
        </tbody>
        <div v-if="empty_estate" style="font-weight: bold; text-align: center; margin-top: 15px">
          
            No Items found

            
          
        </div>
        <tbody v-else style="text-align: center">
        
          <tr
            v-for="estate in estates"
            :key="estate.id"
          
          >
            
            <td>{{ estate.construction_year }}</td>
            <td   v-on:click="openEstate(estate.slug)" style="text-align: left; padding-left: 1rem">
              {{ estate.city }}, {{ estate.region }}
              <br><span v-if="estate.img!=0" style="font-size: 15px; display: flex; align-items: center;">
                <img src="/img/camera.svg" width="17" style="margin-right:0.2rem"> {{ estate.img }}</span>
            </td>
            <td  v-on:click="openEstate(estate.slug)">{{ estate.num_rooms }}/{{ estate.floor }}/{{ estate.floor_house }}</td>
            <td  v-on:click="openEstate(estate.slug)">Об: {{ estate.total_area }} m <sup>2</sup>
                <span v-if="estate.living_space"> <br>Жл: {{ estate.living_space }} m<sup>2</sup></span>
                <span v-if="estate.kitchen_area"> <br>Кх: {{ estate.kitchen_area }} m<sup>2</sup></span>
            </td>
            
            <td  v-on:click="openEstate(estate.slug)">
              <span>{{ new Intl.NumberFormat().format(estate.price)}} {{ estate.currency }}</span> 
              <br><span class="under_price">{{ new Intl.NumberFormat().format(estate.cur_alter) }} 
              <span v-if="estate.currency=='у.е'">сум</span>
              <span v-else>у.е</span>
              </span>
              <span><br><img v-if="estate.price_change==1" src="/img/graph_b.svg"  width="18"><img v-else-if="estate.price_change==-1"   src="/img/graph_r.svg" width="18"> </span>
            </td>
            <td  v-on:click="openEstate(estate.slug)">
              <span>{{ new Intl.NumberFormat().format(parseInt(estate.price/estate.total_area))}} {{ estate.currency }}</span> 
              <br><span class="under_price">{{ new Intl.NumberFormat().format(parseInt(estate.cur_alter/estate.total_area)) }} 
              <span v-if="estate.currency=='у.е'">сум</span>
              <span v-else>у.е</span>
              </span>
            </td>
            <td  v-on:click="openEstate(estate.slug)">{{ estate.remont }}</td>
            
            <td  v-on:click="openEstate(estate.slug)"><span v-html="estate.update_time"></span></td>
          </tr>
        </tbody>
      </table>
      <div class="pagination">
        <div
          class="pagination__prev"
          v-if="cur_page != 1"
          @click="changepagination(1)"
        >
          &#8249;&#8249;
        </div>
        <div
          class="pagination__prev"
          v-if="prev_page != null"
          @click="changepagination(prev_page)"
        >
          &#8249;
        </div>
        <div class="pagination__curr" v-if="next_page!=1">{{ cur_page }}</div>
        <div
          class="pagination__next"
          v-if="next_page != null && next_page!=1"
          @click="changepagination(next_page)"
        >
          &#8250;
        </div>
        <div
          class="pagination__next"
          v-if="last_page != 1"
          @click="changepagination(last_page)"
        >
          &#8250;&#8250;
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "tableshow",
  props: [
    "estates",
    "pagination",
    "count_all",
    "next_page",
    "prev_page",
    "cur_page",
    "last_page",
    "empty_estate",
  ],
  data: function () {
    return {
      input_search: "",
      input_phone: "",
      input_url: "",
      price_filter: 0,
      room_filter: 0,
      myVar: null,
      input_typing: false,
      show_date: [
        {
          id: 1,
          days: "за 7 дней",
          selected: false,
        },
        {
          id: 2,
          days: "за 14 дней",
          selected: false,
        },
        {
          id: 3,
          days: "за 25 дней",
          selected: false,
        },
        {
          id: 4,
          days: "всего",
          selected: true,
        },
      ],
      order_items: [
        {
          id: 1,
          order: "сначала новые",
          selected: true,
        },
        {
          id: 2,
          order: "сначала старые",
          selected: false,
        },
      ],
    };
  },
  mounted() {},
  created() {
    const { query } = this.$route;
    if (query.latest) {
      for (let key in this.show_date) {
        this.show_date[key].selected = false;
      }
      this.show_date.find(
        (item) => item.id === parseInt(query.latest)
      ).selected = true;
    }
    if (query.itemsorder) {
      for (let key in this.order_items) {
        this.order_items[key].selected = false;
      }
      this.order_items.find(
        (item) => item.id === parseInt(query.itemsorder)
      ).selected = true;
    }
  },
  methods: {
    
      
    latest(id) {
      let currentid = this.show_date.find((item) => item.selected === true).id;
      let currentid2 = this.order_items.find((item) => item.selected === true)
        .id;
      if (currentid != id) {
        for (let key in this.show_date) {
          this.show_date[key].selected = false;
        }
        this.show_date.find((item) => item.id === id).selected = true;
        // this.$parent.changeLatest(id, currentid2);
      }
    },
    orderItems(id) {
      let currentid2 = this.show_date.find((item) => item.selected === true).id;
      let currentid = this.order_items.find((item) => item.selected === true)
        .id;
      if (currentid != id) {
        for (let key in this.order_items) {
          this.order_items[key].selected = false;
        }
        this.order_items.find((item) => item.id === id).selected = true;
        this.$parent.changeItemsOrder(id, currentid2);
        
      }
    },
    
    changepagination(url) {
      this.$parent.changePagination(url);
       
    },
   
    openEstate(slug) {
      // console.log(show_date)
      // console.log(slug);
      // let routeData = this.$router.resolve({ name: 'estate', params: { slug: slug } });
      // window.open(routeData.href, '_blank');
      let routeData = this.$router.push({
        name: "estate",
        params: { slug: slug },
      });
    },
    openwithslug(slug){
      let routeData = this.$router.push({
        name: "estate",
        params: { slug: slug },
      });
    }
  },
};
</script>
<style lang="scss" scoped>
  .to_whom{
    padding-left: 2rem;
    font-weight: bolder;
    padding-bottom: 1rem;
    
  }
  
</style>