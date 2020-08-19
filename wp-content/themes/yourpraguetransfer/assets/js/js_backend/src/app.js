import Vue from 'vue';
import Inzeraty from "./templates/Inzeraty.vue";
import Obrazky from "./templates/Obrazky.vue";



var app = $(".app");
if(app.length > 0){
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
