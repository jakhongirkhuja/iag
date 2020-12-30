<template>
  <div
    class="main__left__side fx fx-col"
    v-bind:class="{ closedactive: filterdiv }"
  >
    <div class="openfilter" @click="showfilterdiv" v-if="filterdiv">
      показать фильтр
    </div>
    <!-- <div class="filter" @click="showfilterdiv">
      <img src="/settings.svg" />
    </div>
    <div class="filter_text fx-1" @click="showrange">ПОКАЗАТЬ ФИЛЬТР</div> -->
    <div class="filter__items">
      <div class="filter__items_div">
        <div style="background-color: #2888e566; width:100%">
          <div class="filter__items_div_items fx">
            <div>
              <div class="filter__items-type">
                <!-- <input type="radio"  v-model="type" v-bind:value="1" name="prodaja" id="prodaja" />
                  <label for="prodaja"><span>&#10003;</span> Продажа</label> -->
                <!-- <input type="radio" disabled name="prodaja" v-model="type" v-bind:value="2" id="arenda" />
                  <label style=" user-select: none;" for="arenda"><span>&#10003;</span> Аренда</label> -->
              </div>
            </div>
            <div>
              <div class="filter__items-rooms fx vertical_center">
                <div class="filter__items-t--title">Квартиры</div>
                <div>
                
                  <input
                    type="checkbox"
                    v-model="room1"
                    true-value="yes"
                    false-value="no"
                    name="room1"
                    id="room1"
                  />
                  <label for="room1">1</label>
                  <input
                    type="checkbox"
                    v-model="room2"
                    true-value="yes"
                    false-value="no"
                    name="room2"
                    id="room2"
                  />
                  <label for="room2">2</label>
                  <input
                    type="checkbox"
                    v-model="room3"
                    true-value="yes"
                    false-value="no"
                    name="room3"
                    id="room3"
                  />
                  <label for="room3">3</label>
                  <input
                    type="checkbox"
                    v-model="room4"
                    true-value="yes"
                    false-value="no"
                    name="room4"
                    id="room4"
                  />
                  <label for="room4">4</label>
                  <input
                    type="checkbox"
                    v-model="room5"
                    true-value="yes"
                    false-value="no"
                    name="room5"
                    id="room5"
                  />
                  <label for="room5">5+</label>
                </div>
                <div style="padding-left: 5px">- комн.</div>
              </div>
            </div>
            <div class="fx vertical_center">
              <div class="filter__items-price">
                <div class="filter__items-t">
                  <div class="filter__items-t--title">Цена:</div>
                  <input
                    class="filter__items_selection_inputs"
                    type="text"
                    v-model="price_from"
                    placeholder="от"
                  />&#8212;
                  <input
                    class="filter__items_selection_inputs"
                    type="text"
                    v-model="price_to"
                    placeholder="до"
                  />
                  <div class="filter__items-t--c fx">
                    <span>
                      <div
                        @click="latest(date.id)"
                        v-for="date in show_cur"
                        :key="date.id"
                        v-bind:class="{ active: date.selected }"
                      >
                        {{ date.name }}
                      </div>
                    </span>
                    <span>&#9660;</span>
                    <!-- <input type="radio" v-model="currency" v-bind:value="1" name="c" id="ye" />
                        <label for="ye">у.е</label>
                        <input type="radio" v-model="currency" v-bind:value="2" name="c" id="psum" />
                        <label for="psum">сум</label> -->
                  </div>
                </div>
              </div>
            </div>
            <div>
              <div class="filter__items-building">
                <input
                  type="radio"
                  v-model="photo_exist"
                  v-bind:value="1"
                  @click="photoExist"
                  name="photo_exist"
                  id="photo_exist"
                />
                <label for="photo_exist"><span class="bad">&#9744;</span><span class="good">&#9745;</span> есть фото</label>
              </div>
            </div>
            <div>
              <div class="filter__items-building">
                <input
                  type="radio"
                  v-model="house_type"
                  v-bind:value="2"
                  @click="houseType"
                  name="building"
                  id="building-n"
                />
                <label for="building-n"><span class="bad">&#9744;</span><span class="good">&#9745;</span> новостройки</label>
              </div>
            </div>
            <div>
              <div class="filter__items-type">
                <div class="ownerDiv">
                  <div class="ownerDiv__input">
                    <div v-if="ownerstypeSelected.length==0" class="ownerDiv-items_exist">
                      Выберите владельца
                    </div>
                    <div class="ownerDiv__input-items" v-for="selected in ownerstypeSelected" :key="selected.id">
                      {{ selected.name }} <span v-if="ownerstypeSelected.length!=1 && ownerstypeSelected.length!=0">,</span>
                    </div>
                  </div>
                  <div class="ownerDiv__selection">
                    <div class="ownerDiv__selection-items" v-for="type in ownerstype" :key="type.id" @click = checkownertype(type.id)>
                      <span v-if="type.selected==true">&#10003;</span> {{ type.name}} 
                    </div>
                  </div>
                </div>
              
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="filter__items_div">
          <div class="fx max-w">

            <div class="fx-1">
              <div class="fx vertical_center">
                <div class="filter__items-t--title">Тип дома</div>
                <div>
                  <select
                    class="filter__items_selection"
                    name="building_type"
                    v-model="buildingType"
                  >
                    <option
                      v-for="buil in building_type"
                      :key="buil.id"
                      :value="buil.id"
                    >
                      {{ buil.name }}
                    </option>
                  </select>
                </div>
              </div>
              <div class="fx vertical_center pt-1">
                <div class="filter__items-t--title">Ремонт:</div>
                <select
                  class="filter__items_selection"
                  name="remont"
                  v-model="remont_id"
                >
                  <option selected value="0">Все</option>
                  <option
                    v-for="remont in remonts"
                    :key="remont.id"
                    :value="remont.id"
                  >
                    {{ remont.name }}
                  </option>
                </select>
              </div>
            </div>
            <div class="fx-1">
              <div class="filter__items-floor">
                <div class="filter__items-floor fx vertical_center">
                  <div class="filter__items-t--title">Этаж:</div>
                  <input
                    class="filter__items_selection_inputs"
                    type="number"
                    v-model="floor_from"
                    placeholder="от"
                  />&#8212;
                  <input
                    class="filter__items_selection_inputs"
                    type="number"
                    v-model="floor_to"
                    placeholder="до"
                  />
                </div>
              </div>
              <div class="filter__items-floor pt-1">
                <div class="filter__items-floor fx vertical_center">
                  <div class="filter__items-t--title">Этажей в доме:</div>
                  <input
                    class="filter__items_selection_inputs"
                    type="number"
                    v-model="floor_c_from"
                    placeholder="от"
                  />&#8212;
                  <input
                    class="filter__items_selection_inputs"
                    type="number"
                    v-model="floor_c_to"
                    placeholder="до"
                  />
                </div>
              </div>
            </div>
            <div class="fx-1">
              <div class="filter__items-price fx vertical_center">
                <div class="filter__items-t--title">Площадь:</div>
                <input
                  type="number"
                  class="filter__items_selection_inputs"
                  v-model="area_from"
                  placeholder="от"
                />&#8212;
                <input
                  type="number"
                  class="filter__items_selection_inputs"
                  v-model="area_to"
                  placeholder="до"
                />м<sup>2</sup>
              </div>
              <div class="filter__items-city fx vertical_center pt-1">
                <div class="filter__items-t--title">Район:</div>
                <select
                  name="choosecity"
                  v-model="selected_city"
                  class="filter__items_selection"
                >
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
      </div>
     
       
      <div class="filter__items-btns">
        
        <img
          src="img/up.svg"
          width="25"
          title="Закрыть фильтр"
          @click="closefilter"
        />
        <div @click="resetquery" class="filter__items-btns-clean">
          <span>&times;</span> Очистить всё
        </div>
        <div
          @click="searchquery"
          class="filter__items-btns-submit btn btn-primary"
        >
          Показать результаты
        </div>
     
      </div>
    </div>
  </div>
