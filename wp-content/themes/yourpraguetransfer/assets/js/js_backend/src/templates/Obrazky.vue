<template>
    <form>
        <div class="container">
            <h3 class="mt-4 mb-0">Editace obrázků</h3>
            <p class="mb-3">Editujte obrázky vztažené k inzerátu</p>
            <div :class="{'imagesBox': true, 'loading': isLoading}">

                <div v-if="obrazky.length > 0" :class="{imageItem: true, mainImageItem: (obrazek.db_front.value==1)}" v-for="obrazek in obrazky" v-bind:key="obrazek.db_id.value">
                    <span class="removeImage" @click="removeItem(obrazek.db_id.value)"><i class="fas fa-times"></i> </span>
                    <figure class="imgWrap">
                        <img :src="home_url + obrazek.db_url.value">
                    </figure>
                    <input type="text" v-model="obrazek.db_titulek.value" v-on:change="setParam('db_titulek', obrazek.db_id.value)" class="caption" ref="input">
                    <input type="text" v-model="obrazek.db_popisek.value" v-on:change="setParam('db_popisek', obrazek.db_id.value)" class="description" ref="input">
                    <a class="editLink" :href="edit_link + '&id=' + obrazek.db_id.value"><i class="fas fa-edit"></i></a>
                    <div :class="{checker:true, checked: (obrazek.db_front.value==1)}" @click="check(obrazek.db_id.value)"></div>
                </div>
                <div v-if="obrazky.length==0" class="empty-yet">
                    <span>Zatím žádné obrázky</span>
                </div>

            </div>
            <file-pond
                    name="files"
                    allow-multiple="true"
                    max-files="10"
                    label-idle="<i class='far fa-image'></i> Nahrajte nový obrázek (maximálně 10 v jednu chvíli) <span class='filepond--label-action'> Procházet </span>"
                    accepted-file-types="image/jpeg, image/png"
                    ref="pond"
                    :server="serverConfig()"
                    label-file-processing="Soubor je zpracováván"
                    label-file-processing-complete="Nahrávání dokončeno"
                    label-file-processing-aborted="Nahrávání zrušeno"
                    label-file-processing-error="Chyba při nahrávání"
                    label-tap-to-cancel="Klikněte pro zrušení"
                    label-tap-to-retry="Klikněte pro opakování"
                    label-tap-to-undo="Klikněte pro vrácení"
                    label-button-abort-item-processing="Zrušit"
                    label-button-process-item="Nahrát"
                    allow-revert="false"
            />
        </div>
    </form>
</template>

<script>
    import axios from 'axios';
    import VueAxios from 'vue-axios';
    import vueFilePond from 'vue-filepond';

    const FilePond = vueFilePond();


    export default {
        name: "Obrazky",
        components: {
            FilePond
        },
        created: function(){
            this.fetchData();
        },
        data: function () {
            return {
                obrazky: [],
                isLoading: true
            }
        },
        props: {
            'inzerat_id' : {
                default: 5
            },
            'api_link' : {
                default: '/realsys/wp-admin/admin-ajax.php'
            },
            'sub_params': {
                default: function (){
                    return {
                        action: 'getInzeratObrazky'
                    }
                }
            },
            'edit_link': {
                default: '/realsys/wp-admin/admin.php?page=realsys&controller=obrazek&action=edit'
            },
            'loading_delay':{
                default: 1500
            },
            'home_url' : {
                default:  'http://localhost/realsys'
            }
        },
        methods: {
            removeItem : function (key) {
                var element = $('<div></div>');
                confirmPopup(element, "confirmed");
                var _this = this;
                element.on("confirmed", function (e) {
                    _this.obrazky = _this.obrazky.filter(function (value, index) {
                        if(key == value.db_id.value){
                            _this.removePic(key);
                            return false;
                        }
                        return true;
                    });
                });


            },
            check : function (id) {
                var _this = this;
                this.obrazky.forEach(function (value, index) {
                    if(value.db_id.value == id){
                        value.db_front.value = 1;
                        _this.updateParam(id,"db_front", 1);
                    }else{
                        value.db_front.value = 0;
                    }
                })
            },
            setParam(param, id){
                var toupdate = [];
                this.obrazky.forEach(function (val) {
                    if(val.db_id.value == id){
                        toupdate.push(val);
                    }
                });
                toupdate = toupdate.shift();
                var newValue = toupdate[param].value;
                this.updateParam(id, param, newValue);
                this.$refs.input.forEach(function (obj) {
                   $(obj).blur();
                });
            },
            updateParam: function(id, param, newValue){
                this.isLoading = true;
                var postUrl = this.api_link;
                var params = new URLSearchParams();
                params.append('id', id);
                params.append('param', param);
                params.append('new_value', newValue);
                params.append('action', "setParam");
                var _this = this;

                axios.post(postUrl, params).then(function (response) {
                    if (response){
                        if(typeof response.data == "object"){
                            if(response.data.status = 1){
                                _this.isLoading = false;
                            }else{
                                console.error("Status is fail");
                            }
                        }else{
                            console.error("Data is not type of Object");
                        }
                    }
                }).catch(function (error) {
                    console.error(error);
                });

            },
            handleFileUploaded(response){
                if(response.length > 0){
                    response = JSON.parse(response);
                    if(response.status == 1){
                        this.obrazky.push({
                            'db_id' : {value: response.db_id, type:"number"},
                            'db_url' : {value: response.default_url, type: "string"},
                            'db_titulek' : {value: response.universal_name, type: "string"},
                            'db_popisek' : {value:"", type:"string"},
                            'db_front': {value:0, type:"bool"}
                        });
                    }else{
                        alert("Došlo k chybě při vytváření obrázků");
                    }
                }
            },
            uploadSubParams(formData){
                formData.append('action', 'upload');
                formData.append('id', this.inzerat_id);
                return formData;
            },
            serverConfig: function () {
                return {
                    process: {
                        url: this.api_link,
                        method: 'POST',
                        withCredentials: false,
                        headers: {},
                        timeout: 7000,
                        onload: this.handleFileUploaded,
                        ondata: this.uploadSubParams
                    }
                };
            },
            fetchData: function () {
                this.obrazky = [];
                var getUrl = this.api_link;
                var _this = this;

                if(getUrl.search("\\?") !== -1){
                    getUrl += this.encodeQueryData(this.sub_params);
                }else{
                    getUrl += "?" + this.encodeQueryData(this.sub_params);
                }

                getUrl+= '&id=' + this.inzerat_id;

                setTimeout(function () {
                    axios.get(getUrl).then(function (response) {
                        if (response){
                            _this.isLoading = false;
                            if(typeof response.data == "object"){
                                if(response.data.status = 1 && response.data.hasOwnProperty('obrazky')){
                                    for(var i in response.data.obrazky){
                                        _this.obrazky.push(response.data.obrazky[i]);
                                    }

                                }else{
                                    console.error("Bad data structure - missing obrazky or status is fail");
                                }
                            }else{
                                console.error("Data is not type of Object");
                            }
                        }
                    }).catch(function (error) {
                        console.error(error);
                    });
                },this.loading_delay);

            },
            encodeQueryData: function(data) {
                const ret = [];
                for (let d in data)
                    ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
                return ret.join('&');
            },
            removePic: function (id) {
                this.isLoading = true;
                var postUrl = this.api_link;
                var params = new URLSearchParams();
                params.append('id', id);
                params.append('action', "removePic");
                var _this = this;

                axios.post(postUrl, params).then(function (response) {
                    if (response){

                        if(typeof response.data == "object"){
                            if(response.data.status = 1){
                                _this.isLoading = false;
                            }else{
                                console.error("Status is fail");
                            }
                        }else{
                            console.error("Data is not type of Object");
                        }
                    }
                }).catch(function (error) {
                    console.error(error);
                });
            }
        }

    }
