<template>
  <div class="navbar-container">
          <nav class="navbar fixed-top navbar-expand-md">
              <div class="container">

                  <!-- APP LOGO -->
                    <router-link to="/" class="navbar-brand">
                      <!-- Replace h3 heading with an image of the logo -->
                      <img src="/images/iwander-logo-lg.png" alt="iWander Logo" />
                    </router-link>

                  <div class="navbar-search d-none d-md-block d-lg-block">
                      <autocomplete> </autocomplete>
                  </div>

                  <div class="navbar-icons ml-auto">
                      <!-- SEARCH ICON -->
                      <button class="navbar-toggler" type="button">
                          <span class="lnr lnr-magnifier"></span>
                      </button>

                      <!-- MENU ICON -->
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-links" aria-controls="#navbar-links" aria-expanded="false" aria-label="Toggle navbar links">
                          <span class="lnr lnr-menu"></span>
                      </button>
                  </div>

                  <!-- NAVBAR LINKS -->
                  <div class="collapse navbar-collapse" id="navbar-links">
                      <ul class="navbar-nav ml-auto">
                          <li class="nav-item">
                            <router-link to="/itinerariesIndex" class="nav-link">Browse</router-link>
                          </li>

                          <li class="nav-item">
                            <router-link to="/howto" class="nav-link">How To</router-link>
                          </li>

                          <li class="nav-item">
                            <router-link to="/register-account" class="nav-link" v-if="isLoggedin === false">Sign Up</router-link>
                          </li>

                          <li class="nav-item">
                            <router-link to="/sign-in" class="last-nav-link" v-if="isLoggedin === false">Sign In</router-link>
                          </li>

                          <li class="nav-item">
                            <router-link to="/my-profile" class="nav-link" v-if="isLoggedin === true">Profile</router-link>
                          </li>

                          <li class="nav-item">
                            <router-link to="/edit-profile" class="nav-link" v-if="isLoggedin === true">Settings</router-link>
                          </li>

                          <li class="nav-item">
                            <a @click="logout" class="last-nav-link" v-if="isLoggedin === true">Sign Out</a>
                          </li>
                      </ul>
                  </div>

              </div>
          </nav>
      </div>
</template>

<script>
import autocomplete from './autocomplete'

  export default{
    name: 'navbar',
    props: ['app','isLoggedIn'],
    components: {
      autocomplete
    },
    data(){
      return{
        isLoggedin: false
      }
    },
    watch: {
      isLoggedin: function(newVal, oldVal){
        immediate: true,
        this.checkIfLoggedIn();
        // console.log('prop changed: ', newVal, '| was: ', oldVal);
      }
    },
    created(){
      this.checkIfLoggedIn();
    },
    methods: {
      logout(){
        let token = localStorage.getItem('token');
        axios.get('/api/logout',{
          headers: {Authorization: "Bearer " + token}
        })
        .then(function(response){
          console.log(response);
        })
        .catch(function(error){
          console.log(error);
        });

        console.log("USER LOGGED OUT");
        localStorage.removeItem('token');
        this.checkIfLoggedIn();
        this.$router.push({name: 'home'});
      },
      checkIfLoggedIn(){
        let token = localStorage.getItem("token");
        console.log("Check if log in");
        if(token) {
          this.isLoggedin = true;
        } else {
          this.isLoggedin = false;
        }
      }
    }
  }
</script>