</template>
<script>

export default {
  name: "filter_s",
 
  data() {
    return {
      multipleSelections: null,
      filterdiv: false,
      price_from: null,
      price_to: null,
      floor_from: null,
      floor_to: null,
      floor_c_from: null,
      floor_c_to: null,
      area_from: null,
      area_to: null,
      owner_type: 0,
      selected_city: 0,
      remonts: [],
      remont_id: 0,
      type: 1,
      photo_exist: 0,
      house_type: 1,
      room: 0,
      room1: 'no',
      room2: 'no',
      room3: 'no',
      room4: 'no',
      room5: 'no',
      currency: 1,
      buildingType: 0,
      ownertypeurl: 'api/show/owners/ownerstype',
      ownerstype: [],
      ownerstypeSelected:[],
      building_type: [
        {
          id: 0,
          name: "Не важно",
          selected: true,
        },
        {
          id: 1,
          name: "Кирпичный",
          selected: false,
        },
        {
          id: 2,
          name: "Панельный",
          selected: false,
        },
        {
          id: 3,
          name: "Монолитный",
          selected: false,
        },
        {
          id: 4,
          name: "Блочный",
          selected: false,
        },
        {
          id: 5,
          name: "Деревянный",
          selected: false,
        },
      ],
      show_cur: [
        {
          id: 1,
          name: "у.е",
          selected: true,
        },
        {
          id: 2,
          name: "сум",
          selected: false,
        },
      ],
    };
  },
  watch:{
    price_from: function(){
      if(this.price_from!=''){
        let letters = /^[A-Za-z]+$/;
        if(!this.price_from.match(letters)){
          this.price_from = parseFloat(this.price_from.replace(/\s/g, '')).toLocaleString('ru-Ru');
        }else{
          this.price_from = '';
        }
      }
      
      
      // this.price_from= new Intl.NumberFormat('ru-RU', { maximumSignificantDigits: 3 }).format(parseInt(this.price_from.replace(' ','')));
    },
    price_to: function(){

      if(this.price_to!=''){
        let letters = /^[A-Za-z]+$/;
        if(!this.price_to.match(letters)){
          this.price_to = parseFloat(this.price_to.replace(/\s/g, '')).toLocaleString('ru-Ru');
        }else{
          this.price_to = '';
        }
        
      }
      
      // this.price_from= new Intl.NumberFormat('ru-RU', { maximumSignificantDigits: 3 }).format(parseInt(this.price_from.replace(' ','')));
    },
  },
  maunted() {},
  created() {
    const { query } = this.$route;
    if (query.latest) {
      for (let key in this.show_cur) {
        this.show_cur[key].selected = false;
      }
      this.show_cur.find(
        (item) => item.id === parseInt(query.latest)
      ).selected = true;
    }
    this.getRemont("");
    this.getOwnersType();
  },
  methods: {
    checkownertype(id){
      if(this.ownerstype.find(item => item.id === id).selected){
       this.ownerstype.find(item => item.id === id).selected = false;
       var index = this.ownerstypeSelected.findIndex(function(o){
            return o.id === id;
        })
        if (index !== -1) this.ownerstypeSelected.splice(index, 1);
       
      }else{
        this.ownerstype.find(item => item.id === id).selected = true;
        this.ownerstypeSelected.push(this.ownerstype.find(item => item.id === id));
      }
    },
    getOwnersType(){
            
           
            axios
                .get(this.$api_url + "/" + this.ownertypeurl)
                    .then((response) => {
                        if (response.data.status) {
                          
                            this.ownerstype = response.data.ownersType;
                            this.ownerstypeSelected.push(this.ownerstype.find(x => x.selected === true));
                        }
                    })
                    .catch((error) => {
                    console.log(error);
                    }); 
        },
    ownerType() {
      if (this.owner_type == 2) {
        this.owner_type = 0;
      } else {
        this.owner_type = 2;
      }
    },
    houseType() {
      if (this.house_type == 1) {
        this.house_type = 2;
      } else {
        this.house_type = 1;
      }
    },
    photoExist() {
      if (this.photo_exist == 0) {
        this.photo_exist = 1;
      } else {
        this.photo_exist = 0;
      }
    },
    latest(id) {
      let currentid = this.show_cur.find((item) => item.selected === true).id;
      if (currentid != id) {
        for (let key in this.show_cur) {
          this.show_cur[key].selected = false;
        }
        this.show_cur.find((item) => item.id === id).selected = true;
      }
      this.currency = id;
    },
    showfilterdiv() {
      this.filterdiv = false;
    },
    showrange() {},
    closefilter() {
      this.filterdiv = true;
    },
    getRemont() {
      axios
        .get(this.$api_url + "/api/remont/types")
        .then((response) => {
          if (response.data.status) {
            this.remonts = response.data.remonts;
          } else {
            this.remont_id = 0;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    searchquery() {
      let ownerdId = this.ownerstypeSelected.map(a => a.id);
      // console.log(ownerdId.toString());
      // alert(this.owner_type);
      
      this.$parent.filterAllEstates(
        this.type,
        this.house_type,
        this.room,
        this.area_from,
        this.area_to,
        this.currency,
        this.price_from,
        this.price_to,
        this.floor_from,
        this.floor_to,
        this.floor_c_from,
        this.floor_c_to,
        this.remont_id,
        this.selected_city,
        this.buildingType,
        this.photo_exist,
        ownerdId.toString(),
        this.room1,
        this.room2,
        this.room3,
        this.room4,
        this.room5,
      );
    },
    resetquery() {
      this.price_from = null;
      this.price_to = null;
      this.area_from = null;
      this.area_to = null;
      this.floor_from = null;
      this.floor_to = null;
      this.floor_c_from = null;
      this.floor_c_to = null;
      this.selected_city = 0;
      this.remont_id = 0;
      this.type = 1;
      this.house_type = 1;
      this.room = 0;
      this.currency = 1;
      this.room1=0;
      this.room2=0;
      this.room3=0;
      this.room4=0;
      this.room5=0;
    },
  },
};
</script>
<style lang="scss" scoped>
@import "../../sass/_filter_inside.scss";
</style>