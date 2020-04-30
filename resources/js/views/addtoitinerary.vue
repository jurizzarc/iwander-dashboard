<template>
<div>
    <itinerarybuilderNav @proceed="proceed()"></itinerarybuilderNav>
    <div class="jumbotron jumbotron-fluid itinerary-banner">
        <div class="container">
            <h2>{{this.days}} in {{this.$route.params.destination}}</h2>
            <p>{{moment(itinerary.start_date).format('Do MMMM YYYY')}} &mdash; {{moment(itinerary.end_date).format('Do MMMM YYYY')}}</p>
        </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="row">
            <div class="col-lg-3 col-md-3 filters-col d-none d-md-block d-lg-block">
                <h4>Filter</h4>
            </div>
            <div class="col-lg-8 offset-lg-1 col-md-8 offset-md-1">
                <div class="row">
                    <div class="col-12 d-none d-md-block d-lg-block">
                        <div class="sorting-col">
                            <div class="row">
                                <div class="col-lg-3">
                                    <a role="tab" class="nav-link" @click="showAttractions = true"> Attractions
                                    </a>
                                </div>

                                <div class="col-lg-3">
                                    <a role="tab" class="nav-link" @click="showAttractions = false"> Restaurants
                                    </a>
                                </div>
                                <div class="col-lg-6">
                                    <div class="sort-selection" v-if="showAttractions">
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
                                    <div v-else class="sort-selection">
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
              </div>
          </div>
        </div>

      </div>
    </div>
    <div v-if="showAttractions">
      <attractions v-if="dataloaded" :place="destination" :itinerary="itinerary" :sort="sortBy"></attractions>
    </div>
    <div v-else>
      <restaurants v-if="dataloaded" :itinerary="itinerary" :entity_details="this.entity_details" :sort="sortBy"></restaurants>
    </div>
    </div>
</template>
<script>
import itinerarybuilderNav from '../components/itinerarybuilderNav'
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

var moment = require('moment');

import restaurants from '../components/restaurants'
import attractions from '../components/attractions'
import addEvent from '../components/addEvent'

export default {
    name: "addtoitinerary",
    props: ['app', 'destination'],
    components: {
        restaurants,
        addEvent,
        attractions,
        itinerarybuilderNav
    },
    mounted() {
        console.log("Add to itinerary page");
        this.getItinerary();
        this.getCity();
    },
    data() {
        return {
            dataloaded: false,
            moment: moment,
            itinerary: {},
            days: '',
            entity_details: {
                city_id: '',
                entity_id: '',
                entity_type: ''
            },
            showAttractions: true,
            sortBy: '',

        }
    },
    methods: {
      setSortBy(value){
        let app = this;
        app.sortBy = value;
        console.log('va', app.sortBy);
      },
      tabs(){
        this.$emit('showRestaurants', ()=>{
          console.log("www");
        })
      },
        proceed() {
            this.$router.push({
                name: 'saveItinerary',
                query: {
                    itinerary_id: this.itinerary.id,
                    duration: this.days,
                    destination: this.$route.params.destination
                }
            });
            console.log("hu");
        },
        getItinerary() {
            let app = this;
            let token = localStorage.getItem("token");
            axios.get(`/api/getItineraryByID/${this.$route.query.itinerary_id}`, {
                    headers: {
                        Authorization: "Bearer " + token
                    }
                })
                .then(function(response) {
                    app.itinerary = response.data.data;
                    app.countDays();
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        countDays() {
            let app = this;
            //subtract() method to count the first day
            let start = moment(app.itinerary.start_date).subtract(1, 'd');
            let end = moment(app.itinerary.end_date);
            end.from(start);
            let day = end.from(start, true);
            //instead of "a day"
            if (day === 'a day') {
                day = '1 day';
            }
            app.days = day;
            console.log("Days:" + app.days);
        },
        getCity() {
            let app = this;
            axios.get(cityUrl(this.$route.params.destination), config)
                .then(response => {
                    let results = response.data.location_suggestions;
                    console.log('city Data: ', results);
                    results.forEach((result) => {
                        app.entity_details.city_id = result.city_id;
                        app.entity_details.entity_id = result.entity_id;
                        app.entity_details.entity_type = result.entity_type;
                        //data is loaded so restaurant/attraction component can load
                        this.dataloaded = true;
                        this.restaurantDataLoaded = true;
                    })
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
    },
}
</script>

<style scoped>
    .sorting-col .nav-link:active {
        background-color: #2c8cd6;
        color: #fff;
    }
</style>
