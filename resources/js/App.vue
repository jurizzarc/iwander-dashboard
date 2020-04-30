<template>
  <div>
    <navbar :app="this" v-if="!$route.meta.hideNavigation"></navbar>
    <!-- <itinerarybuilderNav v-if="$route.meta.showItineraryBuilder" @proceed="proceed()"></itinerarybuilderNav> -->

      <router-view :user="this.user"> </router-view>
    <footerbar v-if="!$route.meta.hideFooter"></footerbar>
  </div>
</template>

<script>
import navbar from './components/navbar'
import footerbar from './components/footerbar'
import itinerarybuilderNav from './components/itinerarybuilderNav'

  export default{
    name: 'app',
    components: {
      navbar, footerbar, itinerarybuilderNav
    },
    data(){
      return{
        user: "",
      }
    },
    created(){
      this.init();
    },
    methods: {
      init(){
        let token = localStorage.getItem("token");
        axios.get('/api/user',{
          headers: { Authorization: "Bearer " + token }
        })
        .then(response => {
          console.log('USER DEETS',response.data.user);
          this.user = response.data.user;
          console.log(this.user.id);
        })
        .catch(function(error){
          console.log(error);
        });
      }
    }
  }
</script>

<style>
</style>
