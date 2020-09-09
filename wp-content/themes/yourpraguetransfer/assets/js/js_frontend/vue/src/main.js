import Vue from 'vue';
import SearchComponent from "./components/SearchComponent.vue";


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