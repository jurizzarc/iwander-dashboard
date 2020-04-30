<template>
    <div>
        <!-- ITEM BANNER -->
        <div class="jumbotron jumbotron-fluid item-banner" v-for="data in city_data">
            <img v-if="data.image === 'default-image.png'" :src="publicPath + data.image" />
            <img v-else :src="storagePath + data.image" />
        </div>

        <!-- CONTENT START -->
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="row">

                        <div class="col-lg-7 col-sm-12" v-for="data in city_data">

                            <div class="main-heading order-lg-1">
                                <h1>{{data.name}}</h1>
                                <h6 class="subheading">{{data.districts.name}}</h6> <!-- DISTRICT -->
                                <h6 class="subheading">{{data.districts.country.name}}</h6> <!-- COUNTRY -->
                                <h6 class="subheading">{{data.districts.country.continent}}</h6> <!-- CONTINENT -->
                            </div>
                            <div class="iwander-desc order-lg-2">
                                <p>{{data.description}}</p>
                            </div>

                        </div>

                        <div class="col-lg-4 offset-lg-1">
                            <div class="create-plan-md">
                                <form v-on:submit.prevent="createItinerary">
                                    <div class="form-row">

                                        <div class="col-12 form-heading">
                                            <h4>Create a Travel Plan</h4>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="destination">Destination</label>
                                            <input id="destination" type="text" class="form-control" v-on:keyup="getSearchData" placeholder="Enter city" v-model="itinerary.destination" name="destination" autocomplete="off"></input>
                                            <div class="dropdown-results" v-if="dropdowns.length" style="width:100% !important;">
                                                <div class="dropdown" v-for="dropdown in dropdowns" aria-haspopup="true" aria-expanded="false">
                                                    <a class="dropdown-item"><li class="dropdown-item" @click="getResult(dropdown.name)">{{ dropdown.name }}, {{dropdown.districts.country.name}}</li></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="start_date">Start Date</label>
                                            <input id="start_date" type="date" class="form-control" v-model="itinerary.start_date" name="start_date" required autocomplete="current-password">
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="end_date">End Date</label>
                                            <input id="end_date" type="date" class="form-control" v-model="itinerary.end_date" name="end_date" required autocomplete="current-password">
                                        </div>

                                        <div class="form-button col-12">
                                            <button class="btn btn-primary" type="submit">Create</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION START -->
                    <div class="row">
                        <div class="iwander-section">

                            <div class="col-12 section-heading">
                                <h3>Things to do in {{this.city}}</h3>
                            </div>

                            <!-- ATTRACTIONS LIST START -->
                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 col-lg-4 col-md-6" v-for="attraction in attractions.slice(0,6)">
                                        <div class="card-b">
                                            <!-- CARD BUTTONS -->
                                            <div class="card-buttons">
                                                <a href="#" class="card-action" title="Add to Bookmarks" @click="addToBookmarks(0, attraction.attraction.id)">
                                                    <jam-heart/>
                                                </a>

                                                <a href="#" class="card-action" title="Add to Travel Itinerary" @click="addToItinerary(0, attraction.attraction.id)">
                                                    <jam-plus/>
                                                </a>
                                            </div>

                                            <a>
                                                <!-- CARD IMAGE -->
                                                <div class="card-b-img">
                                                    <a v-if="attraction.attraction.details.image === 'default-image.png'">
                                                        <router-link :to="{ name: 'attraction', params: {att_id: attraction.attraction.id} }">
                                                            <img class="img-fluid" :src="publicPath + attraction.attraction.details.image" :img-alt="attraction.attraction.name" />
                                                        </router-link>
                                                    </a>
                                                    <a v-else>
                                                        <router-link :to="{ name: 'attraction', params: {att_id: attraction.attraction.id} }">
                                                            <img class="img-fluid" :src="storagePath + attraction.attraction.details.image" :img-alt="attraction.attraction.name" />
                                                        </router-link>
                                                    </a>
                                                </div>

                                                <!-- CARD BODY -->
                                                <div class="card-b-body">
                                                    <ul class="list-inline">
                                                        <li class="category">{{attraction.attraction_category}}</li>
                                                    </ul>
                                                    <router-link :to="{ name: 'attraction', params: {att_id: attraction.attraction.id} }">
                                                        <h6>{{attraction.attraction.name}}</h6>
                                                    </router-link>
                                                </div>
                                            </a>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- ATTRACTIONS LIST END -->

                            <div class="col-12 section-button">
                                <router-link :to="{ name: 'moreAttractions', query: {destination: this.city}}">
                                    <button class="btn btn-primary" type="submit">Show All</button>
                                </router-link>
                            </div>

                        </div>
                    </div>


                    <div class="row">
                        <div class="iwander-section">

                            <div class="col-12 section-heading">
                                <h3>Where to eat in {{this.city}}</h3>
                            </div>
                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 col-lg-4 col-md-6" v-for="result in results.slice(0,6)" :key="result.restaurant.id">
                                        <div class="card-b">
                                            <!-- CARD BUTTONS -->
                                            <div class="card-buttons">
                                                <a href="#" class="card-action" title="Add to Bookmarks" @click="addToBookmarks(1, result.restaurant.id)">
                                                    <jam-heart/>
                                                </a>

                                                <a href="#" class="card-action" title="Add to Travel Itinerary" @click="addToItinerary(1, result.restaurant.id)">
                                                    <jam-plus/>
                                                </a>
                                            </div>

                                            <a>
                                                <!-- CARD IMAGE -->
                                                <div class="card-b-img">
                                                    <router-link :to="{ name: 'restaurant', params: {res_id: result.restaurant.id} }">
                                                        <img :src="result.restaurant.featured_image" class="img-fluid" :img-alt="result.restaurant.name">
                                                    </router-link>
                                                </div>

                                                <!-- CARD BODY -->
                                                <div class="card-b-body">
                                                    <ul class="list-inline">
                                                        <li class="category">{{result.restaurant.cuisines}}</li>
                                                    </ul>
                                                    <router-link :to="{ name: 'restaurant', params: {res_id: result.restaurant.id} }">
                                                        <h6>{{result.restaurant.name}}</h6>
                                                    </router-link>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 section-button">
                                <router-link :to="{ name: 'moreRestaurants', params: {entity_id: this.entity_id }, query: {destination: this.city, entity_type: this.entity_type, city_id: this.city_id}}">
                                    <button class="btn btn-primary">Show All</button>
                                </router-link>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="iwander-section">

                            <div class="col-12 section-heading" v-for="data in city_data">
                                <h3>Explore other cities of {{data.districts.country.name}}</h3>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <!-- CARD START -->
                                    <div class="col-6 col-lg-3 col-sm-6" v-for="result in cities">
                                        <div class="card-a">
                                            <a>
                                                <!-- CARD IMAGE -->
                                                <div class="card-a-img">
                                                    <img v-if="result.image === 'default-image.png'" :src="publicPath + result.image" class="img-fluid" :img-alt="result.name">
                                                    <img v-else :src="storagePath + result.image" class="img-fluid" :img-alt="result.name">
                                                </div>
                                                <!-- CARD BODY -->
                                                <div class="card-a-body">
                                                    <router-link :to="{ name: 'searchIndex', params: {city: result.name } }">
                                                        <h5>{{result.name}}</h5>
                                                    </router-link>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- CARD END -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <addToItinerary v-if="show_modal" @submit="show_modal = false" @close="show_modal = false" :aOr="addToItineraryKey" :id="addToItineraryID"> </addToItinerary>
            <alert v-if="show_alert" @close="show_alert = false" :alertMessage="alertMessage"> </alert>
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

