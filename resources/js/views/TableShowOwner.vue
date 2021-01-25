<template>
  <div class="main__center fx-1">
    <div class="main__table__header fx vertical_center">
        
        <div class="main__table__header__items_">
            <div class="filter__items">
                <input type="radio"  v-model='types' v-on:change='clickType' value="0"  id="prodaja" />
                <label for="prodaja">Все</label>
            </div>
            
        </div>
        <div class="main__table__header__items_" v-for="type in ownerstype " :key="type.id" >
            <div class="filter__items">
                <input type="radio" v-on:change='clickType' v-model='types' v-bind:value="type.id"   v-bind:id="type.name" />
                <label v-bind:for="type.name">{{ type.name }}</label>
            </div>
            
        </div>
        <div class="main__table__header__items_ fx-1">
            <input class="form-control" v-model="input_typing" @input="searchevent" placeholder="Поиск по номеру или имени ">
            </div>
        <div class="main__table__header__items_" style="padding-right:0.3rem; font-size:0.9rem">
            <i>{{ count_all }}</i> пользователей
        </div>
       
         
        
      
    </div>
    <div class="main__table__body">
       
      <div class="main__table__owners">
          <div class="main__table__owners--items" v-for="owner in owners" :key="owner.id">
            <div class="main__table__owners--items_inside">
              <div class="main__table__owners--title" >
                  <div class="main__table__owners--name">
                      <span>{{ owner.name }}</span> - <i>{{ owner.types }}</i>
                  </div>
                  <div class="main__table__owners--counting">
                      <div class="main__table__owners--counting-items">
                          Продажа: {{ owner.count_all}} 
                      </div>
                      <div v-if="owner.newhouse_count!=0" class="main__table__owners--counting-items">
                          Новостройка: {{ owner.newhouse_count}} 
                      </div>
                      <div v-if="owner.oldhouse_count!=0" class="main__table__owners--counting-items">
                          Вторичный: {{ owner.oldhouse_count}} 
                      </div>
                     
                  </div>
              </div>
              <div class="main__table__owners--buttons">
                  
                  <div @click="getNumber(owner.name, owner.id,owner.update_at)"  class="main__table__owners--buttons_items">
                    <img src="img/phone2.svg" width="20"> Контакты
                  </div>
                  <div @click="showdetails(owner.id)" class="main__table__owners--buttons_items">
                    Подробнее
                  </div>
              </div>
            </div>
          </div>
      </div>

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
        <div class="pagination__curr" v-if="next_page != 1">{{ cur_page }}</div>
        <div
          class="pagination__next"
          v-if="next_page != null && next_page != 1"
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
    <div class="modal" v-if="showmodal">
       <div class="modal__content">
         <div class="modal__body">
           <div class="modal__close" @click='showmodal= !showmodal'>
             &#10005;
           </div>
           <div class="modal__name">
             {{ name }}
           </div>
            <div class="modal__numbers" v-if="number.length != 0">
                      <ul>
                        <li v-for="num in number" :key="num.id">
                          <a v-bind:href="'tel:'+num">{{ num }} <img src="img/phone2.svg" width="20"> </a>
                        </li>
                      </ul>
            </div>
            <div class="modal__numbers" v-else>
                      <ul>
                        <li><a href="#">у вас нет доступ к номеру</a></li>
                      </ul>
            </div>
         </div>
       </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "owners",
  props: [
    "owners",
    "pagination",
    "count_all",
    "next_page",
    "prev_page",
    "cur_page",
    "last_page",
    "empty_owners",
    "ownerstype",
  ],
  data: function () {
    return {
      input_search: "",
      input_phone: "",
      input_url: "",
      types: '0',
      search_phone: true,
      search_text: true,
      search_url: true,
      search_active: false,
      search_results: [],
      myVar: null,
      input_typing: '',
      myVar: null,
      td: null,
      p: new Date().getDate()+new Date().getMonth()+1,
      s: new Date().getDate()*(new Date().getMonth()+1),
      y: new Date().getFullYear(),
      m: null,
      number: [],
      name: '',
      showmodal: false,
    };
  },
  mounted() {},
  created() {
        this.m = this.p*this.s*this.y;
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
    getNumber(name,id, t){
      this.name = name;
      //  let sd = window.btoa(t);
       let sd =  this.po(id)+this.o(t);
       const article = { id: id, t: this.h(sd)};
        axios.post(this.$api_url + "/api/getnumber", article)
          .then((response) => {
             if(response.data.status){
               this.number =response.data.number; 
               
             }else{
               console.log(response.data.error);
             }
             
          })
          .catch(error => {
            console.error("There was an error!", error);
          });
          this.showmodal = true;
      
    },
    searchevent(){
      clearTimeout(this.myVar);
      this.myVar = setTimeout(() => {
        this.$parent.findsearch(this.input_typing)
       }, 2000);
      
    },
    clickType(){
      this.$parent.changetype(this.types);
    },
    changepagination(page){
      this.$parent.changepagination(page);
    },
    showdetails(id){
      this.$router.push({ name: "OwnersEach", params: {id:id} });
    }
  },
};
</script>
<style lang="scss" scoped>
    .filter__items input[type=radio] + label{
        display: inline-block;
        border: 1px solid whitesmoke;
        padding: 8px 15px;
        cursor: pointer;
    }
    .filter__items input[type=radio]{
        display: none;
    }
    .filter__items input[type=radio]:checked + label, .filter__items input[type=radio] + label:hover{
        border: 1px solid #ccc8c8;
    }
    .main__table__header__items_{
        margin-left: 0.5rem;
    }
    .form-control{
        width: 100%;
        background-color: #ffffff;
        border: 1px solid transparent;
        padding: 6px 8px 6px 10px;
    }
    .form-control:focus{
        outline: none;
        border: 1px solid #d2d2d2;
    }
    .main__table__owners{
        display: flex;
        flex-wrap: wrap;
        &--buttons{
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            &_items:first-child{
              margin-bottom: 0.5rem;
            }
          }
        
        &--items{
          width: 50%;
          
          &_inside{
            display: flex;
            justify-content: space-between;
            margin: 5px;
            padding: 5px;
            height: 85px;
            cursor: pointer;
            align-items: center;
            box-shadow: 0px 0px 6px 1px #0000001a;
            &:hover{
              box-shadow: 0px 0px 6px 4px #0000001a;
            }
          }
        }
        &--name span{
            font-weight: bolder;
        }
        &--counting{
            display: flex;
            margin-top: 0.5rem;
            &-items{
              margin-right: 1rem;
            }
        }
        &--buttons_items{
          border: 1px solid whitesmoke;
          width: fit-content;
          padding: 5px;
          cursor: pointer;
          display: flex;
          align-items: center;
          width: 120px;
          display: flex;
          justify-content: center;
          &:hover{
            border: 1px solid #ccc8c8;
          }
          img{
            margin-right: 0.5rem;
          }
        }
    }
</style>