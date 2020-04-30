<template>
    <div>
        <div class="jumbotron jumbotron-fluid index-banner">
            <div class="container">
                <h2>Attractions in {{this.$route.query.destination}}</h2>
            </div>
        </div>

        <div class="container">
            <div class="row">

                <div class="col-12">
                    <div class="row">

                        <div class="col-lg-3 col-md-3 filters-col d-none d-md-block d-lg-block">
                            <h4>Filter</h4>

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

                            <div class="row">
                                <div class="col-12 d-none d-md-block d-lg-block">

                                    <div class="sorting-col">
                                        <div class="row">

                                            <div class="col-lg-6 offset-lg-6">
                                                <div class="sort-selection">
                                                    <h6>Sort by</h6>

                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <a class="btn sort-selection-link" role="button" @click="setSortBy('name')">Name</a>
                                                        </li>

                                                        <li class="list-inline-item">
                                                            <a class="btn sort-selection-link" role="button" @click="setSortBy('cost')">Cost</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row items-index">

                                <div class="col-12">
                                    <div class="card-c" v-for="attraction in uniqueAttractions" :key="attraction.id">
                                        <div class="card-c-img">
                                            <img v-if="attraction.details.image === 'default-image.png'" :src="publicPath + attraction.details.image" />
                                            <img v-else :src="storagePath + attraction.details.image" />
                                        </div>

                                        <div class="card-c-body">
                                            <router-link :to="{ name: 'attraction', params: {att_id: attraction.id} }" target="_blank">
                                                <h6>{{attraction.name}}</h6>
                                            </router-link>

                                            <p class="address">{{attraction.addresses.address1}}, {{attraction.addresses.city.name}}, {{attraction.addresses.city.districts.name}}</p>

                                            <span class="card-c-button-alt">
                                                <button @click="addToBookmarks(attraction.id)">
                                                    <jam-heart/> Add to Bookmarks
                                                </button>

                                                <button @click="addToItinerary(0, attraction.id)">
                                                    <jam-plus/> Add to Itinerary
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="items-index-button">
                                    <a class="btn btn-primary" @click="loadMore">Show More</a>
                                </div>

                            </div>

                            <addToItinerary v-if="show_modal" @submit="show_modal = false" @close="show_modal = false" :aOr="addToItineraryKey" :id="addToItineraryID"> </addToItinerary>
                            <alert v-if="show_alert" @close="show_alert = false" :alertMessage="alertMessage"> </alert>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
import addToItinerary from '../components/addToItinerary'
import alert from '../components/alert'

export default {
    name: 'moreAttractions',
    props: ['destination', 'user'],
    components: {
        addToItinerary,
        alert
    },
    data() {
        return {
            attractions: [],
            categories: '',
            categoryValues: [],
            start: 0,
            count: 20,
            more: true,
            keywords: '',
            keywordsValues: [],
            sortBy: 'name',
            showLessCategories: true,
            showLessKeywords: true,
            publicPath: '/images/',
            storagePath: '../storage/images/',
            show_modal: false,
            alertMessage: "",
            show_alert: false
        }
    },
    mounted() {
        this.getAttractions();
        this.getCategories();
        this.getKeywords();
    },
    methods: {
        setSortBy(value) {
            let app = this;
            app.sortBy = value;
            console.log('va', app.sortBy);
        },
        getAttractions() {
            let app = this;
            axios.get(`/api/getAttractions/${app.$route.query.destination}`)
                .then(response => {
                    // let attractionData = response.data.data;
                    app.attractions = response.data.data;
                    // console.log('attractions:',attractionData);
                    // app.attractions = attractionData.slice(0, 6);
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
        scrollToTop() {
            window.scrollTo(0, 0);
        },
        addToBookmarks(id) {
            let app = this;
            let token = localStorage.getItem("token");
            if (token !== null) {
                let data = {
                    user_id: app.user.id,
                    restaurant_id: null,
                    itinerary_id: null,
                    attraction_id: id
                }
                axios.post('/api/createBookmarks', data, {
                        headers: {
                            Authorization: "Bearer " + token
                        }
                    })
                    .then(response => {
                        console.log("ATTRACTION SUCCESSFULLY ADDED TO BOOKMARK");
                        // console.log(response.data);
                        app.alertMessage = "Added to bookmarks!";
                        app.show_alert = true;
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            } else {
                app.$router.push({
                    name: 'login'
                });
                window.scrollTo(0, 0);
            }
        },
        addToItinerary(key, id) {
            let token = localStorage.getItem("token");
            if (token !== null) {
                this.show_modal = true;
                this.addToItineraryID = id;
                this.addToItineraryKey = key;
            } else {
                this.$router.push({
                    name: 'login'
                });
                window.scrollTo(0, 0);
            }
        },
        getCategories() {
            let app = this;
            axios.get('/api/getCategories')
                .then(response => {
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
                    app.keywords = response.data.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        filter() {
            let app = this;

            //set value to 0
            if (app.keywordsValues.length === 0) {
                console.log("non");
                app.keywordsValues = '0';
            } else if (app.categoryValues.length === 0) {
                app.categoryValues = '0';
            } else if ((app.categoryValues.length === 0) && (app.keywordsValues.length === 0)) {
                app.keywordsValues = '0';
                app.categoryValues = '0';
            }

            axios.all([
                    axios.get(`/api/getAttractionsByKeywords/${app.keywordsValues}/${app.$route.query.destination}`),
                    axios.get(`/api/getAttractionsByCategories/${app.categoryValues}/${app.$route.query.destination}`)
                ])
                .then(axios.spread((...results) => {
                    let resultsData = [];
                    console.log(results);
                    results.forEach(result => {
                        if (result.data.data !== null) {
                            // console.log('data:',result.data.data);
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

            //back to empty array
            if (app.keywordsValues == '0') {
                app.keywordsValues = [];
            } else if (app.categoryValues == '0') {
                app.categoryValues = [];
            }
        },
    },
    computed: {
        uniqueAttractions() {
            if (this.sortBy === 'name') {
                this.attractions = _.orderBy(this.attractions, 'name');
            } else if (this.sortBy === 'cost') {
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
.v {
    margin-top: 5px !important;
}

.e {
    padding: 0px !important;
}
</style>
