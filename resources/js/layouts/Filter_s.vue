<template>
  <div class="main__left__side fx fx-col" v-bind:class="{ closedactive: filterdiv }">
    <div class="openfilter" @click="showfilterdiv" v-if="filterdiv">показать фильтр</div>
    <!-- <div class="filter" @click="showfilterdiv">
      <img src="/settings.svg" />
    </div>
    <div class="filter_text fx-1" @click="showrange">ПОКАЗАТЬ ФИЛЬТР</div> -->
    <div  class="filter__items">
      <div class="filter__items_div">
      <!-- <span class="close" @click="closefilter"></span> -->
        <div class="fx-1">
          <div class="filter__items-type ">
            <input type="radio"  v-model="type" v-bind:value="1" name="prodaja" id="prodaja" />
            <label for="prodaja">Продажа</label>
            <input type="radio" name="prodaja" v-model="type" v-bind:value="2" id="arenda" />
            <label for="arenda">Аренда</label>
          </div>
          <div class="filter__items-building ">
            <input type="radio"  v-model="house_type" v-bind:value="1"  name="building" id="building-v" />
            <label for="building-v">Вторичный</label>
            <input type="radio"  v-model="house_type" v-bind:value="2"  name="building" id="building-n" />
            <label for="building-n">Новостройка</label>
          </div>
          <div class="filter__items-rooms ">
            <div class="filter__items-t--title">Комнат:</div>
            <input type="radio" v-model="room" v-bind:value="1"  name="rooms" id="room1" />
            <label for="room1">1x</label>
            <input type="radio" v-model="room" v-bind:value="2"  name="rooms" id="room2" />
            <label for="room2">2x</label>
            <input type="radio" v-model="room" v-bind:value="3" name="rooms" id="room3" />
            <label for="room3">3x</label>
            <input type="radio" v-model="room" v-bind:value="4" name="rooms" id="room4" />
            <label for="room4">4x</label>
            <input type="radio" v-model="room" v-bind:value="5" name="rooms" id="room5" />
            <label for="room5">5+</label>
          </div>
        </div>
        <div class="fx-1">
          <div class="filter__items-price ">
            <div class="filter__items-t">
              <div class="filter__items-t--title">Цена: </div>
              <div class="filter__items-t--c">
                <input type="radio" v-model="currency" v-bind:value="1" name="c" id="ye" />
                <label for="ye">у.е</label>
                <input type="radio" v-model="currency" v-bind:value="2" name="c" id="psum" />
                <label for="psum">сум</label>
              </div>
            </div>

            <VueSimpleRangeSlider v-if="currency==1" :min="0"  :max="1000000" :logarithmic="true" v-model="price_sum_y"/>
            <VueSimpleRangeSlider :min="0" v-if="currency==2" :max="100000000000" :logarithmic="true" v-model="price_sum"/>
          </div>
          <div class="filter__items-price ">
            <div class="filter__items-t--title">Площадь: м<sup>2</sup></div>

            <VueSimpleRangeSlider :min="15" :max="300" v-model="area" />
          </div>
          
        </div>
        <div class="fx-1">
          <div class="filter__items-floor ">
            <div class="filter__items-floor ">
              <div class="filter__items-t--title">Этаж:</div>

              <VueSimpleRangeSlider :min="1" :max="30" v-model="floor" />
            </div>
            <div class="filter__items-t--title">Ремонт:</div>
            <select class="filter__items_selection" name="remont" v-model="remont_id" >
                <option selected value="0">Все</option>
                <option v-for="remont in remonts" :key="remont.id" :value="remont.id" >{{remont.name}}</option>
            </select>
            
          </div>
          <div class="filter__items-city pt-1">
              <div class="filter__items-t--title">Район:</div>
              <select
                name="choosecity"
                v-model="selected_city"
                class="filter__items_selection">
                <option value="0">Город Ташкен</option>
                <option value="1600">Ташкентская область</option>
                <option value="1">Чиланзарский район</option>
                <option value="5">Алмазарский район</option>
                <option value="8">Яккасарайский район</option>
                <option value="11">Юнусабадский район</option>
                <option value="13">Мирзо-Улугбекский район</option>
                <option value="15">Яшнабадский район</option>
                <option value="16">Олмазорский район</option>
                <option value="17">Шайхантахурский район</option>
                <option value="18">Сергелийский район</option>
                <option value="19">Учтепинский район</option>
                <option value="20">Мирабадский район</option>
                <option value="22">Бектемирский район</option>
              </select>
            </div>
        </div>
        </div>
        <div class="filter__items-btns">
            <img src="img/up.svg" width="25" title="Закрыть фильтр" @click="closefilter">
            <div @click="resetquery" class="filter__items-btns-clean btn btn-secondary">
                Очистить
            </div>
            <div @click="searchquery" class="filter__items-btns-submit btn btn-primary">
                Поиск
            </div>
        </div>
    </div>
  </div>
</template>
<script>
import VueSimpleRangeSlider from "vue-simple-range-slider";
import "vue-simple-range-slider/dist/vueSimpleRangeSlider.css";
export default {
  name: "filter_s",
  components: { VueSimpleRangeSlider },
  data() {
    return {
      filterdiv: false,
      price_sum_y: [20, 1000],
      price_sum: [5000, 600000000],
      area: [20, 150],
      floor: 2,
      selected_city: 0,
      remonts: [],
      remont_id: 0,
      type: 1,
      house_type: 1,
      room: 2,
      currency: 1,
     
    };
  },
  
  maunted() {
    
  },
  created(){
      this.getRemont('');
  },
  methods: {
    showfilterdiv() {
       this.filterdiv = false;
    },
    showrange() {
      
    },
    closefilter() {
      this.filterdiv = true;
    },
    getRemont(){
        axios.get(this.$api_url+'/api/remont/types').then((response) => {
                if(response.data.status){
                    this.remonts = response.data.remonts;
                  
                    
                }else{
                    
                    this.remont_id = 0;
                }
        }).catch( error => { console.log(error); });
    },
    searchquery(){
        this.$parent.filterAllEstates(this.type, this.house_type, this.room,  this.area[0], this.area[1], this.currency,  this.price_sum_y[0], this.price_sum_y[1], this.price_sum[0], this.price_sum[1], this.floor, this.remont_id, this.selected_city, );
    },
    resetquery(){
      this.price_sum_y= [20, 1000];
      this.price_sum=[5000, 600000000];
      this.area= [20, 150];
      this.floor= 2;
      this.selected_city= 0;
      this.remont_id= 0;
      this.type= 1;
      this.house_type= 1;
      this.room= 2;
      this.currency= 1;
    }
  },
};
</script>
<style lang="scss" scoped>
@import "../../sass/_filter_inside.scss";
</style>