<template>
    <div class="nav fx vertical_center">
        <div @click='gotohomepage' class="fx-1 nav__logo">
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
        uybor: 0,
        olx: 0,
    }
  },
  created() {
      this.getEstates();
  },
  methods:{
    gotohomepage(){
        this.$router.push('/');
    },
    getEstates() {
        
        axios.get(this.$api_url+'/api/count/estates').then((response) => {
            console.log(response.data);
            if(response.data.status){
                this.uybor = response.data.uybor;
                this.olx = response.data.olx;
            }
            //  console.log(this.response.data);
            // this.estate = response.estates;
        }).catch( error => { console.log(error); });
    }
  },
}
</script>