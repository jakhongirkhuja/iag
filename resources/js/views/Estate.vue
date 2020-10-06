<template>
    <div class="main ">{{ this.title }}</div>
</template>
<script>
export default {
    name:'estate',
    data() {
        return {
            title: '',
        }
    },

    methods: {
        getEstate(slug){
            axios.get(this.$api_url+'/api/estate/'+slug).then((response) => {
            
            if(response.data.status){
                this.title = response.data.estate.title;
            }
            //  console.log(this.response.data);
            // this.estate = response.estates;
        }).catch( error => { console.log(error); });
            
        }
    },
    created() {
        this.getEstate(this.$route.params.slug);
    }
}
</script>