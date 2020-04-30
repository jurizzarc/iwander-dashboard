<template>
<div>
    <!---------- ITEM BANNER ---------->
    <div class="jumbotron jumbotron-fluid item-banner" v-if="attractionLoaded">
        <img v-if="attraction.details.image === 'default-image.png'" :src="publicPath + attraction.details.image" />
        <img v-else :src="storagePath + attraction.details.image" />
    </div>

    <!---------- CONTENT START ---------->
    <div class="container" v-if="attractionLoaded">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-7 col-sm-12">
                        <div class="main-heading order-lg-1 order-sm-1">
                            <h1>{{attraction.name}}</h1>
                            <h6 v-for="category in categories_name" class="subheading">{{category}}</h6>
                        </div>

                        <div class="iwander-desc order-lg-2">
                            <p>
                                {{attraction.details.description}}
                            </p>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="add-info">
                                    <h6>Location</h6>
                                    <p>{{ attraction.addresses.address1}},
                                        {{ attraction.addresses.address2}}
                                        {{ attraction.addresses.address3}}
                                        {{ attraction.addresses.postal_code}},
                                        {{ attraction.addresses.city.name}},
                                        {{ attraction.addresses.city.districts.name}},
                                        {{ attraction.addresses.city.districts.country.name}}</p>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="add-info">
                                    <h6>Contact</h6>
                                    <p>
                                        {{attraction.details.phone}}<br />
                                        <a :href="attraction.details.website">{{attraction.details.website}}</a><br />
                                        <a href="#">{{attraction.details.email}}</a>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-4 offset-lg-1">

                        <div class="action-selection">
                            <!-- <a class="btn action-selection-link" href="#" role="button" style="margin-bottom:30px;" @click="addToBookmarks(attraction.id)">
                                <jam-heart></jam-heart> Add to Bookmarks
                            </a> -->
                            <a class="btn action-selection-link" href="#" role="button" style="margin-bottom:30px;" @click="addToBookmarks(attraction.id)">
                                <span class="jam jam-heart" data-jam="heart" data-fill="#444" data-width="18" data-height="18"></span> Add to Bookmarks
                            </a>

                            <a class="btn action-selection-link" href="#" role="button" style="margin-bottom:30px;" @click="addToItinerary(1, attraction.id)">
                                <span class="jam jam-plus" data-jam="plus" data-fill="#444" data-width="18" data-height="18"></span> Add to Itinerary
                            </a>
                        </div>

                        <div class="add-info">
                            <h6>Recommended Duration</h6>
                            <p>{{attraction.rec_duration}}</p>
                        </div>

                        <div class="add-info">
                            <h6>Admission</h6>
                            <p>&euro;{{attraction.details.min_price}}&dash;{{attraction.details.max_price}}</p>
                        </div>

                        <div class="add-info">
                            <h6>Hours</h6>
                            <table class="hours-table">
                                <tr>
                                    <td class="day">Sunday</td>
                                    <td>{{businessHours[0].open_time}} <span v-if="businessHours[0].open_time !== 'CLOSED'">&dash;</span> {{businessHours[0].close_time}}</td>
                                </tr>

                                <tr>
                                    <td class="day">Monday</td>
                                    <td>{{businessHours[1].open_time}} <span v-if="businessHours[1].open_time !== 'CLOSED'">&dash;</span> {{businessHours[1].close_time}}</td>
                                </tr>

                                <tr>
                                    <td class="day">Tuesday</td>
                                    <td>{{businessHours[2].open_time}} <span v-if="businessHours[2].open_time !== 'CLOSED'">&dash;</span> {{businessHours[2].close_time}}</td>
                                </tr>

                                <tr>
                                    <td class="day">Wednesday</td>
                                    <td>{{businessHours[3].open_time}} <span v-if="businessHours[3].open_time !== 'CLOSED'">&dash;</span> {{businessHours[3].close_time}}</td>
                                </tr>

                                <tr>
                                    <td class="day">Thursday</td>
                                    <td>{{businessHours[4].open_time}} <span v-if="businessHours[4].open_time !== 'CLOSED'">&dash;</span> {{businessHours[4].close_time}}</td>
                                </tr>

                                <tr>
                                    <td class="day">Friday</td>
                                    <td>{{businessHours[5].open_time}} <span v-if="businessHours[5].open_time !== 'CLOSED'">&dash;</span> {{businessHours[5].close_time}}</td>
                                </tr>

                                <tr>
                                    <td class="day">Saturday</td>
                                    <td>{{businessHours[6].open_time}} <span v-if="businessHours[6].open_time !== 'CLOSED'">&dash;</span> {{businessHours[6].close_time}}</td>
                                </tr>
                            </table>
                        </div>

                    </div>


                </div>
            </div>
        </div>

        <!---------- SECTION START ---------->
        <div class="row">
            <div class="iwander-section">

                <div class="col-12 section-heading">
                    <h3>Similar Attractions</h3>
                </div>

                <!-- ATTRACTIONS LIST START -->
                <div class="col-12">
                    <div class="row">

                        <div v-if="isLoaded" class="col-12 col-lg-4 col-md-6" v-for="attraction in uniqueAttractions.slice(0,6)" :key="attraction.id">
                            <div class="card-b">
                                <!-- CARD BUTTONS -->
                                <div class="card-buttons">
                                    <a href="#" class="card-action" title="Add to Bookmarks" @click="addToBookmarks(attraction.similarAttraction.id)">
                                        <span class="jam jam-heart" data-jam="heart" data-fill="#444" data-width="18" data-height="18"></span>
                                    </a>

                                    <a href="#" class="card-action" title="Add to Travel Itinerary" @click="addToItinerary(0, attraction.similarAttraction.id)">
                                        <span class="jam jam-plus" data-jam="plus" data-fill="#444" data-width="18" data-height="18"></span>
                                    </a>
                                </div>

                                <a href="#">
                                    <!-- CARD IMAGE -->
                                    <div class="card-b-img">
                                        <img v-if="attraction.similarAttraction.details.image === 'default-image.png'" :src="publicPath + attraction.similarAttraction.details.image" class="img-fluid" />
                                        <img v-else :src="storagePath + attraction.similarAttraction.details.image" class="img-fluid" />
                                    </div>
                                    <!-- CARD BODY -->
                                    <div class="card-b-body">
                                        <ul class="list-inline">
                                            <li v-for="category in attraction.attraction_category.split(',')" class="category">{{category}} </li>
                                        </ul>
                                        <router-link :to="{ name: 'attraction', params: {att_id: attraction.similarAttraction.id} }">
                                            <h6>{{attraction.similarAttraction.name}}</h6>
                                        </router-link>
                                    </div>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- ATTRACTIONS LIST END -->

            </div>
        </div>
        <!---------- SECTION END ---------->
    </div>
    <addToItinerary v-if="show_modal" @submit="show_modal = false" @close="show_modal = false" :aOr="addToItineraryKey" :id="addToItineraryID"> </addToItinerary>
    <alert v-if="show_alert" @close="show_alert = false" :alertMessage="alertMessage"> </alert>

