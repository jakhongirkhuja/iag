<template>
    <div class="main fx">
        <Filter_s/>
        <TableShow  v-bind:estates='estates' v-bind:pagination ='pagination'/>
        <RigtSideBar/>
        
    </div>
</template>
<script>
import Filter_s from '../layouts/Filter_s';
import TableShow from '../views/TableShow';
import RigtSideBar from '../layouts/RigtSideBar';
export default {
    name: 'home',
    components: {
        Filter_s,
        RigtSideBar,
        TableShow
    },
    data: function(){
        return {
            estates: [],
            url: 'api/show/estate',
            pagination: [],
        }
    },
    created () {
        
        var par = this.$route.query.page;
        if(typeof(par) != 'undefined' || par != null){
            this.url = this.url+'?page='+par;
        }
        this.getEstates(this.url);
    },
    methods: {
        getEstates(url) {
            console.log(url);
            axios.get(url).then((response) => {
                if(response.data.status){
                    this.estates = response.data.estate.data;
                    var curr = response.data.estate.current_page;
                    var lastp = response.data.estate.last_page;
                    this.pagination['current_page'] = curr;
                    if(curr-1 == 0){
                        this.pagination['last_page_url'] = '?page='+curr;
                    }else{
                        this.pagination['last_page_url'] = '?page='+(curr-1);
                    }
                    if(lastp+1== curr+1){
                        this.pagination['next_page_url'] = '?page='+curr;
                    }else{
                        this.pagination['next_page_url'] = '?page='+(curr+1);
                    }
                    this.$router.push({query: {paginate: this.pagination.per_page, page: response.data.estate.current_page}}).catch(()=>{});
                    
                    
                    
                }
            }).catch( error => { console.log(error); });
        }
    }
}
</script>