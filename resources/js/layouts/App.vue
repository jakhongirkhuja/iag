<template>
    <div class="container-fluid">
            <Header/>
            <vue-progress-bar></vue-progress-bar>
            <router-view></router-view>
          
    </div>
</template>
<script>
  import Header from './Header';
  export default {
    components: {
      Header
    }
  }
</script>