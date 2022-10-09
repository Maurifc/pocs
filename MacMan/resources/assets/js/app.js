require('./bootstrap');
import Alert from './components/Alert.vue';
window.Vue = require('vue');
import VueRouter from 'vue-router';
import Acl from 'vue-acl';
import routes from './routes';

//Vue Router
Vue.use(VueRouter);
const router = new VueRouter({
  routes,
  linkActiveClass: 'active'
})

//Vue Acl
Vue.use(Acl, {router, init: 'any'})

const app = new Vue({
    el: '#app',
    data: {
      teste: 'texto'
    },
    components: {
      Alert
    },
    router,
    methods: {
      logout() {
        let self = this;

        axios.post('/auth/logout')
        .then(function (response) {
          //Desloga do Vue
          self.$access('any');

          //Redireciona para form de login
          self.$router.push('/');
        });
      },
      checkAuth(){
        let self = this;
        axios.get('/auth/status')
        .then(function (response) {
          if (response.data.logado === true) {
            self.$access('admin');
            self.$router.push('/computadores');
          }
        })
        .catch(function (error) {
          console.log(error.body);
        })
      }
    },
    created() {
      this.checkAuth();
    }
});
