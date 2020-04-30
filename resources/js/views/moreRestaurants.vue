<template>
    <div>
        <div class="jumbotron jumbotron-fluid index-banner">
            <div class="container">
                <h2>Restaurants in {{this.$route.query.destination}}</h2>
            </div>
        </div>

        <div class="container">
            <div class="row">

                <div class="col-12">
                    <div class="row">

                        <div class="col-lg-3 col-md-3 filters-col d-none d-md-block d-lg-block">
                            <h4>Filter</h4>

                            <div class="filters-block">
                                <h6>Establishments</h6>
                                <ul class="list-group filter-selection">
                                    <div v-if="showLessEstablishments">
                                        <li class="list-group-item" v-for="establishment in LessEstablishments">
                                            <input type="checkbox" id="establishmentCheckbox" :value="establishment.establishment.id" v-model="establishmentValues">
                                            <label for="establishmentCheckbox">{{establishment.establishment.name}}</label>
                                        </li>
                                    </div>
                                    <div v-else>
                                        <li class="list-group-item" v-for="establishment in MoreEstablishments">
                                            <input type="checkbox" id="establishmentCheckbox" :value="establishment.establishment.id" v-model="establishmentValues">
                                            <label for="establishmentCheckbox">{{establishment.establishment.name}}</label>
                                        </li>
                                    </div>
                                    <a v-if="showLessEstablishments" @click="showLessEstablishments = false">Show More</a>
                                    <a v-else @click="showLessEstablishments = true">Show Less</a>
                                </ul>
                            </div>

                            <div class="filters-block">
                                <h6>Categories</h6>
                                <ul class="list-group filter-selection">
                                    <div v-if="showLessCategories">
                                        <li class="list-group-item" v-for="category in LessCategories">
                                            <input type="checkbox" id="categoryCheckbox" :value="category.categories.id" v-model="categoryValues">
                                            <label for="categoryCheckbox">{{category.categories.name}}</label>
                                        </li>
                                    </div>
                                    <div v-else>
                                        <li class="list-group-item" v-for="category in MoreCategories">
                                            <input type="checkbox" id="categoryCheckbox" :value="category.categories.id" v-model="categoryValues">
                                            <label for="categoryCheckbox">{{category.categories.name}}</label>
                                        </li>
                                    </div>
                                    <a v-if="showLessCategories" @click="showLessCategories = false">Show More</a>
                                    <a v-else @click="showLessCategories = true">Show Less</a>
                                </ul>
                            </div>

                            <div class="filters-block">
                                <h6>Cuisines</h6>
                                <ul class="list-group filter-selection">
                                    <div v-if="showLessCuisines">
                                        <li class="list-group-item" v-for="cuisine in LessCuisines">
                                            <input type="checkbox" id="cuisineCheckbox" :value="cuisine.cuisine.cuisine_id" v-model="cuisineValues">
                                            <label for="cuisineCheckbox">{{cuisine.cuisine.cuisine_name}}</label>
                                        </li>
                                    </div>
                                    <div v-else>
                                        <li class="list-group-item" v-for="cuisine in MoreCuisines">
                                            <input type="checkbox" id="cuisineCheckbox" :value="cuisine.cuisine.cuisine_id" v-model="cuisineValues">
                                            <label for="cuisineCheckbox">{{cuisine.cuisine.cuisine_name}}</label>
                                        </li>
                                    </div>
                                    <a v-if="showLessCuisines" @click="showLessCuisines = false">Show More</a>
                                    <a v-else @click="showLessCuisines = true">Show Less</a>
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
                                                            <a class="btn sort-selection-link" role="button" @click="setSortBy('cost')">Cost</a>
                                                        </li>

                                                        <li class="list-inline-item">
                                                            <a class="btn sort-selection-link" role="button" @click="setSortBy('rating')">Rating</a>
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
                                <div class="card-c" v-for="result in uniqueRestaurants" :key="result.restaurant.id">
                                    <div class="card-c-img">
                                        <img :src="result.restaurant.featured_image" alt="Card image">
                                    </div>

                                    <div class="card-c-body">
                                        <router-link :to="{ name: 'restaurant', params: {res_id: result.restaurant.id} }" target="_blank">
                                            <h6>{{result.restaurant.name}}</h6>
                                        </router-link>

                                        <p class="address">{{result.restaurant.location.address}}</p>

                                        <!-- <span class="card-c-button">
                                            <a href="#" class="card-action" title="Add to Bookmarks" @click="addToBookmarks(result.restaurant.id)">
                                                <span class="lnr lnr-bookmark"></span> Bookmark
                                            </a>

                                            <a href="#" class="card-action" title="Add to Bookmarks" @click="addToItinerary(1, result.restaurant.id)">
                                            <span class="lnr lnr-file-add"></span> Add to itinerary
                                            </a>
                                        </span> -->

                                        <span class="card-c-button-alt">
                                            <button @click="addToBookmarks(result.restaurant.id)">
                                                <jam-heart/> Add to Bookmarks
                                            </button>

                                            <button @click="addToItinerary(1, result.restaurant.id)">
                                                <jam-plus/> Add to Itinerary
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div v-if="more" class="col-12 items-index-button">
                                <button class="btn btn-primary" @click="loadMore">Load More</button>
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

