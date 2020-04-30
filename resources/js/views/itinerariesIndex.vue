<template>
<div v-if="itinerariesLoaded">
    <div class="jumbotron jumbotron-fluid index-banner">
        <div class="container">
            <h2>Browse Itineraries</h2>
        </div>
    </div>


    <!---------- LIST OF ITINERARIES ---------->
    <div class="container">
        <div class="row itineraries-row">

            <div class="col-lg-4 col-md-3 col-sm-12"  v-for="itinerary in itineraries">
                <div class="card-d">

                    <router-link :to="{ name: 'itinerary', params: {itinerary_id: itinerary.itinerary.id} }">
                        <div class="itinerary-name">
                            <h3>
                                {{itinerary.days}} in <br />
                                {{itinerary.itinerary.destination}}
                            </h3>
                        </div>
                    </router-link>

                    <p>
                        By <a href="#">{{itinerary.itinerary.user.name}}</a><br />
                        <span>Created on {{moment(itinerary.itinerary.created_at, "YYYY-mm-dddd H:m:s").format('DD MMMM YYYY')}}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!---------- LIST END ---------->

</div>
</template>
<script>
var moment = require('moment')
import alert from '../components/alert';

export default {
    name: 'itinerariesIndex',
    components: {
        alert
    },
    data() {
        return {
            moment: moment,
            itineraries: [],
            images: [],
            user_id: '',
            alertMessage: "",
            show_alert: false,
            itinerariesLoaded: false
        }
    },
    created() {
        this.getUser();
        this.getAllItineraries();
    },
    methods: {
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
        getAllItineraries() {
            let app = this;
            let token = localStorage.getItem("token");
            axios.get('/api/getAllItineraries', {
                    headers: {
                        Authorization: "Bearer " + token
                    }
                })
                .then(function(response) {
                    let itineraries = response.data.data;
                    // app.itineraries = response.data.data;
                    // console.log(app.itineraries);
                    // console.log('itineraries', response.data.data);

                    itineraries.forEach((itinerary) => {
                        let start = moment(itinerary.start_date).subtract(1, 'd');
                        let end = moment(itinerary.end_date);
                        end.from(start); // "in 5 days"
                        let day = end.from(start, true); // "5 days"

                        app.itineraries.push({
                            itinerary: itinerary,
                            days: day
                        });
                        app.itinerariesLoaded = true;
                    })
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        getCityData(city) {
            let app = this;
            axios.get(`/api/get-city/${city}`)
                .then(response => {
                    console.log(response.data.data);
                    let results = response.data.data;

                    results.forEach((result) => {
                        app.images.push(result.image);
                        // console.log('District:', app.district);
                    })
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    }
}
</script>
<style>
</style>
