<template>
    <div class="main ">
        <div class="estate container">
            <div class="estate__mainpart fx">
                <div class="estate__mainpart__imgs fx-1">
                    <div class="estate__mainpart__imgs_big">
                        <img :src=main_image @click="openModal(2)" >
                    </div>
                    <div class="estate__mainpart__imgs__thumbnails">
                        <div v-for="img in imgs" :key="img.id" v-on:click="changemainimg(img)">
                            <img :src=img>
                        </div>    
                    </div>
                </div>
                <div class="estate__mainpart__shortinfo fx-1">
                    <div class="estate__mainpart__shortinfo__title">
                        <h1>{{ estate.title }} </h1>
                    </div>
                    <div class="estate__mainpart__shortinfo__loc_upd">
                        <div class="estate__mainpart__shortinfo__loc_upd-l">
                            {{ estate.city }}, <br> {{ estate.region }} 
                        </div>
                        <div class="estate__mainpart__shortinfo__loc_upd-u" v-if="estate.update_at!= estate.create_at">
                            <span>( обновлено )</span> <br>
                            {{ estate.update_at }}<br>
                            <span>( добавлено )</span> <br>
                            {{ estate.create_at }}
                        </div>
                        <div class="estate__mainpart__shortinfo__loc_upd-u" v-else>
                            <span>( добавлено )</span> <br>
                            {{ estate.create_at }}
                        </div>

                    </div>
                    <div class="estate__mainpart__shortinfo__area__price">
                        <div class="estate__mainpart__shortinfo__area__price-a">
                            <p>Площадь</p>
                            <p>{{estate.total_area}} m <sup>2</sup></p>
                        </div>
                        <div class="estate__mainpart__shortinfo__area__price-p">
                             <p>Цена</p>
                            <p v-if="estate.price!=0">{{estate.price}} {{estate.currency}}</p>
                            <p v-else>Договорная</p>
                        </div>
                        <div class="estate__mainpart__shortinfo__area__price-p">
                             <p>Цена за м<sup>2</sup></p>
                            <p v-if="estate.price!=0">
                                <span v-if="estate.total_area!=0">{{parseInt(estate.price/ estate.total_area) }} {{estate.currency}}</span>
                                <span v-else>0 {{estate.currency}}</span>
                                </p>
                            <p v-else>Договорная</p>
                        </div>
                    </div>
                    <div class="estate__mainpart__shortinfo__list">
                        <div class="estate__mainpart__shortinfo__list__items">
                            <p>Комнат</p>
                            <p>{{ estate.num_rooms }}</p>
                        </div>
                        <div class="estate__mainpart__shortinfo__list__items">
                            <p>Этаж</p>
                            <p>{{ estate.floor }}</p>
                        </div>
                        <div class="estate__mainpart__shortinfo__list__items">
                            <p>Этажность</p>
                            <p>{{ estate.floor_house }}</p>
                        </div>
                        <div class="estate__mainpart__shortinfo__list__items">
                            <p>Ремонт</p>
                            <p>{{ estate.remont }}</p>
                        </div>
                        <div class="estate__mainpart__shortinfo__list__items">
                            <p>Статус</p>
                            <p v-if="estate.status==1">&#10003; активный</p>
                            <p v-else>&#10006; закрыто</p>
                        </div>
                    </div>
                    <div class="estate__mainpart__shortinfo__icons">
                        <div class="estate__mainpart__shortinfo__icons__items" v-on:click="downloadPDF(estate.id)">
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
                        <div class="estate__mainpart__shortinfo__icons__items" v-on:click="сomplain(estate.id)">
                            <div class="estate__mainpart__shortinfo__icons__items__img">
                                <img :src="this.$api_url+'/img/warning.svg'" width="20">
                            </div>
                            <div class="estate__mainpart__shortinfo__icons__items__text">
                                Пожаловаться
                            </div>
                        </div>
                        
                    </div>
                    <div style="text-align: right; margin-top: 0.5rem;">
                        <a style="font-size:0.8rem; text-decoration: underline" target="_blank" :href="'http://mykorea.uz/redirect/?s=' + estate.url" >открыть исходник</a>
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

                        <div class="estate__secondary__convenience__body-map">
                            <h3>Карта</h3>
                            <div>
                                <iframe class="pt-1"
                                width="100%" 
                                height="300" 
                                frameborder="0" 
                                marginheight="0" 
                                marginwidth="0" 
                                :src="this.estate.map"
                                 style="max-width: 640px;">
                                </iframe> 
                            </div>
                             
                        </div>  
                        <div v-if="prices.length!=1 && prices.length!=0" class="estate__secondary__convenience__body-map">
                            <h3>История цен</h3>
                            <line-chart :data="chartData"></line-chart>
                            
                        </div>                        
                    </div>
                </div>
                <div class="estate__secondary__owner fx fx-col fx-1">
                    <div class="estate__secondary__owner__info">
                        <div class="estate__secondary__owner__info-name" v-if="this.estate.owner">
                            <h3>{{ this.estate.owner.name }}</h3>
                            <p>  {{ this.estate.announcement }}</p>
                        </div>
                        <div class="estate__secondary__owner__info-number" v-if="estate.owner" >
                            <div class="btn btn-primary" @click="getNumber( estate.owner.id,estate.owner.update_at)" v-if="number.length==0">Открыть номер</div>
                            <div v-else >
                                <div v-for="num in number" :key="num.id">
                                    <a style="padding: 0.5rem 0.5rem; color: inherit; font-size: 1.5rem;"  v-bind:href="'tel:'+num">{{num}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="estate__secondary__owner__others" v-if="this.estate.owner_estates">
                        <h3 style="cursor:pointer" @click="OpenOwnerEstates">открыть все объявления автора</h3>
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
                                            {{ ownother.update_at }}
                                        </div>
                                    </div>
                                    <div class="estate__secondary__owner__others__item_a_p">
                                        <div class="estate__secondary__owner__others-a fx">
                                            <div>комнат: {{ ownother.num_rooms }}</div>
                                            <div>площадь: {{ ownother.total_area}} m <sup>2</sup></div>
                                            
                                            <div class="estate__secondary__owner__others-a_p">{{ ownother.price }} {{ownother.currency}}</div>
                                        </div>
                                    </div>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal__image"  v-if="showmodal">
            <div class="modal__image__container" v-bind:class="{ active: showmodal}">
                <div class="modal__image__container-body">
                    <span class="modal__image-close" @click="closeModal">&#10005;</span>
                    <div class="slideshow-container" v-if="main_image">
                        <div class="mySlides fade" >
                            <div class="numbertext">{{ slideIndex+1 }} / {{ imgs.length+1 }}</div>
                            <img :src="main_image" style="max-width: 100%; max-height: 80vh;">
                        </div>
                        <a class="prev" @click="plusSlides(slideIndex-1)">&#10094;</a>
                        <a class="next" @click="plusSlides(slideIndex+1)">&#10095;</a>
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
            slideIndex: 1,
            showmodal: false,
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
            td: null,
            p: new Date().getDate()+new Date().getMonth()+1,
            s: new Date().getDate()*(new Date().getMonth()+1),
            y: new Date().getFullYear(),
            m: null,
            number: [],
            prices: [],
            chartData: new Object()
        }
    },

    methods: {
        сomplain(id){
            window.open('https://t.me/Bakers_Dozen','_blank');
        },
        downloadPDF(id){
            // console.log(id);
            window.location = this.$api_url+'/pdf/'+id;
        },
        closeModal(){
            this.showmodal = false;
        },
        openModal(index){
            this.showmodal = true;
            
        },
        plusSlides(n) {
            this.slideIndex = n;
            
            if(n==0 || n==-1){
                this.slideIndex = this.imgs.length-1;
            }
            if(this.imgs.length ==n){
                this.slideIndex = 0;
            }
            this.main_image = this.imgs[this.slideIndex];
            console.log(n);
        },
        
        po(d){
            
            return parseInt(d*this.m);
        },
        o(t){
            
            return parseInt(t.match(/\d/g).join("")); 
        },
        h(h){
            console.log(window.btoa(h));
            return window.btoa(h);
        },
        getNumber(id, t){
            
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
            
        
        },
        OpenOwnerEstates(){
            // this.$router.push({ name: "OwnersEach", params: {id:this.estate.owner.id} });
            let routeData = this.$router.resolve({ name: 'OwnersEach', params: {id:this.estate.owner.id} });
                window.open(routeData.href, '_blank');
        },
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
                this.prices = response.data.all_prices;
                console.log(this.prices);
                for (let index = 0; index < this.prices.length; index++) {
                    this.chartData[Object.keys(this.prices[index])]= this.prices[index][Object.keys(this.prices[index])]; 
                }
                
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
        this.m = this.p*this.s*this.y;
        
    },
    
    mounted(){
       
    }
}
</script>
<style type="text/css" media="print">
  @page { size: landscape; }
</style>