<template>
<div v-if="restaurantLoaded">
    <!---------- ITEM BANNER ---------->
    <div class="jumbotron jumbotron-fluid item-banner">
        <img :src="results.featured_image" />
    </div>

    <!---------- CONTENT START ---------->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">

                    <div class="col-lg-7 col-sm-12">

                        <div class="main-heading order-lg-1 order-sm-1">
                            <h1>{{results.name}}</h1>
                            <h6 class="subheading">
                                <jam-star-f/> {{results.user_rating.aggregate_rating}}
                            </h6>
                            <h6 class="subheading" v-for="cuisine in results.cuisines.split(', ')">{{cuisine}}</h6>
                        </div>

                        <div class="iwander-desc order-lg-2">
                            <div class="row">

                                <div class="col-lg-6 col-sm-12">
                                    <div class="add-info">
                                        <h6>Average Cost For Two</h6>
                                        <p>{{results.currency}}{{results.average_cost_for_two}}</p>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12">
                                    <div class="add-info">
                                        <h6>Features</h6>
                                        <div v-if="lessHighlights">
                                            <ul class="list-inline">
                                                <li class="list-inline-item"  v-for="highlight in showLessHighlights">{{highlight}}</li>
                                            </ul>

                                            <li class="list-inline-item" v-if="lessHighlights">
                                                <a @click="lessHighlights = false">Show More</a>
                                            </li>
                                        </div>
                                        <div v-else>
                                            <ul class="list-inline" >
                                                <li class="list-inline-item" v-for="highlight in showMoreHighlights">{{highlight}}</li>

                                            </ul>
                                            <li class="list-inline-item" v-if="!lessHighlights">
                                                <a @click="lessHighlights = true">Show Less</a>
                                            </li>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12" v-if="results.timings !== ''">
                                    <div class="add-info">
                                        <h6>Hours</h6>
                                        <ul class="list-group">
                                            <li class="list-group-item" v-for="time in results.timings.split('),')">{{time}})</li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-lg-4 offset-lg-1">

                        <div class="action-selection">
                            <a class="btn action-selection-link" href="#" role="button" style="margin-bottom:30px;"  @click="addToBookmarks(results.id)">
                                <span class="jam jam-heart" data-jam="heart" data-fill="#444" data-width="18" data-height="18"></span> Add to Bookmarks
                            </a>

                            <a class="btn action-selection-link" href="#" role="button" style="margin-bottom:30px;" @click="addToItinerary(1, results.id)">
                                <span class="jam jam-plus" data-jam="plus" data-fill="#444" data-width="18" data-height="18"></span> Add to Itinerary
                            </a>
                        </div>

                        <div class="add-info">
                            <h6>Location</h6>
                            <p  v-for="address in results.location.address.split(',')">
                                {{ address }}<br />
                            </p>
                        </div>

                        <div class="add-info">
                            <h6>Contact</h6>
                            <p v-for="number in results.phone_numbers.split(',')">
                                {{number}} <br />
                            </p>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
        <addToItinerary v-if="show_modal" @submit="show_modal = false" @close="show_modal = false" :aOr="addToItineraryKey" :id="addToItineraryID"> </addToItinerary>
        <alert v-if="show_alert" @close="show_alert = false" :alertMessage="alertMessage"> </alert>

</div>
</template>
<script>
const ZomatoBASEURL = "https://developers.zomato.com/api/v2.1/restaurant?";
const API_key = "223bdf4a4bffe3c07d3766b4be4efa5a";

const config = {
    headers: {
        'user-key': API_key
    }
};

import addToItinerary from '../components/addToItinerary'
import alert from '../components/alert'

//get restaurant URL
function getRestaurant(res_id) {
    return ZomatoBASEURL + "res_id=" + res_id;
}

export default {
    name: 'restaurant',
    components: {
        addToItinerary, alert
    },
    props: ['app', 'res_id', 'user'],
    data() {
        return {
            results: [],
            user_id: "",
            lessHighlights: true,
            highlights: "",
            show_modal: false,
            alertMessage: "",
            show_alert: false,
            restaurantLoaded: false
        }
    },
    mounted() {
        this.viewRestaurant(this.$route.params.res_id);
    },
    methods: {
        viewRestaurant(query) {
            let app = this;
            axios.get(getRestaurant(query), config)
                .then(function(response) {
                  let restaurant = response.data;

                  if (restaurant.featured_image == "") {
                      let img = '/images/default-restaurant.jpg';
                      restaurant.featured_image = img;
                  }

                  app.results = restaurant;
                  app.highlights = app.results.highlights;
                  app.restaurantLoaded = true;
                })
                .catch(function(error) {
                    console.log(error);
                });
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
    },
    computed: {
        showLessHighlights() {
            return this.highlights.slice(0, 4);
        },
        showMoreHighlights() {
            return this.highlights;
        }
    }
}
</script>

<style>
br {
    display: block;
    content: "";
    margin-top: 0px;
    /* line-height:10px; */
}
</style>