const ZomatoBASEURL = "https://developers.zomato.com/api/v2.1";
const API_key = "223bdf4a4bffe3c07d3766b4be4efa5a";

const config = {
    headers: {
        'user-key': API_key
    }
};

//get city URL
function cityUrl(city) {
    return ZomatoBASEURL + "/locations?query=" + city;
}

//search restaurant URL
function restaurantUrl(entity_id, entity_type, start, count, cuisines, establishment_type, categories, sortBy) {
    return ZomatoBASEURL + '/search?entity_id=' + entity_id + '&entity_type=' + entity_type + '&start=' + start + '&count=' + count + '&sort=' + sortBy;
}


//search establishments URL
function getEstablishments(city_id) {
    return ZomatoBASEURL + '/establishments?city_id=' + city_id;
}

//search cuisines URL
function getCuisines(city_id) {
    return ZomatoBASEURL + '/cuisines?city_id=' + city_id;
}

//search categories URL
function getCategories(city_id) {
    return ZomatoBASEURL + '/categories?city_id=' + city_id;
}

//FILTER
function filterResults(entity_id, entity_type, start, count, cuisines, establishment_type, categories, sortBy) {
    return ZomatoBASEURL + '/search?entity_id=' + entity_id + '&entity_type=' + entity_type + '&start=' + start + '&count=' + '&cuisines=' + cuisines + '&establishment_type=' + establishment_type + 'category=' + categories + '&sort=' + sortBy;
}

