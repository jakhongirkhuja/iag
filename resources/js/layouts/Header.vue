<template>
    <div class="nav fx vertical_center">
        <div @click='gotohomepage' class="fx-1 nav__logo">
            Iagent Test
        </div>
       
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
        uybor: 0,
        olx: 0,
    }
  },
  created() {
     
  },
  methods:{
    gotohomepage(){
        this.$router.push('/');
    },
    
  },
}
</script>