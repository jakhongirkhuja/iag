<template>
    <div class="main fx">
        <TableShowOwner
        v-bind:owners="owners"
        v-bind:ownerstype="ownerstype"
        v-bind:count_all="count_all"
        v-bind:next_page="next_page"
        v-bind:prev_page="prev_page"
        v-bind:cur_page="cur_page"
        v-bind:last_page="last_page"
        v-bind:empty_owners="empty_owners"
        />

        <RigtSideBar />
    </div>
</template>
<script>
import RigtSideBar from "../layouts/RigtSideBar";
import TableShowOwner from "../views/TableShowOwner"
export default {
    name: 'owners',
    components: {
        RigtSideBar,
        TableShowOwner,
    },
    data: function () {
        return {
            owners: [],
            url: "api/show",
            ownertypeurl: 'api/show/owners/ownerstype',
            ownerstype: [],
            pagination: [],
            latest: 1,
            itemsOrder: 1,
            cur_page: 1,
            next_page: null,
            prev_page: null,
            count_all: 0,
            last_page: 1,
            empty_owners: false,
            type: 0,
            page:1,
            s: '',
        };
    },
    created() {
        
        this.getOwners();
        this.getOwnersType();
    },
    methods: {
        changeRouterULRPagination(){
            var query = JSON.parse(JSON.stringify(this.$route.query));
            this.page = this.cur_page;         
            query.page = this.page;
            return query;
        },
        changeRouterULRSearch(){
            var query = JSON.parse(JSON.stringify(this.$route.query));     
            query.s = this.s;
            return query;
        },
        changeRouterULRType() {
            var query = JSON.parse(JSON.stringify(this.$route.query));
            this.page = this.cur_page;         
            query.page = this.page;
            query.type = this.type;
            return query;
        },
        findsearch(search){
            this.s = search;
            let que = this.changeRouterULRSearch();
            this.$router
                .replace({
                path: "/owners",
                query: que,
                })
                .catch((err) => {});
            this.getOwners();
        },
        changetype(type){
            this.type = type;
            this.cur_page = 1;
            let que = this.changeRouterULRType();
            this.$router
                .replace({
                path: "/owners",
                query: que,
                })
                .catch((err) => {});
            this.getOwners();
        },
        changepagination(page){
            this.cur_page = page;
            let que = this.changeRouterULRPagination();
            this.$router
                .replace({
                path: "/owners",
                query: que,
                })
                .catch((err) => {});
            this.getOwners();
        },
        getOwnersType(){
            
           
            axios
                .get(this.$api_url + "/" + this.ownertypeurl)
                    .then((response) => {
                        if (response.data.status) {
                            this.ownerstype = response.data.ownersType;
                        }
                    })
                    .catch((error) => {
                    console.log(error);
                    }); 
        },
        getOwners(){
           this.$Progress.start();
            
            
           axios
                .get(this.$api_url + "/" + this.url + "" + this.$route.fullPath)
                .then((response) => {
                if (response.data.status) {
                    
                    if (response.data.owners.data.length != 0) {
                    this.count_all = response.data.owners.total;
                    this.cur_page = response.data.owners.current_page;

                    let next_page_get = response.data.owners.next_page_url;
                    if (next_page_get != null) {
                        this.next_page = next_page_get.split("?")[1].split("=")[1];
                    }

                    let prev_page_get = response.data.owners.prev_page_url;
                    if (prev_page_get != null) {
                        this.prev_page = prev_page_get.split("?")[1].split("=")[1];
                    }
                    this.last_page = response.data.owners.last_page;
                    this.owners = response.data.owners.data;
                    this.empty_owners = false;
                    } else {
                    this.count_all = 0;
                    this.owners = [];
                    this.empty_owners = true;
                    this.cur_page = 1;
                    this.next_page = null;
                    this.prev_page = null;
                    this.count_all = 0;
                    this.last_page = 1;
                    }

                    this.$Progress.finish();
                    window.scrollTo(0, 0);
                }
                })
                .catch((error) => {
                console.log(error);
                this.empty_owners = true;
                this.$Progress.finish();
                }); 
        }
    },
}
</script>