//get city URL
function cityUrl(city) {
    return ZomatoBASEURL + "/locations?query=" + city;
}

//search restaurant URL
function restaurantUrl(entity_id, entity_type) {
    return ZomatoBASEURL + '/search?entity_id=' + entity_id + '&entity_type=' + entity_type;
}

import addToItinerary from '../components/addToItinerary'
import alert from '../components/alert'

export default {
    name: 'searchIndex',
    props: {
        'city': {
            required: true,
            type: String
        }
    },
    components: {
        addToItinerary,
        alert
    },
    data() {
        return {
            entity_id: '',
            entity_type: '',
            city_id: '',
            results: [],
            showLess: 'true',
            user_id: '',
            city_data: '',
            district: '',
            country: '',
            citiesindistricts: [],
            attractions: [],
            bookmark: [{
                itinerary_id: '',
                restaurant_id: '',
                attraction_id: ''
            }],
            itinerary: {
                destination: "",
                start_date: "",
                end_date: "",
                user_id: "",
                id: ""
            },
            show_modal: false,
            addToItineraryID: '',
            addToItineraryKey: '',
            alertMessage: "",
            show_alert: false,
            defaultImageCity: '',
            defaultImageAttraction: '',
            publicPath: '/images/',
            storagePath: '../storage/images/',
            dropdowns: []
        }
    },
    mounted() {
        this.getCityData();
        this.getCity();
        this.getAttractions();
        this.getUser();
    },
    watch: {
        //watch if city prop changes
        //rerender the component
        city: function(newVal, oldVal) {
            immediate: true,
            console.log('prop changed: ', newVal, '| was: ', oldVal);
            this.debouncedGetCityData();
            this.debouncedGetCity();
            this.debouncedGetAttractions();
            window.scrollTo(0, 0); //scroll to top of the window
        }
    },
    created() {
        this.debouncedGetCityData = _.debounce(this.getCityData);
        this.debouncedGetCity = _.debounce(this.getCity);
        this.debouncedGetAttractions = _.debounce(this.getAttractions);
    },
    methods: {
        getCityData() {
            let app = this;
            let token = localStorage.getItem("token");
            axios.get(`/api/get-city/${app.city}`, {
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                })
                .then(response => {
                    let results = response.data.data;
                    // console.log('res', results);
                    // console.log(app.city_data);
                    results.forEach((result) => {
                        // console.log('res', result);
                        app.district = result.districts.name;
                          app.country = result.districts.country.name;
                        // console.log('District:', app.district);
                    })
                    app.city_data = results;
                    this.getCitiesinDistrict();
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        getCity() {
            let app = this;
            axios.get(cityUrl(app.city), config)
                .then(response => {
                    let results = response.data.location_suggestions;
                    // console.log('city Data: ', results);
                    results.forEach((result) => {
                        app.city_id = result.city_id;
                        app.entity_id = result.entity_id;
                        app.entity_type = result.entity_type;
                        // console.log('entity_type',app.entity_type);
                    })
                    this.getRestaurants(app.entity_id, app.entity_type);
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        getRestaurants(entity_id, entity_type) {
            let app = this;
            axios.get(restaurantUrl(entity_id, entity_type), config)
                .then(function(response) {
                    let restaurants = response.data.restaurants;
                    // console.log(restaurants);
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
        getCitiesinDistrict() {
            let app = this;
            axios.get(`/api/get-cities/${app.country}`)
                .then(response => {
                    let citiesData = response.data.data;
                    citiesData.forEach((result) => {
                        let cities = result.cities;
                        cities.forEach((res) => {
                          app.citiesindistricts.push(res);
                        })
                    })
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        getAttractions() {
            let app = this;
            console.log('Attraction - get cities:', app.city);
            axios.get(`/api/getAttractions/${app.city}`)
                .then(response => {
                    let results = response.data.data;
                    // console.log('att', results);
                    results.forEach((result) => {
                        //get categories of each attraction
                        axios.get(`/api/getCategoriesOfAttraction/${result.id}`)
                            .then(response => {
                                let categories = [];
                                let categoriesResults = response.data.data.slice(0, 2);
                                categoriesResults.forEach((res) => {
                                    categories.push(res.name);
                                })

                                let categ = categories.join(' , ');
                                app.attractions.push({
                                    attraction: result,
                                    attraction_category: categ
                                });

                                app.attractions =  _.shuffle(app.attractions);
                            })
                            .catch(function(error) {
                                console.log(error);
                            });
                    });
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        getUser() {
            let app = this;
            let token = localStorage.getItem("token");
            axios.get('/api/user', {
                    headers: {
                        Authorization: "Bearer " + token
                    }
                })
                .then(response => {
                    app.user_id = response.data.user.id;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        addToBookmarks(i, id) {
            let app = this;
            let token = localStorage.getItem("token");
            if (token !== null) {
                if (i === 0) {
                    let data = {
                        user_id: app.user_id,
                        restaurant_id: app.bookmark.restaurant_id,
                        itinerary_id: app.bookmark.itinerary_id,
                        attraction_id: id
                    }

                    axios.post('/api/createBookmarks', data, {
                            headers: {
                                'Authorization': "Bearer " + token
                            }
                        })
                        .then(function(response) {
                            // alert(response.message);
                            console.log("ATTRACTION SUCCESSFULLY ADDED TO BOOKMARK");
                            // console.log(response.data);
                            app.alertMessage = "Added to bookmarks!";
                            app.show_alert = true;
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                } else {
                    let data = {
                        user_id: app.user_id,
                        restaurant_id: id,
                        itinerary_id: app.bookmark.itinerary_id,
                        attraction_id: app.bookmark.attraction_id
                    }
                    axios.post('/api/createBookmarks', data, {
                            headers: {
                                'Authorization': "Bearer " + token
                            }
                        })
                        .then(function(response) {
                            console.log("RESTAURANT SUCCESSFULLY ADDED TO BOOKMARK");
                            app.alertMessage = "Added to bookmarks!";
                            app.show_alert = true;
                            // console.log(response.data);
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                }
            } else {
                app.$router.push({
                    name: 'login'
                });
                window.scrollTo(0, 0);
            }
        },
        createItinerary() {
            let app = this;
            let token = localStorage.getItem("token");
            if (token !== null) {
                let data = {
                    destination: app.itinerary.destination,
                    start_date: app.itinerary.start_date,
                    end_date: app.itinerary.end_date,
                    user_id: app.user_id,
                }
                axios.post('/api/createitinerary', data, {
                        headers: {
                            'Authorization': "Bearer " + token
                        }
                    })
                    .then(function(response) {
                        // console.log("Itinerary Id:" + response.data.data.id);
                        app.itinerary.id = response.data.data.id;

                        //go to addtoitinerary page and pass parameters
                        app.$router.push({
                            name: 'addtoitinerary',
                            params: {
                                destination: app.itinerary.destination
                            },
                            query: {
                                itinerary_id: app.itinerary.id
                            }
                        });
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            } else {
                app.$router.push({
                    name: 'login'
                });
                // window.scrollTo(0, 0);
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
                // window.scrollTo(0, 0);
            }
        },
        getSearchData(){
            this.dropdowns = [];
            if(this.itinerary.destination.length > 0){
             axios.get('/api/search', { params: { search: this.itinerary.destination } }).then(response => {
              this.dropdowns = response.data;
             });
           }
        },
        getResult(result){
          console.log(result.name);
          this.itinerary.destination = result;
          this.dropdowns = [];
        }
    },
    computed: {
      cities() {
          return this.citiesindistricts.slice(0, 8);
      }
    }
}


</script>
<style>
.title {
    padding: 20px;
}
</style>
