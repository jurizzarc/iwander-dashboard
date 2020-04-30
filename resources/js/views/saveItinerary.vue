<template>
    <div>

        <itinerarybuilderNav @save="save()" :saveItinerary="true"></itinerarybuilderNav>

        <div class="jumbotron jumbotron-fluid itinerary-banner">
            <div class="container">
                <h2>{{this.$route.query.duration}} in {{this.$route.query.destination}}</h2>
                <p>{{moment(itinerary.start_date).format('Do MMMM YYYY')}} &mdash; {{moment(itinerary.end_date).format('Do MMMM YYYY')}}</p>
            </div>
        </div>

        <div class="container">
            <div class="row">

                <div class="col-12">
                    <div class="row">

                        <div class="col-lg-3 col-md-3">
                            <div class="date-selection">
                                <ul class="list-group" v-for="date in dates">

                                    <li class="list-group-item">
                                        <a class="btn date-selection-link" @click="setDate(date.numFormat)" role="button"> {{date.textFormat}} </a>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-8 offset-lg-1 col-md-8 offset-md-1">
                            <div class="row items-index">

                            <div class="col-12" v-if="noEvent">
                                <h6>{{message}}</h6>
                            </div>

                                <div v-else class="col-12">
                                    <div class="card-c" v-if="showFD" v-for="plan in FDsortByTime" :key="plan.id">
                                        <div class="card-c-img" v-if="plan.attraction === null">
                                            <img :src="plan.restaurants.featured_image" alt="Card image">
                                        </div>

                                        <div class="card-c-img" v-else>
                                        <img v-if="plan.attraction.details.image === 'default-image.png'" class="img-fluid" :src="publicPath + plan.attraction.details.image" :img-alt="plan.attraction.name" />
                                        <img class="img-fluid" :src="storagePath + plan.attraction.details.image" :img-alt="plan.attraction.name" />
                                        </div>

                                        <div class="card-c-body">
                                            <div v-if="plan.attraction === null">
                                                <a>
                                                    <router-link :to="{ name: 'restaurant', params: {res_id: plan.restaurants.id}}" target="_blank">
                                                        <h6>{{plan.restaurants.name}}</h6>
                                                    </router-link>
                                                </a>
                                                <p class="address">{{plan.restaurants.location.address}}</p>
                                            </div>

                                            <div v-else>
                                                <a>
                                                    <router-link :to="{ name: 'attraction', params: {att_id: plan.attraction.id} }" target="_blank">
                                                        <h6>{{plan.attraction.name}}</h6>
                                                    </router-link>
                                                </a>
                                                <p class="address">
                                                    {{plan.attraction.addresses.address1}}, {{plan.attraction.addresses.city.name}}, {{plan.attraction.addresses.city.districts.name}}
                                                </p>
                                            </div>

                                            <span class="card-c-button">
                                                <p>{{moment(plan.start_time, "HH:mm:ss").format('HH:mm')}} to {{moment(plan.end_time, "HH:mm:ss").format('HH:mm')}}</p>
                                                <a class="edit" @click="showModal(plan.event_id)">
                                                    Edit
                                                </a>
                                                <a class="delete" @click="deleteEvent(0, plan.event_id)">
                                                    Delete
                                                </a>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="card-c" v-if="show" v-for="plan in sortByTime" :key="plan.id">
                                        <div class="card-c-img" v-if="plan.attraction === null">
                                            <img :src="plan.restaurants.featured_image" alt="Card image">
                                        </div>

                                        <div class="card-c-img" v-else>
                                                <img v-if="plan.attraction.details.image === 'default-image.png'" class="img-fluid" :src="publicPath + plan.attraction.details.image" :img-alt="plan.attraction.name" />
                                                <img class="img-fluid" :src="storagePath + plan.attraction.details.image" :img-alt="plan.attraction.name" />
                                        </div>

                                        <div class="card-c-body">
                                            <div v-if="plan.attraction === null">
                                                <a>
                                                    <router-link :to="{ name: 'restaurant', params: {res_id: plan.restaurants.id}}" target="_blank">
                                                        <h6>{{plan.restaurants.name}}</h6>
                                                    </router-link>
                                                </a>
                                                <p class="address">{{plan.restaurants.location.address}}</p>
                                            </div>

                                            <div v-else>
                                                <a>
                                                    <router-link :to="{ name: 'attraction', params: {att_id: plan.attraction.id} }" target="_blank">
                                                        <h6>{{plan.attraction.name}}</h6>
                                                    </router-link>
                                                </a>
                                                <p class="address">{{plan.attraction.addresses.address1}}, {{plan.attraction.addresses.city.name}}, {{plan.attraction.addresses.city.districts.name}}
                                                </p>
                                            </div>

                                            <span class="card-c-button">
                                                <p>{{moment(plan.start_time, "HH:mm:ss").format('HH:mm')}} to {{moment(plan.end_time, "HH:mm:ss").format('HH:mm')}}</p>
                                                <a class="edit" @click="showModal(plan.event_id)">
                                                    Edit
                                                </a>
                                                <a class="delete" @click="deleteEvent(1, plan.event_id)">
                                                    Delete
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <editEvent v-if="show_modal" @submit="hide()" @close="show_modal = false" :event_id="this.event_id"> </editEvent>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</template>
<script>
var moment = require('moment');

