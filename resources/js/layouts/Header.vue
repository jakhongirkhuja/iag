<template>
    <div class="nav fx vertical_center">
        <div class="fx-1 nav__logo">
            Iagent Test
        </div>
       
            <router-link :to="'/olx'" class="nav__olx fx" >
                 <div class="nav__text">
                    Olx
                </div>
                <div class="nav__count">
                    {{ olx }}
                </div>
            </router-link>
           
       
        <router-link :to="'/uybor'" class="nav__uybor fx">
            <div class="nav__text">
                Uybor
            </div>
            <div class="nav__count">
                {{ uybor }}
            </div>
        </router-link>
        <div class="nav__menu">
            <div class="fx">
                <div class="nav__menu__items">
                    м
                </div>
                <div class="nav__menu__items">
                    е
                </div>
            </div>
            <div class="fx">
                <div class="nav__menu__items">
                    н
                </div>
                <div class="nav__menu__items">
                    ю
                </div>
            </div>
            
            
        </div>
    </div>
</template>
<script>
export default {
    data() {
    return {
        uybor: 1,
        olx:2,
    }
  },
}
</script>