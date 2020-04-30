<template>
    <div>
        <div class="jumbotron jumbotron-fluid itinerary-banner">
            <div class="container">
                <h2>{{duration}} in {{itinerary.destination}}</h2>
                <p>{{moment(itinerary.start_date).format('Do MMMM YYYY')}} &mdash; {{moment(itinerary.end_date).format('Do MMMM YYYY')}}</p>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">

                        <div class="itinerary-info col-lg-3 col-md-3">

                            <div class="action-selection">
                                <div class="row" v-if="trueUser">

                                    <div class="col-12">
                                        <router-link :to="{name: 'addtoitinerary', params: { destination: this.itinerary.destination}, query: {itinerary_id: this.itinerary.id} }" class="btn action-selection-link">
                                            <span class="jam jam-pencil" data-fill="#444" data-width="18" data-height="18"></span> Edit Itinerary
                                        </router-link>
                                    </div>

                                    <div class="col-12">
                                        <a class="btn action-selection-link" href="#" role="button" @click="deleteItinerary(itinerary.id)">
                                            <span class="jam jam-trash" data-fill="#444" data-width="18" data-height="18"></span> Delete Itinerary
                                        </a>
                                    </div>

                                    <div class="col-12">
                                        <a class="btn action-selection-link" href="#" role="button" @click="addToBookmarks(itinerary.id)">
                                            <span class="jam jam-heart" data-fill="#444" data-width="18" data-height="18"></span> Add to Bookmarks
                                        </a>
                                    </div>

                                </div>
                            </div>

                            <div class="itinerary-info-select">
                                <h6>Dates</h6>
                                <form>
                                    <select class="custom-select" v-model="day" @change="getEvents">
                                        <option disabled value="">Select Day</option>
                                        <option :value="date.numFormat" v-for="date in dates">{{date.textFormat}}</option>
                                    </select>
                                </form>
                            </div>

                        </div>

                        <div class="col-lg-8 offset-lg-1 col-md-8 offset-md-1" v-if="loaded">
                            <div class="row items-index">
                            <div class="col-12" v-if="noEvent">
                                <h6>{{message}}</h6>
                            </div>
                                <div class="col-12" v-else v-for="plan in sortByTime">
                                    <div class="card-c">
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

                                            <span class="event-details">
                                                <p>{{moment(plan.start_time, "HH:mm:ss").format('HH:mm')}} to {{moment(plan.end_time, "HH:mm:ss").format('HH:mm')}}</p>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <alert v-if="show_alert" @close="show_alert = false" :alertMessage="alertMessage"> </alert>

        </div>
    </div>
</template>

<script>
var moment = require('moment');
import alert from '../components/alert'

const API_key = "223bdf4a4bffe3c07d3766b4be4efa5a";
const config = {
    headers: {
        'user-key': API_key
    }
};

export default {
    name: 'itinerary',
    props: ['app', 'itinerary_id','user'],
    components: {
      alert
    },
    data() {
        return {
            moment: moment,
            events: [],
            plans: [{
                event_id: '',
                attraction: "",
                attraction_category: "",
                restaurants: ""
            }],
            dates: [{
                id: '',
                textFormat: '',
                numFormat: ''
            }],
            show: false,
            itinerary: "",
            duration: '',
            message: "",
            noEvent: false,
            trueUser: '',
            day: '',
            publicPath: '/images/',
            storagePath: '../storage/images/',
            show_alert: false,
            loaded: false
            // user: ''
        }
    },
    created() {
        let app = this;
        axios.get(`/api/getItineraryByID/${app.itinerary_id}`)
            .then(function(response) {
                app.itinerary = response.data.data;
                //show first day automatically
                app.day = app.itinerary.start_date;

                // console.log('itinerary', app.itinerary);

                app.countDays();
                app.getDates();
                app.checkUser();

                app.getEvents();
                // app.getEventsOnFirstDay();
            })
            .catch(function(error) {
                console.log(error);
            });
    },
    methods: {
        checkUser() {
            let app = this;
            let token = localStorage.getItem("token");
            if(token != null){
              axios.get('/api/user', {
                      headers: {
                          Authorization: "Bearer " + token
                      }
                  })
                  .then(response => {
                      let user_id = response.data.user.id;

                      if (user_id === app.itinerary.user_id) {
                          console.log("SAME USER");
                          app.trueUser = true;
                          app.message = "You have nothing planned on this day!";
                      } else {
                          console.log("NOT THE SAME USER");
                          app.trueUser = false;
                          app.message = "There's nothing planned for this day!"
                      }
                  })
                  .catch(function(error) {
                      console.log(error);
                  });
            }
            else{
              app.trueUser = false;
              app.message = "There's nothing planned for this day!"
            }

        },
        countDays() {
            let app = this;
            //subtract() method to count the first day
            let start = moment(app.itinerary.start_date).subtract(1, 'd');
            let end = moment(app.itinerary.end_date);
            end.from(start); // "in 5 days"
            let day = end.from(start, true); // "5 days"
            app.duration = day;
            console.log("Days:" + app.duration);
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
                    textFormat: "Day " + day + " : " + moment(sDate).format('MMM Do YYYY'),
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
            // app.show = true;
            // app.showFD = false;
            app.events = [];
            axios.get(`/api/getAttractionsByEvent/${app.itinerary_id}`)
                .then(response => {
                    let results = response.data.data;
                    console.log('r', results);
                    results.forEach((event) => {
                      console.log('ev', event);
                        if (event.date == app.day) {
                            app.events.push(event);
                            console.log("success");
                            app.noEvent = false;
                        }
                    })

                    if (app.events.length == 0) {
                        console.log("NO EVENT");
                        app.noEvent = true;
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
                console.log(e.restaurant_id);
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
                    console.log('m',e.attraction.id);
                    axios.get(`/api/getCategoriesOfAttraction/${e.attraction_id}`)
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

            //display events when loaded
            app.loaded = true;
        },
        print() {
            window.print();
        },

        addToBookmarks(id){
          let app = this;
          let token = localStorage.getItem("token");
          if(token!==null){
            let data = {
              user_id: app.user.id,
              restaurant_id: null,
              itinerary_id: id,
              attraction_id: null
            }
            axios.post('/api/createBookmarks', data, {
              headers: { Authorization: "Bearer " + token }
            })
            .then(response => {
              console.log("Itinerary SUCCESSFULLY ADDED TO BOOKMARK");
              // console.log(response.data);
              app.alertMessage = "Added to bookmarks!";
              app.show_alert = true;
            })
            .catch(function(error){
              console.log(error);
            });
          }
          else{
            app.$router.push({name:'login'});
            window.scrollTo(0,0);
          }
        },
        deleteItinerary(id) {
            // console.log('itinerary id:', id);
            let token = localStorage.getItem("token");
            axios.delete(`/api/deleteItinerary/${id}`, {
                    headers: {
                        Authorization: "Bearer " + token
                    }
                })
                .then(response => {
                    console.log(response);
                    this.$router.push({name: 'myprofile'});
                    // this.viewItineraries();
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
    },
    computed: {
        sortByTime() {
            return _.orderBy(this.plans, ['start_time']);
        }
    }
}
</script>