import itinerarybuilderNav from '../components/itinerarybuilderNav'
import editEvent from '../components/editEvent'

const API_key = "223bdf4a4bffe3c07d3766b4be4efa5a";
const config = {
    headers: {
        'user-key': API_key
    }
};

export default {
    name: 'saveItinerary',
    props: ['app', 'event', 'itinerary_id'],
    components: {
        editEvent,
        itinerarybuilderNav
    },
    data() {
        return {
            moment: moment,
            events: [],
            plans: [],
            dates: [],
            itinerary: "",
            show: false,
            show_modal: false,
            message: "",
            noEvent: false,
            event_id: "",
            date: '',
            FDEvents: [],
            FDPlans: [],
            showFD: true,
            FDdate: '',
            publicPath: '/images/',
            storagePath: '../storage/images/'
        }
    },
    created() {
        //get itinerary by id
        let app = this;
        let token = localStorage.getItem("token");
        axios.get(`/api/getItineraryByID/${this.$route.query.itinerary_id}`, {
                headers: {
                    Authorization: "Bearer " + token
                }
            })
            .then(function(response) {
                app.itinerary = response.data.data;
                app.FDdate = app.itinerary.start_date;
                app.getDates();
                app.getEventsOnFirstDay();
            })
            .catch(function(error) {
                console.log(error);
            });
    },
    mounted() {
        console.log("this is mounted");
    },
    methods: {
        save() {
            this.$router.push({
                name: 'myprofile'
            });
        },
        setDate(date) {
            console.log(date);
            this.date = date;
            this.getEvents();
        },
        hide() {

            if (this.FDdate === null) {
                this.getEvents();
            } else {
                this.getEventsOnFirstDay();
            }
            this.show_modal = false;
            // console.log('updated!');
        },
        getDates() {
            let app = this;
            let tempDates = [];
            let sDate = moment(app.itinerary.start_date);
            let eDate = moment(app.itinerary.end_date);
            let day = 1;
            while (sDate <= eDate) {
                // get the max id in the list and add 1 to it
                const newId = Math.max.apply(null, app.dates.map(t => t.id)) + 1;
                tempDates.push({
                    id: newId,
                    textFormat: "Day " + day + " : " + moment(sDate).format('Do MMMM YYYY'),
                    numFormat: moment(sDate).format('YYYY-MM-DD')
                });
                sDate = moment(sDate).add(1, 'days');
                day++;
            }
            //remove empty arrays
            app.dates = tempDates.filter(val => (val !== undefined) && (val !== null));
        },
        getEvents() {
            let app = this;
            app.FDdate = null;
            //show next day events
            app.show = true;
            //hide first day events
            app.showFD = false;
            app.events = [];
            let token = localStorage.getItem("token");
            axios.get(`/api/getAttractionsByEvent/${this.$route.query.itinerary_id}`, {
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                })
                .then(response => {
                    let results = response.data.data;
                    results.forEach((event) => {
                        if (event.date == app.date) {
                            app.events.push(event);
                            // console.log("success");
                            app.noEvent = false;
                        }
                    })
                    if (app.events.length == 0) {
                        console.log("NO EVENT");
                        app.noEvent = true;
                        app.message = "You have nothing planned on this day!";
                    }
                    console.log('events', app.events);
                    app.viewEvents();
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        viewEvents() {
            let app = this;
            let results = [];
            app.plans = [];
            app.events.forEach((e) => {
                // console.log(e.restaurant_id);
                if ((e.restaurant_id !== null)) {
                    axios.get(`https://developers.zomato.com/api/v2.1/restaurant?res_id=${e.restaurant_id}`, config)
                        .then(response => {
                            results = response.data;

                            app.plans.push({
                                event_id: e.id,
                                start_time: e.start_time,
                                end_time: e.end_time,
                                attraction: null,
                                attraction_category: null,
                                restaurants: results
                            });
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                } else {
                    // console.log(e.attraction);
                    axios.get(`/api/getCategoriesOfAttraction/${e.attraction.id}`)
                        .then(response => {

                            let categories = [];
                            let categoriesResults = response.data.data;
                            categoriesResults.forEach((res) => {
                                categories.push(res.name);
                            })
                            categories = categories.join(', ');
                            app.plans.push({
                                event_id: e.id,
                                start_time: e.start_time,
                                end_time: e.end_time,
                                attraction: e.attraction,
                                attraction_category: categories,
                                restaurants: null
                            });
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                }
            })
        },
        showModal(event_id) {
            let app = this;
            app.show_modal = true;
            app.event_id = event_id;
        },
        deleteEvent(key, id) {
            //key = 0 -> delete event from first day
            let token = localStorage.getItem("token");
            if (key === 0) {
                axios.delete(`/api/deleteEvent/${id}`, {
                        headers: {
                            Authorization: "Bearer " + token
                        }
                    })
                    .then(response => {
                        console.log(response);
                        this.getEventsOnFirstDay();
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
            //delete event from other days
            else {
                axios.delete(`/api/deleteEvent/${id}`, {
                        headers: {
                            Authorization: "Bearer " + token
                        }
                    })
                    .then(response => {
                        console.log(response);
                        this.getEvents();
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
        },
        getEventsOnFirstDay() {
            let app = this;
            app.showFD = true;
            app.FDEvents = [];
            let token = localStorage.getItem("token");
            axios.get(`/api/getAttractionsByEvent/${this.$route.query.itinerary_id}`, {
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                })
                .then(response => {
                    let results = response.data.data;
                    results.forEach((event) => {
                        if (event.date == app.itinerary.start_date) {
                            app.FDEvents.push(event);
                            // console.log("success");
                            app.noEvent = false;
                        }
                    })

                    if (app.FDEvents.length == 0) {
                        console.log("NO EVENT");
                        app.noEvent = true;
                        app.message = "You have nothing planned on this day!";
                    }
                    console.log('events', app.FDEvents);
                    app.viewEventsOfFD();
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        viewEventsOfFD() {
            let app = this;
            let results = [];
            app.FDPlans = [];
            app.FDEvents.forEach((e) => {
                // console.log(e.restaurant_id);
                if ((e.restaurant_id !== null)) {
                    axios.get(`https://developers.zomato.com/api/v2.1/restaurant?res_id=${e.restaurant_id}`, config)
                        .then(response => {
                            results = response.data;
                            app.FDPlans.push({
                                event_id: e.id,
                                start_time: e.start_time,
                                end_time: e.end_time,
                                attraction: null,
                                attraction_category: null,
                                restaurants: results
                            });
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                } else {
                    // console.log(e.attraction);
                    axios.get(`/api/getCategoriesOfAttraction/${e.attraction.id}`)
                        .then(response => {
                            let categories = [];
                            let categoriesResults = response.data.data;
                            categoriesResults.forEach((res) => {
                                categories.push(res.name);
                            })
                            categories = categories.join(', ');
                            app.FDPlans.push({
                                event_id: e.id,
                                start_time: e.start_time,
                                end_time: e.end_time,
                                attraction: e.attraction,
                                attraction_category: categories,
                                restaurants: null
                            });
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                }
            })
        },
    },
    computed: {
        FDsortByTime() {
            return _.orderBy(this.FDPlans, ['start_time']);
        },
        sortByTime() {
            return _.orderBy(this.plans, ['start_time']);
        }
    }

}
</script>

<style>
    .days {
        padding: 15px;
        border: 2px solid black;
    }
</style>
