<template>
    <div class="main__center fx-1">
            <div class="main__table__header fx vertical_center">
                <div class="main__table__header__items">
                    Подобрать по
                </div>
                <div class="main__table__header__items fx vertical_center">
                    <div class="main__table__header__items__text">
                        Цены
                    </div>
                    <div class="main__table__header__items__selection">
                        <select class="form-control">
                            <option selected disabled>Выбрать</option>
                            <option>убыванию</option>
                            <option>возрастанию</option>
                        </select>
                    </div>
                </div>
                <div class="main__table__header__items fx vertical_center">
                    <div class="main__table__header__items__text">
                        Кол-во комнат
                    </div>
                    <div class="main__table__header__items__selection">
                       <select class="form-control">
                            <option selected disabled>Выбрать</option>
                            <option>убыванию</option>
                            <option>возрастанию</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="main__table__body">
                
                <table class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Комнт</th>
                        <th scope="col">Район</th>
                        <th scope="col">Площадь</th>
                        <th scope="col">Этаж</th>
                        <th scope="col">Цена</th>
                        <th scope="col">Обновлено</th>
                        </tr>
                    </thead>
                    <tbody style="text-align:center">
                        <tr v-for="estate in estates" :key="estate.id" v-on:click="openEstate(estate.slug)">
                            <th scope="row">{{estate.housingtype}}</th>
                            <td>{{ estate.num_rooms }}</td>
                            <td>{{ estate.city }} {{ estate.region }}</td>
                            <td>{{ estate.total_area }} m <sup>2</sup></td>
                            <td>{{ estate.floor }} ({{ estate.floor_house }})</td>
                            <td>{{ estate.price }} {{ estate.price_cur }}</td>
                            <td>{{ estate.update_time }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="pagination">
                    <div class="pagination__prev" @click="changepagination(pagination.last_page_url)">&#8249;</div>
                    <div class="pagination__curr">{{ pagination.current_page }}</div>
                    <div class="pagination__next" @click="changepagination(pagination.next_page_url)">&#8250;</div>
                </div>
                
                
            </div>
        </div>
</template>
<script>
export default {
    name: 'tableshow',
    props: ['estates', 'pagination'],
    data: function(){
        return {
             
        }
    },
    mounted () {
        
      
    },
    methods: {
        changepagination(url){
            var ur = 'api/show/estate'+url;
            
            if(this.$route.path=='/uybor'){
                ur = 'api/show/estate/2'+url;
            }else if(this.$route.path=='/olx'){
                ur = 'api/show/estate/1'+url;
            }
            console.log(this.$route.path+'hello there');
            console.log(url)
            this.$parent.getEstates(ur);
        },
        openEstate(slug){
            console.log(slug);
            // let routeData = this.$router.resolve({ name: 'estate', params: { slug: slug } });
            // window.open(routeData.href, '_blank');
            let routeData = this.$router.push({ name: 'estate', params: { slug: slug } });
            
        }
    },
}
</script>