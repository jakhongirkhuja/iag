<template>
    <div class="main fx fx-col">
        <div class="owner__info fx">
            <div>
                <p><b>{{ owner.name }}</b>, {{owner.type}}</p>
                <div class="fx">
                    <div>продажа: <b>{{owner.amount}}</b></div>
                    <div v-if="owner.newhouse!=0 && owner.newhouse!=null">Новостройки:<b> {{owner.newhouse}}</b></div>
                    <div v-if="owner.oldhouse!=0 && owner.oldhouse!=null">Вторичный рынок:<b> {{owner.oldhouse}}</b></div>
                </div>
                
            </div>
            <div class="owner__info--contacts">
                
                <div v-if="number.length==0" @click="getNumber( owner.id,owner.update_at)">
                    <img v-bind:src="this.$api_url+'/img/phone2.svg'" width="20"> Контакты
                </div> 
                <div v-else>
                    <a style="padding:0 0.5rem; color:inherit" v-for="num in number" :key="num.id" v-bind:href="'tel:'+num">{{num}}</a>
                </div>
            </div>
                
        </div>
        
        <TableShowOwnerEach
            v-bind:estates="estates"
            v-bind:count_all="count_all"
            v-bind:next_page="next_page"
            v-bind:prev_page="prev_page"
            v-bind:cur_page="cur_page"
            v-bind:last_page="last_page"
            v-bind:empty_estate="empty_estate"
            />
    </div>
</template>
<script>
import TableShowOwnerEach from "../views/TableShowOwnerEach";
export default {
    name: 'OwnersEach',
    components: {
        TableShowOwnerEach
    },
    data: function () {
        return {
        estates: [],
        url: "api/show/owner/estate/"+this.$route.params.id,
        urlInfo: "api/show/owner/info/"+this.$route.params.id,
        pagination: [],
        latest: 1,
        itemsOrder: 1,
        cur_page: 1,
        next_page: null,
        prev_page: null,
        count_all: 0,
        last_page: 1,
        empty_estate: false,
        owner: [],
        td: null,
        p: new Date().getDate()+new Date().getMonth()+1,
        s: new Date().getDate()*(new Date().getMonth()+1),
        y: new Date().getFullYear(),
        m: null,

        number: [],
        };
    },
    created() {
        this.getEstates();
        this.getOwnerInfo();
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
            this.showmodal = true;
        
        },
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
                path: "/owners/"+this.$route.params.id,
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
                path: "/owners/"+this.$route.params.id,
                query: que,
                })
                .catch((err) => {});
            this.getEstates();
            },
        getOwnerInfo(){
            axios
                .get(this.$api_url + "/" + this.urlInfo)
                    .then((response) => {
                        if (response.data.status) {
                            this.owner = response.data.owner;
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                        
                    });
        },    
        getEstates() {
            this.estates = [];
            this.$Progress.start();
            const queryString = window.location.search;
            
            axios
                .get(this.$api_url + "/" + this.url+ "/" + queryString)
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
    }
}
</script>
<style lang="scss" scoped>
  .main{
      background-color: white;
      .owner__info{
            padding-top: 2rem;
            padding-bottom: 2rem;
            justify-content: space-between;
            padding-left: 2rem;
            width: fit-content;
            align-items: center;
            .fx div{
                margin-right: 1rem;
                font-size: 0.9rem;
            }
            p b{
                font-size: 2rem;
            }
            &--contacts{
                div{
                    margin-left: 1rem;
                    display: flex;
                    align-content: center;
                    padding: 8px;
                    border: 1px solid #ccc8c8;
                    cursor: pointer;
                    &:hover{
                        border: 1px solid #abaaaa;
                    }
                    img{
                        margin-right: 0.5rem;
                    }
                }
                
            }

      }
  }
</style>