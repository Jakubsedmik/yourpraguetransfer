import Vue from 'vue';
import Inzeraty from "./components/Inzeraty.vue";
import Obrazky from "./components/Obrazky.vue";
import Zonecreator from "./components/Zonecreator.vue";

var appexists = document.querySelector(".app");
if(appexists){
  var app = new Vue({
    el: ".app",
    data: {
      test: "tetss"
    },
    components :{
      Inzeraty, Obrazky, Zonecreator
    }
  });
  window.app = app;

}
