
import Vue from 'vue'

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import routes from './routes.js'
const router = new VueRouter({
  mode: 'history',
  routes,
});

//if user tries to enter routes that needs authentication
//redirect to sign in
router.beforeEach((to, from, next) => {
  const authRequired = to.matched.some((route) => route.meta.authRequired)
  if(authRequired){
      if(localStorage.getItem("token") == null){
        next('/sign-in');
      }
    next();
  }
  next();
})

import BootstrapVue from 'bootstrap-vue' //Importing
Vue.use(BootstrapVue) // Telling Vue to use this in whole application

//import icons
import VueJamIcons from 'vue-jam-icons'
Vue.use(VueJamIcons)

import App from './App.vue';

new Vue({
  router,
  render: h=> h(App)
}).$mount('#app')
