import Vue from 'vue';
import SearchComponent from "./components/SearchComponent.vue";
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);
var VueScrollTo = require('vue-scrollto');
Vue.use(VueScrollTo);

const moment = require('moment');
require('moment/locale/cs');
Vue.use(require('vue-moment'), {
  moment
});


var appexists = document.querySelector(".app");
if(appexists){
  var app = new Vue({
    el: ".app",
    data: {
      test: "tetss"
    },
    components :{
      SearchComponent
    }
  });
  window.app = app;
}