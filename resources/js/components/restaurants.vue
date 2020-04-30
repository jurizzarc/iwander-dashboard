<template>
    <div class="container">
        <div class="row">

            <div class="col-12">
                <div class="row">

                    <div class="col-lg-3 col-md-3 filters-col d-none d-md-block d-lg-block">
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
                            <h6>Cuisines:</h6>
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
                                        <span class="card-c-button">
                                            <a class="add" @click="showModal(result.restaurant.id)" id="show_modal">
                                                Add to Itinerary
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="items-index-button">
                                <button class="btn btn-primary" @click="loadMore">Show More</button>
                            </div>

                            <addEvent v-if="show_modal" @close="show_modal = false" :data="this.res_id" :itinerary="this.itinerary"> </addEvent>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</template>

<script>
const ZomatoBASEURL = "https://developers.zomato.com/api/v2.1";
const API_key = "223bdf4a4bffe3c07d3766b4be4efa5a";

const config = {
    headers: {
        'user-key': API_key
    }
};

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


import addEvent from '../components/addEvent'
export default {
    name: 'restaurants',
    props: ['app', 'itinerary', 'entity_details', 'sort'],
    components: {
        addEvent
    },
    created() {
        this.getEstablishments();
        this.getCuisines();
        this.getCategories();
    },
    mounted() {
        this.getRestaurants();
    },
    data() {
        return {
            results: [],
            show_modal: false,
            res_id: "",
            start: 0,
            count: 20,
            more: true,
            establishments: '',
            cuisines: '',
            categories: '',
            establishmentValues: [],
            categoryValues: [],
            cuisineValues: [],
            sortBy: '',

            showLessCategories: true,
            showLessEstablishments: true,
            showLessCuisines: true,
        }
    },
    watch:{
      sort: function(newVal, oldVal) {
        console.log('sort changed: ', newVal, '| was: ', oldVal);
        this.getRestaurants();
      }
    },
    methods: {
        getRestaurants() {
          //combine objects into an array
          let establishments = this.establishmentValues.join(',');
          // console.log(establishments);
          let cuisines = this.cuisineValues.join(',');
          // console.log(cuisines);
          let categories = this.categoryValues.join(',');
          // console.log(categories);

            let app = this;
            axios.get(restaurantUrl(app.entity_details.entity_id, app.entity_details.entity_type, app.start, app.count,cuisines, establishments, categories, app.sort), config)
                .then(function(response) {
                    let restaurants = response.data.restaurants;
                    //set default image if no image
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
        showModal(id) {
            this.show_modal = true;
            //restaurant id
            this.res_id = id;
        },
        loadMore() {
            let establishments = this.establishmentValues.join(',');
            // console.log(establishments);
            let cuisines = this.cuisineValues.join(',');
            // console.log(cuisines);
            let categories = this.categoryValues.join(',');

            let app = this;
            app.start += 21;
            app.count += 20;

            axios.get(filterResults(app.entity_details.entity_id, app.entity_details.entity_type, app.start, app.count, cuisines, establishments, categories, app.sortBy), config)
                .then(function(response) {
                    let morerestaurants = response.data.restaurants;

                    //if no more restaurants from API
                    if (morerestaurants == "") {
                        // console.log("Back to zero");
                        app.more = false;
                    } else {
                        //set default image
                        morerestaurants.forEach((result) => {
                            let img = result.restaurant.featured_image;
                            if (result.restaurant.featured_image == "") {
                                let img = '/images/default-restaurant.jpg';
                                result.restaurant.featured_image = img;
                            }
                            app.results.push(result);
                        })
                        console.log(app.results);
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        filter() {
            let establishments = this.establishmentValues.join(',');
            // console.log(establishments);
            let cuisines = this.cuisineValues.join(',');
            // console.log(cuisines);
            let categories = this.categoryValues.join(',');
            // console.log(categories);
            let app = this;

            axios.get(filterResults(this.$route.params.entity_id, this.$route.query.entity_type, app.start, app.count, cuisines, establishments, categories, app.sortBy), config)
                // axios.get(filterResults(this.$route.params.entity_id, this.$route.query.entity_type, cuisines, establishments, categories, app.sortBy), config)
                .then(function(response) {
                    // console.log(response);
                    // console.log(response.data.results_found);
                    if (response.data.results_found == 0) {
                        // console.log("none");
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
                        // console.log('response:',response.data.restaurants);
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
        scrollToTop() {
            window.scrollTo(0, 0);
        },
        getEstablishments() {
            let app = this;
            console.log('this city_id', app.entity_details.city_id);
            axios.get(getEstablishments(app.entity_details.city_id), config)
                .then(function(response) {
                    app.establishments = response.data.establishments;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        getCuisines() {
            let app = this;
            axios.get(getCuisines(app.entity_details.city_id), config)
                .then(function(response) {
                    app.cuisines = response.data.cuisines;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        getCategories() {
            let app = this;
            axios.get(getCategories(app.entity_details.city_id), config)
                .then(function(response) {
                    app.categories = response.data.categories;
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
.lnr-plus-circle {
    color: black;
    font-size: 20px;
}
</style>
