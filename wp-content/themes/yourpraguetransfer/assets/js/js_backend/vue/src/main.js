import Vue from 'vue';
import Inzeraty from "./components/Inzeraty.vue";
import Obrazky from "./components/Obrazky.vue";


var appexists = document.querySelector(".app");
if(appexists){
  var app = new Vue({
    el: ".app",
    data: {
      test: "tetss"
    },
    components :{
      Inzeraty, Obrazky
    }
  });
  window.app = app;
}
