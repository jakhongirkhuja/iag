<template>
    <div class="nav fx vertical_center">
        <div @click='gotohomepage' class="fx-1 nav__logo">
            Iagent Test
        </div>
       
        <div class="nav__menu">
            <div class="nav__menu__user" @click="showmenu=!showmenu">
                <img src="/ava.jpg" width="30">
                <span>Tamara Kulikova</span>
                <span v-bind:class="{active: showmenu}">&#9660;</span>
            </div> 
            <div class="nav__menu__dash" v-if="showmenu">
                <div class="nav__menu__dash-items">Профиль</div>
                <div class="nav__menu__dash-items">Объявление</div>
                <div class="nav__menu__dash-items">Виход</div>
            </div>
            
        </div>
    </div>
</template>
<script>
export default {
    data() {
    return {
        showmenu: false,
        
    }
  },
  created() {
     
  },
  methods:{
    gotohomepage(){
        window.location.href = this.$api_url
        
    },
    
  },
}
</script>