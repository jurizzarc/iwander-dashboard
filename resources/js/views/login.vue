
<template>
<div class="container">
    <div class="body-content">
        <div class="row">

            <div class="col-lg-4 offset-lg-4 col-sm-12">
              <div class="col-12 auth-form-heading">
                        <h2>Sign In</h2>
                        <p>Don't have an account yet? <router-link to="/register-account">Sign Up</router-link></p>
                    </div>

                    <form v-on:submit.prevent="login">
                        <div class="row">
                            <div class="form-group col-12">
                              <label for="email">Email Address</label>
                              <input id="email" type="email" v-model="email" class="form-control" name="email" required autocomplete="email">
                              <span class="errors">{{ getErrors('email') }}</span>
                            </div>

                            <div class="col-12">
                              <label for="password">Password</label>
                              <input id="password" v-model="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                              <span class="errors">{{ getPasswordError() }}</span>
                            </div>

                            <div class="form-msg col-12">
                                <a href="#">Forgot Password?</a>
                            </div>

                            <div class="form-button col-12">
                                <button class="btn btn-primary" type="submit">Sign In</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>

export default {
    name: 'login',
    props: ['app'],
    components: {

    },
    data() {
        return {
            email: "",
            password: "",
            errors: []
        }
    },
    // mounted(){
    //   if (localStorage.getItem("token") !== null){
    //     this.$router.replace({name: 'home'});
    //     console.log("USER LOGGED IN");
    //   }
    // },
    methods: {
        login() {
            let app = this;
            axios.post('/api/login', {
                    email: app.email,
                    password: app.password
                })
                .then(function(response) {
                    console.log(response.data);
                    app.name = response.data.name;
                    app.email = response.data.email;
                    localStorage.setItem("token", response.data.token);

                    //go to home
                    app.$router.push({
                        name: 'home'
                    });
                    location.reload();
                })
                .catch(function(error) {
                  console.log(error.response.data.errors);
                  if(error.response.data.errors === "Unauthorised"){
                    app.errors = error.response.data.errors;
                  }
                    app.errors = error.response.data.errors;
                });
        },
        getErrors(field){
          if(this.errors[field]){
            return this.errors[field][0];
          }
        },
        getPasswordError(){
          if(this.errors === "Unauthorised"){
            return "Password do not match. Try again!";
          }
        }


    },
    computed:{

    },
    getError: function(field) {

    }

}
</script>

<style scoped>


</style>
