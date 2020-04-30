
<template>
    <div class="container">
        <div class="body-content">
            <div class="row">
                <div class="col-lg-4 offset-lg-4 col-sm-12">
                    <div class="auth-form-heading">
                        <h2>Sign Up</h2>
                        <p>Already have an account? <router-link to="/sign-in">Sign In</router-link></p>
                    </div>

                    <form v-on:submit.prevent="register">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="name">Full Name</label>
                                <input id="name" type="text" v-model="name" class="form-control" name="name" autocomplete="name">
                                <span class="errors">{{ getErrors('name') }}</span>
                            </div>

                            <div class="form-group col-12">
                                <label for="email">Email Address</label>
                                <input id="email" type="email" v-model="email" class="form-control" name="email"  autocomplete="email">
                                <span class="errors">{{ getErrors('email') }}</span>
                            </div>

                            <div class="form-group col-12">
                                <label for="password">Password</label>
                                <input id="password" type="password" v-model="password" class="form-control" name="password"  autocomplete="new-password">
                                <span class="errors">{{ getErrors('password') }}</span>
                            </div>

                            <div class="form-group col-12">
                                <label for="password_confirmation">Confirm password</label>
                                <input id="password_confirmation" v-model="password_confirmation" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                <span class="errors">{{ getErrors('passwordConfirmation') }}</span>
                            </div>

                            <div class="form-button col-12">
                                <button type="submit" class="btn btn-primary">
                                    Sign Up
                                </button>
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
    name: 'register',
    props: ['app'],
    components: {

    },
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            errors: []
        }
    },
    methods: {
        register() {
            let app = this;
            axios.post('/api/register', {
                    name: app.name,
                    email: app.email,
                    password: app.password,
                    password_confirmation: app.password_confirmation
                })
                .then(function(response) {
                    console.log(response.data);
                    app.name = response.data.name;
                    app.email = response.data.email;
                    localStorage.setItem("token", response.data.token);
                    //go to home page
                    app.$router.replace({
                        name: 'home'
                    });
                    location.reload();
                })
                .catch(function(error) {
                  app.errors = error.response.data.errors;
                    console.log(error);
                });
        },
        getErrors(field){
          if(this.errors[field]){
            return this.errors[field][0];
          }
        },
    }
}
</script>

<style scoped>


</style>
