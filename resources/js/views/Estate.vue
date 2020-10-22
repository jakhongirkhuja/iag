<template>
    <div class="main ">
        <div class="estate container">
            <div class="estate__mainpart fx">
                <div class="estate__mainpart__imgs fx-1">
                    <div class="estate__mainpart__imgs_big">
                        <img :src=main_image >
                    </div>
                    <div class="estate__mainpart__imgs__thumbnails">
                        <div v-for="img in this.imgs" :key="img.id" v-on:click="changemainimg(img)">
                            <img :src=img>
                        </div>    
                    </div>
                </div>
                <div class="estate__mainpart__shortinfo fx-1">
                    <div class="estate__mainpart__shortinfo__title">
                        <h1>{{ this.estate.title }} <a style="font-size:0.8rem;" target="_blank" v-bind:href=this.estate.url>перейти на сайт</a></h1>
                    </div>
                    <div class="estate__mainpart__shortinfo__loc_upd">
                        <div class="estate__mainpart__shortinfo__loc_upd-l">
                            {{ this.estate.city }}, <br> {{ this.estate.region }} 
                        </div>
                        <div class="estate__mainpart__shortinfo__loc_upd-u">
                            <span>( обновлено )</span> <br>
                            {{ this.estate.update_time }}
                        </div>
                    </div>
                    <div class="estate__mainpart__shortinfo__area__price">
                        <div class="estate__mainpart__shortinfo__area__price-a">
                            <p>Площадь</p>
                            <p>{{this.estate.total_area}} m <sup>2</sup></p>
                        </div>
                        <div class="estate__mainpart__shortinfo__area__price-p">
                             <p>Цена</p>
                            <p v-if="this.estate.price!=0">{{this.estate.price}} {{this.estate.price_cur}}</p>
                            <p v-else>Договорная</p>
                        </div>
                    </div>
                    <div class="estate__mainpart__shortinfo__list">
                        <div class="estate__mainpart__shortinfo__list__items">
                            <p>Комнат</p>
                            <p>{{ this.estate.num_rooms }}</p>
                        </div>
                        <div class="estate__mainpart__shortinfo__list__items">
                            <p>Этаж</p>
                            <p>{{ this.estate.floor }}</p>
                        </div>
                        <div class="estate__mainpart__shortinfo__list__items">
                            <p>Этажность</p>
                            <p>{{ this.estate.floor_house }}</p>
                        </div>
                        <div class="estate__mainpart__shortinfo__list__items">
                            <p>Статус</p>
                            <p v-if="this.estate.status==1">&#10003;</p>
                            <p v-else>&#10006;</p>
                        </div>
                    </div>
                    <div class="estate__mainpart__shortinfo__icons">
                        <div class="estate__mainpart__shortinfo__icons__items">
                            <div class="estate__mainpart__shortinfo__icons__items__img">
                                <img :src="this.$api_url+'/img/pdf.svg'" width="20">
                            </div>
                            <div class="estate__mainpart__shortinfo__icons__items__text">
                                Скачать PDF
                            </div>
                        </div>
                        <div class="estate__mainpart__shortinfo__icons__items">
                            <div class="estate__mainpart__shortinfo__icons__items__img">
                                <img :src="this.$api_url+'/img/print.svg'" width="20">
                            </div>
                            <div v-on:click="printpage" class="estate__mainpart__shortinfo__icons__items__text">
                                Распечатать
                            </div>
                        </div>
                        <div class="estate__mainpart__shortinfo__icons__items">
                            <div class="estate__mainpart__shortinfo__icons__items__img">
                                <img :src="this.$api_url+'/img/warning.svg'" width="20">
                            </div>
                            <div class="estate__mainpart__shortinfo__icons__items__text">
                                Пожаловаться
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="estate__secondary fx">
                <div class="estate__secondary__convenience fx-1">
                    <div class="estate__secondary__convenience__has fx">
                        <div class="estate__secondary__convenience__app" v-if="this.estate.apartment_has">
                            <div class="estate__secondary__convenience__inside" >
                                <h3>Есть помещение:</h3>
                                <div v-html="this.estate.apartment_has"></div>
                                <!-- <pre>{{ this.estate.apartment_has }}</pre> -->
                            </div>
                        </div>
                        <div class="estate__secondary__convenience__near" v-if="this.estate.near_has" >
                            <div class="estate__secondary__convenience__inside" >
                                <h3>Есть рядом:</h3>
                                <div v-html="this.estate.near_has"></div>
                                <!-- <pre>{{ this.estate.near_has }}</pre> -->
                            </div>
                        </div>
                    </div>
                    <div class="estate__secondary__convenience__body pt-1" v-if="this.estate.body">
                        <h3>Общая информация</h3>
                        <div v-html="this.estate.body"></div>
                    </div>
                </div>
                <div class="estate__secondary__owner fx fx-col fx-1">
                    <div class="estate__secondary__owner__info">
                        <div class="estate__secondary__owner__info-name" v-if="this.estate.owner">
                            <h3>{{ this.estate.owner.name }}</h3>
                            <p v-if="this.estate.announcement">  {{ this.estate.announcement.name  }}</p>
                        </div>
                        <div class="estate__secondary__owner__info-number" v-if="this.estate.owner">
                            <div class="btn btn-primary">Открыть номер</div>
                        </div>
                    </div>
                    <div class="estate__secondary__owner__others" v-if="this.estate.owner_estates">
                        <h3>другие объявления автора</h3>
                        <div  class="estate__secondary__owner__others__items">
                            <router-link  
                                :to="{ 
                                    name: 'estate', 
                                    params: { slug: ownother.slug } 
                                }" 
                                v-for="ownother in this.estate.owner_estates" 
                                :key="ownother.id" target="_blank" class="estate__secondary__owner__others__item">
                                    <div class="estate__secondary__owner__others__item_title">
                                        {{ ownother.title.substring(0,50)+"..." }}
                                    </div>
                                    <div class="estate__secondary__owner__others__item_l_u fx">
                                        <div class="estate__secondary__owner__others-l">
                                            {{ ownother.city}}, {{ ownother.region }}
                                        </div>
                                         <div class="estate__secondary__owner__others-u">
                                            {{ ownother.update_time }}
                                        </div>
                                    </div>
                                    <div class="estate__secondary__owner__others__item_a_p">
                                        <div class="estate__secondary__owner__others-a fx">
                                            <div>комнат: {{ ownother.num_rooms }}</div>
                                            <div>площадь: {{ ownother.total_area}} m <sup>2</sup></div>
                                            
                                            <div class="estate__secondary__owner__others-a_p">{{ ownother.price }} {{ownother.price_cur}}</div>
                                        </div>
                                    </div>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    name:'estate',
    data() {
        return {
            estate: [],
            main_image: this.$api_url+'/img/no.jpg',
            imgs: [
                this.$api_url+'/img/no.jpg',
                this.$api_url+'/img/no.jpg',
                this.$api_url+'/img/no.jpg',
                this.$api_url+'/img/no.jpg',
                this.$api_url+'/img/no.jpg',
                this.$api_url+'/img/no.jpg',
            ],
        }
    },

    methods: {
        changemainimg(img){
            this.main_image = img;
        },
        printpage(){
            window.print();
        },
        getEstate(slug){
            axios.get(this.$api_url+'/api/estate/'+slug).then((response) => {
            
            if(response.data.status){
                this.estate = response.data.estate;
                if(response.data.estate.imgs != undefined){
                    this.imgs = response.data.estate.imgs;
                    this.main_image = response.data.estate.imgs[0];
                }else{
                    console.log('here');
                }
                
            }
            //  console.log(this.response.data);
            // this.estate = response.estates;
            this.$Progress.finish()
        }).catch( error => { console.log(error); });
            
        }
    },
    created() {
        this.$Progress.start()
        this.getEstate(this.$route.params.slug);
    }
}
</script>