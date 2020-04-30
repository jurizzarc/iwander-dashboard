<template>
    <div class="container">
        <div class="row">

            <div class="col-12">
                <div class="row">

                    <div class="col-lg-3 col-md-3 filters-col d-none d-md-block d-lg-block">
                        <div class="filters-block">
                            <h6>Categories</h6>

                            <ul class="list-group filter-selection">
                                <div v-if="showLessCategories">
                                    <li class="list-group-item" v-for="category in LessCategories">
                                        <input type="checkbox" id="categoryCheckbox" :value="category.id" v-model="categoryValues">
                                        <label for="categoryCheckbox">{{category.name}}</label>
                                    </li>
                                </div>
                                <div v-else>
                                    <li class="list-group-item" v-for="category in MoreCategories">
                                        <input type="checkbox" id="categoryCheckbox" :value="category.id" v-model="categoryValues">
                                        <label for="categoryCheckbox">{{category.name}}</label>
                                    </li>
                                </div>
                                <a v-if="showLessCategories" @click="showLessCategories = false">Show More</a>
                                <a v-else @click="showLessCategories = true">Show Less</a>
                            </ul>
                        </div>

                        <div class="filters-block">
                            <h6>Other</h6>

                            <ul class="list-group filter-selection">
                                <div v-if="showLessKeywords">
                                    <li class="list-group-item" v-for="keyword in LessKeywords">
                                        <input type="checkbox" id="keywordsCheckbox" :value="keyword.id" v-model="keywordsValues">
                                        <label for="keywordsCheckbox">{{keyword.name}}</label>
                                    </li>
                                </div>
                                <div v-else>
                                    <li class="list-group-item" v-for="keyword in MoreKeywords">
                                        <input type="checkbox" id="keywordsCheckbox" :value="keyword.id" v-model="keywordsValues">
                                        <label for="keywordsCheckbox">{{keyword.name}}</label>
                                    </li>
                                </div>
                                <a v-if="showLessKeywords" @click="showLessKeywords = false">Show More</a>
                                <a v-else @click="showLessKeywords = true">Show Less</a>
                            </ul>
                        </div>

                        <div class="filters-button">
                            <button type="button" class="btn-secondary-sm" @click="filter">Apply</button>
                        </div>
                    </div>

                    <div class="col-lg-8 offset-lg-1 col-md-8 offset-md-1">
                        <div class="row items-index">

                            <div class="col-12">
                                <div class="card-c" v-for="result in uniqueAttractions" :key="result.id">
                                    <div class="card-c-img">
                                        <img v-if="result.details.image === 'default-image.png'" :src="publicPath + result.details.image" />
                                        <img v-else :src="storagePath + result.details.image" />
                                    </div>

                                    <div class="card-c-body">
                                        <router-link :to="{ name: 'attraction', params: {att_id: result.id} }" target="_blank">
                                            <h6>{{result.name}}</h6>
                                        </router-link>
                                        <p class="address">{{result.addresses.address1}}, {{result.addresses.city.name}}, {{result.addresses.city.districts.name}}</p>
                                        <span class="card-c-button">
                                            <a class="add" @click="showModal(result.id)" id="show_modal">
                                                Add to Itinerary
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="items-index-button">
                                <button class="btn btn-primary" @click="loadMore">Show More</button>
                            </div>

                            <addEvent v-if="show_modal" @close="show_modal = false" :attraction_id="this.att_id" :itinerary="this.itinerary"> </addEvent>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import addEvent from '../components/addEvent'

export default {
    name: 'attractions',
    props: ['app', 'itinerary', 'sort'],
    components: {
        addEvent
    },
    created() {
        this.getAttractions();
        this.getCategories();
        this.getKeywords();
    },
    data() {
        return {
            results: [],
            show_modal: false,
            att_id: '',
            keywords: '',
            keywordsValues: [],
            categories: '',
            categoryValues: [],
            attractions: [],
            sortBy: '',
            showLessCategories: true,
            showLessKeywords: true,
            publicPath: '/images/',
            storagePath: '../storage/images/'
        }
    },
    methods: {
        getAttractions() {
            let app = this;
            // console.log('Attraction - get cities:', app.itinerary.destination);
            axios.get(`/api/getAttractions/${app.itinerary.destination}`)
                .then(response => {
                    app.attractions = response.data.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        showModal(id) {
            this.show_modal = true;
            //attraction id
            this.att_id = id;
            console.log(this.att_id);
        },
        getCategories() {
            let app = this;
            axios.get('/api/getCategories')
                .then(response => {
                    // console.log(response.data);
                    app.categories = response.data.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        getKeywords() {
            let app = this;
            axios.get('/api/getAllKeywords')
                .then(response => {
                    // console.log(response.data);
                    app.keywords = response.data.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadMore() {
            let app = this;
            let start = 8;
            let count = 8;
            axios.get(`/api/getAttractions/${app.$route.query.destination}`)
                .then(function(response) {
                    app.attractions = response.data.data;
                    app.more = false;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        filter() {
            let app = this;
            if (app.keywordsValues.length === 0) {
                console.log("non");
                app.keywordsValues = '0';
            } else if (app.categoryValues.length === 0) {
                app.categoryValues = '0';
            } else if ((app.categoryValues.length === 0) && (app.keywordsValues.length === 0)) {
                app.keywordsValues = '0';
                app.categoryValues = '0';
            }
            console.log(app.itinerary.destination);
            axios.all([
                    axios.get(`/api/getAttractionsByKeywords/${app.keywordsValues}/${app.itinerary.destination}`),
                    axios.get(`/api/getAttractionsByCategories/${app.categoryValues}/${app.itinerary.destination}`)
                ])
                .then(axios.spread((...results) => {
                    let resultsData = [];
                    console.log(results);
                    // console.log('res', results);
                    results.forEach(result => {
                        if (result.data.data !== null) {
                            // console.log('data:',res.data.data);
                            let res = result.data.data;
                            res.forEach((r) => {
                                resultsData.push(r);
                            })
                        }
                    })
                    app.attractions = resultsData;
                }))
                .catch(function(error) {
                    console.log(error);
                });

            //return values back to empty array
            if (app.keywordsValues == '0') {
                app.keywordsValues = [];
            } else if (app.categoryValues == '0') {
                app.categoryValues = [];
            }
        },

    },
    computed: {
        uniqueAttractions() {
            if(this.sort === 'name'){
              this.attractions = _.orderBy(this.attractions, 'name');
            }
            else if(this.sort === 'cost') {
              this.attractions = _.orderBy(this.attractions, 'details.max_price');
            }
            return _.uniqBy(this.attractions, 'id');
        },
        LessCategories() {
            return this.categories.slice(0, 6);
        },
        MoreCategories() {
            return this.categories;
        },
        LessKeywords() {
            return this.keywords.slice(0, 6);
        },
        MoreKeywords() {
            return this.keywords;
        },
    }
}
</script>

<style>
    .lnr-plus-circle {
        color: black;
        font-size: 20px;
    }

    a {
        cursor: pointer;
    }
</style>
