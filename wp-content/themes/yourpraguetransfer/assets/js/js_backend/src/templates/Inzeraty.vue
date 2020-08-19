<template>
    <div class="container-fluid pr-5">
        <!-- Material input -->
        <div :class="{waitingForData: !this.dataReady() || this.appWorking, mainApp: true}">
            <!-- Material input -->
            <div class="row justify-content-sm-end">
                <div class="col-sm-3 currentlySearched" v-if="this.currentSearchTerm.length > 0">
                    <strong>Vyhledávaný výraz:</strong> {{this.currentSearchTerm}}
                    <i class="far fa-times-circle" @click="resetServerSearch()"></i>
                </div>
                <form class="md-form input-group mb-3 col-sm-4" @submit.prevent="findOnServer()">
                    <input type="text" id="search_term" class="form-control" @keyup="search($event)" placeholder="Hledaný výraz">
                    <div class="input-group-append">
                        <button class="btn btn-md btn-secondary m-0 px-3" type="submit" id="MaterialButton-addon2" @click.prevent="findOnServer()">Dohledat na serveru</button>
                    </div>
                </form>
            </div>
            <div class="fshr-filterBar" v-if="filters.length > 0">
                <div class="grd-row">
                    <div v-for="(filter,index) in filters" class="grd-col">
                        <select :name="index" @change="setFilter(index, $event)" class="">
                            <option v-for="val in filter.values" :value="val.val">{{val.nazev}} </option>
                        </select>

                    </div>
                </div>
            </div>
            <table id="dt-material-checkbox" class="table table-striped fshr-dynamicDataTable" cellspacing="0" width="100%" v-if="radkyComputed.length > 0">
                <thead>
                <tr>
                    <th v-for="th in hlavickyComputed" class="sorting">
                        <span v-if="th.value">{{th.value}}</span>
                        <div class="sortingHandle" v-if="th.value">
                            <span :class="{'active': isAsc(th.key), 'fas': true, 'fa-sort-up' : true}" :data-sort-param="th.key" data-sort-order="asc" @click="sortBy($event)">
                            </span>
                            <span :class="{'active': isDesc(th.key), 'fas': true, 'fa-sort-down' : true}" :data-sort-param="th.key" data-sort-order="desc" @click="sortBy($event)">
                            </span>
                        </div>
                    </th>
                    <th>Upravit</th>
                    <th>Smazat</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="radek in radkyComputed">
                    <td v-for="bunka in radek" class="align-middle">

                        <img :src="home_url + bunka.value" v-if="bunka.type=='image'" class="img-fluid img-thumbnail datatable-img">
                        <div class="fas fa-check" v-else-if="bunka.type=='boolean' && bunka.value"></div>
                        <div class="fas fa-times" v-else-if="bunka.type=='boolean' && !bunka.value"></div>
                        <div class="fshr-icon fshr-icon--plus" v-else-if="bunka.type=='ajax_get_subinfo'"></div>
                        <span v-else-if="bunka.type=='date'">{{timeConverter(bunka.value)}}</span>
                        <a target="_blank" :href="bunka.value" v-else-if="bunka.type=='pdf_url' && bunka.value!=='(hodnota nedostupná)' && bunka.value!==''" class="btn btn-small btn-blue"><i class="fas fa-check mr-2"></i>PDF faktura</a>
                        <span v-else>{{bunka.value}}</span>
                    </td>
                    <td>
                        <a :href="editLink(radek.db_id.value)" class="btn btn-info px-3 btn-rounded m-0"><i class="fas fa-edit" aria-hidden="true"></i></a>
                    </td>
                    <td>
                        <a @click.prevent="removeItem(radek, $event)" class="btn btn-danger px-3 btn-rounded m-0"><i class="fas fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>

                    <th
                            v-for="(th,index) in hlavickyComputed"
                            v-on:click="sortBy($event)"
                            :data-sort-param="index">
                        <span v-if="th.value">
                            {{th.value}}
                        </span>
                    </th>
                    <th>
                        Upravit
                    </th>
                    <th>
                        Smazat
                    </th>
                </tr>
                </tfoot>
            </table>
            <div v-else class="no-records">Žádné záznamy</div>
            <nav aria-label="Page navigation example" v-if="showPagination()">
                <ul class="pagination pg-blue">
                    <li class="page-item" @click="setPage(1)">
                        <a class="page-link">První</a>
                    </li>
                    <li
                            v-for="paging in filterPaginationNumbers()"
                            :class="{'page-item': true, 'active': (page == paging)}"
                            @click="setPage(paging)"
                    >
                        <a class="page-link">{{paging}}</a>
                    </li>

                    <li class="page-item" @click="setPage(showPagination())">
                        <a class="page-link">Poslední</a></li>
                </ul>
            </nav>

        </div>
    </div>