export default {
    name: 'moreRestaurants',
    props: ['destination', 'entity_id', 'entity_type', 'city_id', 'user'],
    components: {
      addToItinerary, alert
    },
    data() {
        return {
            results: [],
            start: 0,
            count: 20,
            more: true,
            establishments: '',
            cuisines: '',
            categories: '',
            establishmentValues: [],
            categoryValues: [],
            cuisineValues: [],
            showMoreEstablishments: false,
            showMoreCuisines: false,
            showMoreCategories: false,
            sortBy: '',
            showLessCategories: true,
            showLessEstablishments: true,
            showLessCuisines: true,
            alertMessage: "",
            show_alert: false,
            show_modal: false
        }
    },
    mounted() {
        this.getRestaurants();
        this.getEstablishments();
        this.getCuisines();
        this.getCategories();
    },
    watch:{
      sortBy: function(newVal, oldVal) {
        console.log('sort changed: ', newVal, '| was: ', oldVal);
        this.getRestaurants();
      }
    },
    methods: {
      setSortBy(value) {
          let app = this;
          app.sortBy = value;
          // console.log('va', app.sortBy);
      },
        getRestaurants() {
          let establishments = this.establishmentValues.join(',');
          let cuisines = this.cuisineValues.join(',');
          let categories = this.categoryValues.join(',');

            let app = this;
            axios.get(restaurantUrl(this.$route.params.entity_id, this.$route.query.entity_type, app.start, app.count, cuisines, establishments, categories, app.sortBy), config)
                .then(function(response) {
                    let restaurants = response.data.restaurants;
                    restaurants.forEach((result) => {
                        let img = result.restaurant.featured_image;
                        if (result.restaurant.featured_image == "") {
                            let img = '/images/default-restaurant.jpg';
                            result.restaurant.featured_image = img;
                        }
                    })
                    app.results = restaurants;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadMore() {
          let establishments = this.establishmentValues.join(',');
          let cuisines = this.cuisineValues.join(',');
          let categories = this.categoryValues.join(',');

            let app = this;

            app.start += 21;
            app.count += 20;
            console.log(app.start);
            console.log(app.count);
            console.log("CONTINUE");
            axios.get(filterResults(this.$route.params.entity_id, this.$route.query.entity_type, app.start, app.count, cuisines, establishments, categories, app.sortBy), config)
                .then(function(response) {
                    let morerestaurants = response.data.restaurants;
                    if (morerestaurants == "") {
                        // console.log("Back to zero");
                        app.more = false;
                    } else {
                        morerestaurants.forEach((result) => {
                            let img = result.restaurant.featured_image;
                            if (result.restaurant.featured_image == "") {
                                let img = '/images/default-restaurant.jpg';
                                result.restaurant.featured_image = img;
                            }
                            app.results.push(result);
                        })
                    }

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
                    restaurant_id: id,
                    itinerary_id: null,
                    attraction_id: null
                }
                axios.post('/api/createBookmarks', data, {
                        headers: {
                            Authorization: "Bearer " + token
                        }
                    })
                    .then(response => {
                        console.log("RESTAURANT SUCCESSFULLY ADDED TO BOOKMARK");
                        app.alertMessage = "Added to bookmarks!";
                        app.show_alert = true;
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            } else {
                app.$router.push({
                    name: 'login'
                })
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
        getEstablishments() {
            let app = this;
            axios.get(getEstablishments(app.$route.query.city_id), config)
                .then(function(response) {
                    app.establishments = response.data.establishments;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        getCuisines() {
            let app = this;
            axios.get(getCuisines(app.$route.query.city_id), config)
                .then(function(response) {
                    app.cuisines = response.data.cuisines;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        getCategories() {
            let app = this;
            axios.get(getCategories(app.$route.query.city_id), config)
                .then(function(response) {
                    app.categories = response.data.categories;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        filter() {
            let establishments = this.establishmentValues.join(',');
            let cuisines = this.cuisineValues.join(',');
            let categories = this.categoryValues.join(',');
            let app = this;

            axios.get(filterResults(this.$route.params.entity_id, this.$route.query.entity_type, app.start, app.count, cuisines, establishments, categories, app.sortBy), config)
                .then(function(response) {
                    if (response.data.results_found == 0) {
                        app.more = false;
                        app.results = response.data.restaurants;
                        window.scrollTo(0, 0);
                    } else if (response.data.results_found < 19) {
                        app.more = false;

                        let res = [];
                        let resultData = response.data.restaurants;
                        resultData.forEach((result) => {
                            let img = result.restaurant.featured_image;
                            if (result.restaurant.featured_image == "") {
                                let img = '/images/default-restaurant.jpg';
                                result.restaurant.featured_image = img;
                            }
                            res.push(result);

                        })
                        app.results = res;
                        window.scrollTo(0, 0);
                    } else {

                        app.more = true;

                        let res = [];
                        let resultData = response.data.restaurants;
                        resultData.forEach((result) => {
                            let img = result.restaurant.featured_image;
                            if (result.restaurant.featured_image == "") {
                                let img = '/images/default-restaurant.jpg';
                                result.restaurant.featured_image = img;
                            }
                            res.push(result);
                        })
                        app.results = res;
                        window.scrollTo(0, 0);
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
    },
    computed: {
        uniqueRestaurants() {
            return _.uniqBy(this.results, 'restaurant.id');
        },
        LessEstablishments() {
            return this.establishments.slice(0, 6);
        },
        MoreEstablishments() {
            return this.establishments;
        },
        LessCategories() {
            return this.categories.slice(0, 6);
        },
        MoreCategories() {
            return this.categories;
        },
        LessCuisines() {
            return this.cuisines.slice(0, 6);
        },
        MoreCuisines() {
            return this.cuisines;
        },
    }

}
</script>

<style>
.filterBox {
    height: auto;

}

.e {
    padding: 0px !important;
}
</style>
