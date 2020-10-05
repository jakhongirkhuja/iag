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
                Таблица общая Uybor
            </div>
        </div>
        <RigtSideBar/>
        
    </div>
</template>
<script>
import Filter_s from '../layouts/Filter_s';
import RigtSideBar from '../layouts/RigtSideBar';
export default {
    name: 'uybor',
    components: {
      Filter_s,
      RigtSideBar
    }
}
</script>