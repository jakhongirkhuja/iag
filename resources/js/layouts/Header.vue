<template>
    <div class="nav fx vertical_center">
        <div @click='gotohomepage' class="fx-1 nav__logo">
            <img :src="this.$api_url+'/img/iagent.png'" width="75">
        </div>
       
        <div class="nav__menu" v-if="user.length!=0">
            <div class="nav__menu__user" @click="showmenu=!showmenu">
                <img src="/ava.jpg" width="30">
                <span>{{user.name}}</span>
                <span v-bind:class="{active: showmenu}">&#9660;</span>
            </div> 
            <div class="nav__menu__dash" v-if="showmenu">
                <div class="nav__menu__dash-items">Профиль</div>
                <div class="nav__menu__dash-items">Объявление</div>
                <div class="nav__menu__dash-items" @click="logout">Выход</div>
            </div>
            
        </div>
        <div class="nav__menu" @click='login' v-else style="display: flex; cursor:pointer; align-items: center;">
            Войти в кабинет <img src="/img/enter.svg" width="20" style="margin-left:0.5rem">
        </div>
    </div>
</template>
<script>
export default {
    data() {
    return {
        showmenu: false,
        user:[],
        url: "get/a_u",
        logout_url: "logout",
    }
  },
  created() {
     
      this.getAuthuser();
  },
  mounted() {
     
    
   
    //  [App.vue specific] When App.vue is finish loading finish the progress bar
  },
  methods:{
    getAuthuser(){
        axios
        .get(this.$api_url + "/" + this.url)
        .then((response) => {
           
          if (response.data.status) {
            // console.log(response);
            if(response.data.user==null){
                this.user = [];
            }else{
                this.user = response.data.user;
            }
            
          }
        })
        .catch((error) => {
          console.log(error);
          
        });
    },
    logout(){
        axios
        .get(this.$api_url + "/" + this.logout_url)
        .then((response) => {
           
          if (response.data.status) {
            // console.log(response);
            this.user = [];
          }
        })
        .catch((error) => {
          console.log(error);
          
        });
    },
    gotohomepage(){
        window.location.href = this.$api_url
    },
    login(){
        window.location.href = this.$api_url+'/login';
    }
    
  },
}
</script>