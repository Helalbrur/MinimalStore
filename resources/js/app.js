import Vue from 'vue';
require('./bootstrap');

import routes from './router';
// Import helper class
import User from './helpers/User';
window.User = User
import Accessible from './helpers/Accessible';
window.Accessible = Accessible

import {
    Button,
    HasError,
    AlertError,
    AlertErrors,
    AlertSuccess
  } from 'vform/src/components/bootstrap5';
  Vue.component(HasError.name, HasError)
//header
let navbar= require('./components/navbar.vue').default;
// Import Notification class
import Notification from './helpers/Notification';
window.Notification = Notification

//Swee alert 2 start
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});
window.Toast = Toast;
//Sweet alert 2 end
// // Vue Router Nagivation Guard

routes.beforeEach((to, from, next) => {
    console.log(to.name)
    if (to.name !== 'login' && !User.loggedIn()) next({ name: 'login' })
    else if (to.name === 'login' && User.loggedIn()) next({ name: 'home' })
    else if (to.name === 'logout' && !User.loggedIn()) next({ name: 'login' })
    else if (!Accessible.employeeAccessableRoute.includes(to.name) && User.getUserRole()==='Employee') {
      Toast.fire({
          icon: 'error',
          title: 'This route is not allowed to Employee'
      });
      //next(routes.back())
    } 
    else if (!Accessible.storeExecutiveAccessableRoute.includes(to.name) && User.getUserRole()==='Store Executive'){
      Toast.fire({
          icon: 'error',
          title: 'This route is not allowed to Store Executive'
      });
      //next(routes.back())
    }
    else next()
})
window.Reload = new Vue();
const app = new Vue({
    el: '#app',
    router : routes,
    components: {
        navbar,
        HasError
    }
});
