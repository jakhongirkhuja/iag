<template>
  <div class="main__center fx-1">
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
      <div class="main__table__header__items">
        <input
          type="text"
          v-model="input_search"
          @keydown="myChangeFunction(1)"
          v-bind:class="{ active: search_active }"
          v-if="this.search_text"
          placeholder="Продается квартира на ..."
        />
        <input
          type="text"
          v-model="input_phone"
          @keydown="myChangeFunction(2)"
          v-bind:class="{ active: search_active }"
          v-if="this.search_phone"
          placeholder="+998 (99) 999-99-99"
        />
        <input
          type="text"
          @keydown="myChangeFunction(3)"
          v-model="input_url"
          v-bind:class="{ active: search_active }"
          v-if="this.search_url"
          placeholder="https://www..../obyavlenie/prodaet..."
        />
        <div class="showme" v-if="input_typing && (input_search.length != 0 || input_phone.length != 0 || input_url.length != 0)">
          <div class="main__table-results" 
        @focusout="handleFocusOut"
        tabindex="0" v-if="search_results.length==0">
            <div
              class="main__table-results-loading"
              v-for="index in 5"
              :key="index"
            >
              <h4></h4>
              <p></p>
            </div>
          </div>
        </div>

        <div class="main__table-results" 
        @focusout="handleFocusOut"
        tabindex="0" v-if="search_results.length!=0">
          <div class="result 3" @click="openwithslug(result.id, result.slug)" v-for="result in search_results" :key="result.id">
            <p v-html="result.title"></p>
            <p v-html='result.body.length>100 ? "..."+result.body.substring(0,100)+"..." : result.body+"..."'></p>
          </div>
        </div>
      </div>
      <div title="Поиск по текст" class="main__table__header__items">
        <div class="main__table__header__items__selection-items i_img">
          <img @click="showSearchInput" :src="this.btn_search" width="25" />
        </div>
      </div>
      <div title="Поиск по номеру" class="main__table__header__items">
        <div class="main__table__header__items__selection-items i_img">
          <img @click="showPhoneInput" :src="this.btn_phone" width="25" />
        </div>
      </div>
      <div title="Поиск по ссылке" class="main__table__header__items">
        <div class="main__table__header__items__selection-items i_img">
          <img @click="showUrlInput" :src="this.btn_url" width="25" />
        </div>
      </div>
    </div>
    <div class="main__table__body" >
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
            <th scope="col">Номер</th>
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
              <span><br><img v-if="estate.price_change==1" src="img/graph_b.svg"  width="18"><img v-else-if="estate.price_change==-1"   src="img/graph_r.svg" width="18"> </span>
            </td>
            <td  v-on:click="openEstate(estate.slug)">
              <span>{{ new Intl.NumberFormat().format(parseInt(estate.price/estate.total_area))}} {{ estate.currency }}</span> 
              <br><span class="under_price">{{ new Intl.NumberFormat().format(parseInt(estate.cur_alter/estate.total_area)) }} 
              <span v-if="estate.currency=='у.е'">сум</span>
              <span v-else>у.е</span>
              </span>
            </td>
            <td  v-on:click="openEstate(estate.slug)">{{ estate.remont }}</td>
            <td style="text-decoration:underline" :id="estate.id">
              <span v-if="number.length==0" @click="getNumber($event, estate.id,estate.created_at)">показать номер</span>
              <a style="padding:0 0.5rem; color:inherit" v-for="num in number" :key="num.id" v-bind:href="'tel:'+num">{{num}}</a>  
            </td>
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
      btn_search: this.$api_url + "/img/search.svg",
      btn_phone: this.$api_url + "/img/phone.svg",
      btn_url: this.$api_url + "/img/url.svg",
      search_phone: true,
      search_text: true,
      search_url: true,
      search_active: false,
      search_results: [],
      myVar: null,
      input_typing: false,
      show_date: [
        {
          id: 1,
          days: "за 7 дней",
          selected: true,
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
          days: "за Ме́сяц",
          selected: false,
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
      p: new Date().getDate()+new Date().getMonth()+1,
      s: new Date().getDate()*(new Date().getMonth()+1),
      y: new Date().getFullYear(),
      m: null,
      number: [],
    };
  },
  mounted() {},
  created() {
    this.m = this.p*this.s*this.y;
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
    po(d){
            return parseInt(d*this.m);
        },
        o(t){
            return parseInt(t.match(/\d/g).join("")); 
        },
        h(h){
            return window.btoa(h);
        },
    getNumber(event,id, t){
            // console.log(event.target.parentElement.innerHTML = 'ok');
            //  let sd = window.btoa(t);
            let sd =  this.po(id)+this.o(t);
            const article = { id: id, t: this.h(sd)};
            axios.post(this.$api_url + "/api/getnumberEstate", article)
            .then((response) => {
                if(response.data.status){
                  let numbers = response.data.number;
                  let st = ''
                  numbers.forEach(element => {
                    st = st +'<a href="tel:'+element+'">'+element+'</a>';
                  });
                  event.target.parentElement.innerHTML = st;
                // this.number =response.data.number; 
                
                }else{
                console.log(response.data.error);
                }
                
            })
            .catch(error => {
                console.error("There was an error!", error);
            });
            this.showmodal = true;
        
        },
        handleFocusOut() {
            this.input_typing = false;
            this.search_results = [];
            console.log('here it is ')
        },
    latest(id) {
      let currentid = this.show_date.find((item) => item.selected === true).id;
      let currentid2 = this.order_items.find((item) => item.selected === true)
        .id;
      if (currentid != id) {
        for (let key in this.show_date) {
          this.show_date[key].selected = false;
        }
        this.show_date.find((item) => item.id === id).selected = true;
        this.$parent.changeLatest(id, currentid2);
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
    showSearchInput() {
      this.search_text = true;
      this.search_phone = false;
      this.search_url = false;
      this.search_active = true;
      
    },
    showPhoneInput() {
      this.search_text = false;
      this.search_phone = true;
      this.search_active = true;
      this.search_url = false;
    },
    showUrlInput() {
      this.search_text = false;
      this.search_phone = false;
      this.search_url = true;
      this.search_active = true;
    },
    changepagination(url) {
      this.$parent.changePagination(url);
       
    },
    submitHeaderFilterInside(search, item){
      
      axios
        .get(this.$api_url + "/api/remont/generalFilter?search="+search+"&item="+item)
        .then((response) => {
          if (response.data.status) {
            if(response.data.estate!=0){

            
              var i =  0;
              let estates = response.data.estate;
              let _this  =this;
              
              for (i; i<estates.length; i++) {
                var title = '';
                var title_change = '';
                var title_index = 0;
                var title_take = '';
                let body ='';
                var body_index = 0;
                var body_take = '';
                var body_change = '';
                
                if(item==1 || item==3){
                    
                    title = estates[i].title.toLowerCase();
                    title_change = title.replace(search.toLowerCase(), '<b>'+search.toLowerCase()+'</b>' );
                    if(item==1){
                      body = estates[i].body.replace(/<(.|\n)*?>/g, '').toLowerCase();
                      body_index = body.indexOf(search.toLowerCase());
                      body_take = body.slice(body_index);
                      body_change = body_take.replace(search.toLowerCase(), '<b>'+search.toLowerCase()+'</b>' );
                    
                      
                    }else{
                      body_change =  estates[i].url
                    }
                }else{
                  
                    title_change = estates[i].name;
                    
                    body = estates[i].number.replace(/<(.|\n)*?>/g, '').toLowerCase();
                    body_index = body.indexOf(search.toLowerCase());
                    body_take = body.slice(body_index);
                    body_change = body_take.replace(search.toLowerCase(), '<b>'+search.toLowerCase()+'</b>' );
                }
                
                
                
                _this.search_results.push({
                  id: estates[i].id,
                  title : title_change,
                  body : body_change,
                  body_itself :  body,
                  slug: estates[i].slug
                })
                
              }
            }else{
              this.input_typing = false;
              
            }
             
          }
        })
        .catch((error) => {
          this.input_typing = false;
          console.log(error);
        });
    },
    myChangeFunction(number) {  
       let _this = this
      this.input_typing = true;
      this.search_results = [];
      clearTimeout(this.myVar);
      if(number==1){
        
          if (this.input_search.length != 0) {
           
            this.myVar = setTimeout(() => {
            
            _this.submitHeaderFilterInside(this.input_search, number);
           
            }, 2000);
        }
      }
      if(number==2){
          if (this.input_phone.length != 0) {
            this.myVar = setTimeout(() => {
            _this.submitHeaderFilterInside(this.input_phone, number);
            }, 2000);
        }
      }
        if(number==3){
          if (this.input_url.length != 0) {
            this.myVar = setTimeout(() => {
            _this.submitHeaderFilterInside(this.input_url, number);
            }, 2000);
        }
      }
      
    },
    openEstate(slug) {
      // console.log(show_date)
      // console.log(slug);
      let routeData = this.$router.resolve({ name: 'estate', params: { slug: slug } });
      window.open(routeData.href, '_blank');
      // let routeData = this.$router.push({
      //   name: "estate",
      //   params: { slug: slug },
      // });
    },
    openwithslug(id,slug){
      
      if(slug==undefined){
            this.$router.push({ name: "OwnersEach", params: {id:id} });
      }else{
          let routeData = this.$router.push({
            name: "estate",
            params: { slug: slug },
          });
      }
      
    }
  },
};
</script>