</template>


<script>
    import axios from 'axios';
    import VueAxios from 'vue-axios';



    export default {
        name: "Inzeraty",
        props: {
            'api_url': {default:'/realsys/appdata.json'},
            'model':{default:'inzeratyClass'},
            'item_controller':{default:'inzeratyController'},
            'allowed_columns':{default:{}},
            'base_url' : {default: '/realsys/wp-admin/admin.php?page=realsys'},
            'sub_params': {default: '?'},
            'home_url' : {default:  'http://localhost/realsys'}

            },
        created: function(){
            this.fetchData();
        },
        data: function () {
            return {
                appData : null,
                sortParam: "",
                sortOrder: "",
                searchParam: "",
                page: 1,
                countPage: 4,
                maxPageCount: 5,
                // přesunout filtery do atributů
                filters: {
                    db_id: {
                        preklad : "Platnost",
                        values : [
                            { nazev: "Pouze platné", val: 1 },
                            { nazev: "Neplatné", val: 0}
                        ]
                    },
                    db_nazev: {
                        preklad : "Obrázek",
                        values : [
                            { nazev: "Velký", val: 1 },
                            { nazev: "Malý", val: 0}
                        ]
                    }
                },
                filters_val: {}, // todo vyřešit filtery
                appWorking: false,
                stylesUrl: process.env.HOME_URL,
                currentSearchTerm: ""


            }
        },
        methods: {
            sortBy: function (event) {
                this.sortOrder = $(event.target).data("sort-order");
                this.sortParam = $(event.target).data("sort-param");
            },
            search: function (event) {
                this.searchParam = $(event.target).val();
            },
            isAsc: function (index) {
                return ((this.sortOrder == "asc") && this.sortParam==index) ? true : false;
            },
            isDesc: function (index) {
                return ((this.sortOrder == "desc") && this.sortParam==index) ? true : false;
            },
            fetchData: function(){

                /* TODO dodělat co když žádné výsledky nenajde, potom padá */
                var _this = this;
                this.appData = null;
                var getUrl = this.api_url + this.sub_params + "&model=" + this.model + "&countPage=" + _this.countPage + "&page=" + _this.page;

                if(this.currentSearchTerm.length > 0){
                    getUrl += "&search=" + this.currentSearchTerm;
                }

                if(Object.keys(this.filters_val).length > 0){
                    var result = "&";
                    for(var item in this.filters_val){
                        result += "&" + item + "=" + this.filters_val[item];
                    }
                    getUrl += result;
                }

                this.searchParam = "";
                setTimeout(function () {
                    axios.get(getUrl).then(function (response) {
                        if (response)
                            if(typeof response.data == "object"){
                                if(response.data.hasOwnProperty("radky") && response.data.radky.length>0 && response.data.radky[0].hasOwnProperty("db_id")){
                                    _this.appData = response.data;
                                }else{
                                    _this.appData = response.data;
                                    console.error("Bad data structure - missing radky, or db_id");
                                }
                            }else{
                                console.error("Data is not type of Object");
                            }
                    }).catch(function (error) {
                        console.error(error);
                    });
                }, 500);
            },
            dataReady: function () {
                return (this.appData !== null) && (typeof this.appData == "object");
            },
            showPagination: function () {
                if(this.dataReady()){
                    var totalRecords = this.appData.totalRecords;
                    var recordsPerPage = this.countPage;
                    var pageNumber = this.page;
                    var currentRecordsCount = this.appData.radky.length;
                    var totalPages = Math.ceil(totalRecords / recordsPerPage);
                    if(totalPages > 1){
                        return totalPages;
                    }
                }
                return false;
            },
            filterPaginationNumbers: function () {
                var pagesCount = this.showPagination();
                if (this.maxPageCount > pagesCount) this.maxPageCount = pagesCount;
                var start = this.page - Math.floor(this.maxPageCount / 2);
                start = Math.max(start, 1);
                start = Math.min(start, 1 + pagesCount - this.maxPageCount);
                // TODO tady předělat do starého JS a nebo použít babel
                return Array.from({length: this.maxPageCount}, (el, i) => start + i);
            },
            setPage: function (page) {
                if(page !== this.page){
                    this.page = page;
                    this.fetchData();
                }
            },
            findOnServer: function(){
                this.page = 1;
                $("#search_term").val("");
                this.currentSearchTerm = this.searchParam;
                this.fetchData();

            },
            setFilter: function (index, event) {
                this.filters_val[index] = $(event.target).val();
                this.fetchData();
            },
            removeItem: function (item, event) {
                var removeApiUrl = this.api_url + "?action=removeElement&model=" + this.model + "&id=" + item.db_id.value;
                var _this = this;

                confirmPopup($(event.target), function () {
                    _this.appWorking = true;
                    axios.get(removeApiUrl).then(function (response) {
                        if(typeof response.data == "object" && response.data.hasOwnProperty("status") && response.data.hasOwnProperty("message")){
                            if(response.data.status === 1){
                                var db_id = item.db_id.value;
                                var newarr = _this.appData.radky.filter(function (el, index, arr) {
                                    if(el.db_id.value !== db_id) return true;
                                });
                                _this.appData.radky = newarr;
                                _this.appWorking = false;
                            }else{
                                console.error("Operation failed");
                                alert("Chyba");
                            }
                        }else{
                            console.error("Response is not JSON");
                            alert("Chyba");
                        }
                    });
                });

            },
            editLink: function (id) {
                return this.base_url + '&controller=' + this.item_controller + '&action=edit&id=' + id;
            },
            resetServerSearch: function(){
                this.currentSearchTerm = "";
                this.searchParam = "";
                $("#search_term").val("");
                this.fetchData();
            },
            timeConverter: function(UNIX_timestamp){
                console.log(UNIX_timestamp);
                var a = new Date(UNIX_timestamp * 1000);
                //var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                var year = a.getFullYear();
                var month = a.getMonth()+1;
                var date = a.getDate();
                var min = a.getMinutes() < 10 ? '0' + a.getMinutes() : a.getMinutes();
                var sec = a.getSeconds() < 10 ? '0' + a.getSeconds() : a.getSeconds();
                var hour = a.getHours() < 10 ? '0' + a.getHours() : a.getHours();
                var time = date + '.' + month + '.' + year + ' - ' + hour + ':' + min + ':' + sec ;
                console.log(time);
                return time;
            }

        },
        computed:{
            radkyComputed : function () {
                var sortParam = this.sortParam;
                var sortOrder = this.sortOrder;
                var searchTerm = this.searchParam;

                if(!this.dataReady()) return [];


                var newarray = this.appData.radky;
                newarray = newarray.filter(function (value, index, arr) {
                    for(var val in value){
                        var hodnota = value[val].value;

                        if(typeof hodnota == "number" || typeof hodnota == "boolean"){
                            hodnota = hodnota.toString();
                        }
                        if(hodnota.toUpperCase().search(searchTerm.toUpperCase())>=0){
                            return true;
                        }
                    }
                    return false;
                });

                if(sortParam.length == 0){
                    return newarray;
                }
                return newarray.sort(
                    function (a, b) {
                        if(a[sortParam].value > b[sortParam].value){
                            if(sortOrder == "asc"){
                                return -1;
                            }
                            return 1;
                        }
                        if(a[sortParam].value < b[sortParam].value){
                            if(sortOrder == "desc"){
                                return 1;
                            }
                            return -1;
                        }
                        return 0;
                    }
                )
            },
            hlavickyComputed :function () {
                if(!this.dataReady()) {
                    return [];
                }
                var prvniRadek = this.appData.radky[0];
                var hlavicka = [];
                for(var bunka in prvniRadek){
                    if(this.appData.prekladHlavicek.hasOwnProperty(bunka)){
                        hlavicka.push({'key' : bunka, 'value' : this.appData.prekladHlavicek[bunka]});
                    }else{
                        hlavicka.push({'key': bunka, 'value': bunka});
                    }
                }

                return hlavicka;
            }
        }
    }
</script>

<style scoped lang="less">

    @website: "http://localhost/realsys/";

    p {
        font-size: 35px;
    }

    .sortingHandle > *{
        cursor: pointer;
        position: absolute;
    }

    .sortingHandle .fa-sort-down{
        left: 8px
    }
    .sortingHandle{
        color: grey;
        display: inline-flex;
        position: relative;
        width: 10px;
        height: 11px;
        flex-direction: column;
        font-size: 12px;
    }
    .sortingHandle .active{
        color: red;
    }

    .sortingHandle .fas:before{
        line-height: 5px;
    }
    .waitingForData{
        position: relative;
    }
    .waitingForData:after{
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

    .fshr-filterBar{
        background-color: #f4f4f4;
        padding: 20px;
    }

    .mainApp{
        padding: 0px 15px;
        border: 1px solid #dee2e6;
    }

    .currentlySearched{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .currentlySearched i{
        cursor: pointer;
    }

    .datatable-img{
        width: 70px;
    }

    .no-records{
        padding: 15px;
        text-align: center;
        font-weight: bold;
        background-color: whitesmoke;
        margin-bottom: 20px;
    }

</style>