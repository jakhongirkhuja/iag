<template>
    <div class="main ">
        <div class="estate container">
            <div class="estate__mainpart fx">
                <div class="estate__mainpart__imgs fx-1">
                    <div class="estate__mainpart__imgs_big">
                        <img :src=imgs[0] >
                    </div>
                    <div class="estate__mainpart__imgs__thumbnails">
                        <div v-for="img in this.imgs" :key="img.id">
                            <img :src=img>
                        </div>    
                    </div>
                </div>
                <div class="estate__mainpart__shortinfo fx-1">
                    <div class="estate__mainpart__shortinfo__title">
                        <h1>{{ this.estate.title }}</h1>
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
                            <div class="estate__mainpart__shortinfo__icons__items__text">
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
            
        </div>
    </div>
</template>
<script>
export default {
    name:'estate',
    data() {
        return {
            estate: [],
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
        getEstate(slug){
            axios.get(this.$api_url+'/api/estate/'+slug).then((response) => {
            
            if(response.data.status){
                this.estate = response.data.estate;
                if(response.data.estate.imgs != undefined){
                    this.imgs = response.data.estate.imgs;
                }else{
                    console.log('here');
                }
                
            }
            //  console.log(this.response.data);
            // this.estate = response.estates;
        }).catch( error => { console.log(error); });
            
        }
    },
    created() {
        this.getEstate(this.$route.params.slug);
    }
}
</script>