</script>

<style scoped lang="less">

    @website: "http://localhost/realsys/";


    .loading{
        position: relative;
    }
    .loading:after{
        content: '';
        background-image: url("@{website}wp-content/themes/realsys/assets/images/images_backend/loading.gif");
        position: absolute;
        top: 0;
        left: 0px;
        right: 0px;
        bottom: 0px;
        background-color: rgba(255,255,255,0.5);
        background-position: center;
        background-size: unset;
        background-repeat: no-repeat;
    }

    .imagesBox{
        display: flex;
        flex-wrap: wrap;
        padding: 20px;
        background-color: #fcfcfc;
        margin: 20px 0px;
        border: 1px solid #dddddd;
        max-height: 780px;
        overflow-y: scroll;
    }

    .removeImage{
        position: absolute;
        background-color: red;
        border-radius: 50%;
        height: 20px;
        width: 20px;
        text-align: center;
        color: white;
        top: -10px;
        right: -10px;
        font-size: 12px;
        line-height: 20px;
        cursor: pointer;
    }

    .removeImage:hover{
        background-color: darkred;
    }

    .imageItem{
        position: relative;
        display: flex;
        flex-direction: column;
        flex-basis: calc((100% - 80px) / 4);
        max-width: calc((100% - 80px) / 4);
        min-width: calc((100% - 80px) / 4);
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #d5d5d5;
        margin: 10px;
    }

    .mainImageItem{
        background-color: #33b5e5;
        color: white;
        border: none;
    }

    .mainImageItem input{
        color: white;
    }

    .imageItem input{
        background-color: transparent;
        border: none;
        text-align: center;
        width: 100%;
        box-shadow: none;
        padding: 0px;
        box-sizing: border-box;
    }

    .imageItem input:focus{
        border: 1px solid #d1d1d1;
        background-color: white;
        color: #333333;
    }

    .imgWrap{
        height: 180px;
        width: 100%;
        margin-bottom: 4px;
    }

    .imgWrap img{
        object-fit: cover;
        object-position: center;
        width: 100%;
        height: 100%;
    }

    .caption{
        font-size: 18px;
        font-weight: bold;
    }

    .description {
        font-size: 14px;
        font-style: italic;
    }

    .checker{
        position: absolute;
        top: 20px;
        left: 20px;
        height: 20px;
        width: 20px;
        border-radius: 50%;
        border: 3px solid #33b5e5;
        cursor: pointer;
    }

    .checker.checked{
        background-color: #33b5e5;
    }

    .editLink{
        color: #666666;
        position: absolute;
        bottom: 3px;
        left: 6px;
        font-size: 10px;
    }

    .imageItem.mainImageItem .editLink{
        color: white;
    }

    .empty-yet{
        min-height: 300px;
        text-align: center;
        color: #000;

    }

    .empty-yet {
        display: flex;
        justify-content: center;
        margin-top: 35px;
        font-size: 25px;
        width: 100%;
    }


</style>