</div>
</template>
<script>
import addToItinerary from '../components/addToItinerary'
import alert from '../components/alert'


var moment = require('moment');

export default {
    name: 'attraction',
    components: {
        addToItinerary, alert
    },
    props: ['app', 'att_id', 'user'],
    data() {
        return {
            moment: moment,
            attraction: [],
            show_modal: false,
            categories: [],
            similarAttractions: [],
            publicPath: '/images/',
            storagePath: '../storage/images/',
            businessHours: [],
            categories_name: [],
            isLoaded: false,
            attractionLoaded: false,
            alertMessage: "",
            show_alert: false,
        }
    },
    watch: {
        //watch if city prop changes
        //rerender the component
        att_id: function(newVal, oldVal) {
            immediate: true,
            console.log('prop changed: ', newVal, '| was: ', oldVal);
            this.debouncedGetAttraction();
            window.scrollTo(0, 0); //scroll to top of the window
        }
    },
    created() {
        this.debouncedGetAttraction = _.debounce(this.getAttraction);
    },
    mounted() {
        this.getAttraction();
        this.getCategory();
        // this.getSimilarAttractions();
    },
    methods: {
        getAttraction() {
            let app = this;
            // console.log(app.att_id);
            axios.get(`/api/getAttraction/${app.att_id}`)
                .then(response => {
                    app.attraction = response.data.data;
                    app.businessHours = response.data.hours;

                    app.businessHours.forEach((hours) => {
                      if(hours.open_time === null && hours.close_time === null){
                        hours.open_time = "CLOSED";
                      }
                      else{
                          hours.open_time = moment(hours.open_time, "HH:mm:ss").format('HH:mm');
                          hours.close_time = moment(hours.close_time, "HH:mm:ss").format('HH:mm');
                      }
                    });

                    app.attractionLoaded = true;
                    // console.log('attraction:',attractionData);
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
                // window.scrollTo(0, 0);
            }
        },
        getCategory() {
            let app = this;
            axios.get(`/api/getCategoriesOfAttraction/${app.att_id}`)
                .then(response => {
                    let results = response.data.data;
                    results.forEach((category) => {
                        let category_id = category.id;
                        app.categories.push(category_id);
                        app.categories_name.push(category.name);
                    })
                    app.getSimilarAttractions();
                    // console.log('categories', app.categories);

                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        getSimilarAttractions() {
            let app = this;
            axios.get(`/api/getAttractionsByCategories/${app.categories}/${app.attraction.addresses.city.name}`)
                .then(response => {
                    let results = response.data.data;
                    let res_id = '';
                    console.log(results);
                    // console.log(response);
                    results.forEach((res) => {
                        // console.log(res);
                        if (res.name === app.attraction.name) {
                            res_id = res.id;
                            //remove attraction from similarAttractions array
                            results.slice(res_id, 1);
                        }

                        //get lists of categories of each attraction
                        axios.get(`/api/getCategoriesOfAttraction/${res.id}`)
                            .then(response => {
                                let categories = [];
                                let categoriesResults = response.data.data.slice(0, 2);
                                categoriesResults.forEach((res) => {
                                    categories.push(res.name);
                                })

                                let categ = categories.join(' , ');
                                app.similarAttractions.push({
                                    id: res.id,
                                    similarAttraction: res,
                                    attraction_category: categ
                                });
                                // app.similarAttractions = _.shuffle(app.similarAttractions);
                                // app.similarAttractions = _.uniqBy(this.similarAttractions, 'id');
                            })
                            .catch(function(error) {
                                console.log(error);
                            });

                    })
                })
                .catch(function(error) {
                    console.log(error);
                });
                app.isLoaded = true;
        }
    },
    computed: {
        uniqueAttractions() {
            return _.uniqBy(this.similarAttractions, 'id');
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
