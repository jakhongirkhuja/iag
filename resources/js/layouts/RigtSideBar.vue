<template>
    <div class="main__right__side fx fx-col">
            <div @click='estatespage'  v-bind:class="{ active: isActiveEstates}" class="general_list fx center ">
                <img src="/files.svg" width="25">
            </div>
            <div @click='ownerspage' v-bind:class="{ active: isActiveOwners}" class="number_list fx center">
                <img src="/people.svg" width="25">
            </div>
            <div class="scrol_up active fx center" @click="goUp">
                <img src="/up.svg" width="10">
            </div>
        </div>
</template>
<script>
export default {
    name: 'rightsidebar',
    data: function () {
        return {
            isActiveEstates: true,
            isActiveOwners: false,
        };
    },
    created() {
        if(this.$route.name == 'owners'){
            this.isActiveEstates = false;
            this.isActiveOwners = true;
        }else{
            this.isActiveOwners = false;
            this.isActiveEstates = true;
        }
        
        
    },
    methods:{
        goUp(){
            window.scrollTo(0, 0);
            
        },
        estatespage(){
            this.isActiveOwners = false;
            this.isActiveEstates = true;
            let routeData = this.$router.push({
                name: "home",
            });
        },
        ownerspage(){
            this.isActiveEstates = false;
            this.isActiveOwners = true;
            let routeData = this.$router.push({
                name: "owners",
            });
        }

    }
}
</script>