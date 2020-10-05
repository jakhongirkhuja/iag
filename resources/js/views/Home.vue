<template>
    <div class="main fx">
        <Filter_s/>
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
                        <tr v-for="estate in estates" :key="estate.id">
                        <th scope="row">НВ</th>
                        <td>{{ estate.num_rooms }}</td>
                        <td>Ташкент, Юнусабадский район</td>
                        <td>{{ estate.total_area }} m <sup>2</sup></td>
                        <td>{{ estate.floor }} ({{ estate.floor_house }})</td>
                        <td>{{ estate.price }} {{ estate.price_cur }}</td>
                        <td>{{ estate.update_time }}</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <RigtSideBar/>
        
    </div>
</template>
<script>
import Filter_s from '../layouts/Filter_s';
import RigtSideBar from '../layouts/RigtSideBar';
export default {
    name: 'home',
    components: {
      Filter_s,
      RigtSideBar
    },
    data: function(){
        return {
            estates: []
        }
    },
    mounted () {
        this.getEstates();
    },
    methods: {
        getEstates() {
            axios.get('api/show/estate').then((response) => {
                if(response.data.status){
                    this.estates = response.data.estate;
                }
                console.log(this.estates);
                // this.estate = response.estates;
            }).catch( error => { console.log(error); });
        }
    }
}
</script>