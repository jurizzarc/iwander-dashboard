<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="modal-form-heading">
                                <h4>Add to Itinerary</h4>
                                <p><span>&ast;</span> &mdash; Required fields</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <form v-on:submit.prevent="addtoitinerary">

                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label class="required" for="itinerary_id">Itinerary</label>
                                        <select class="custom-select" id="itinerary_id" v-model="event.id">
                                        <option disabled value="">Select Itinerary</option>
                                        <option :value="itinerary.id" v-for="itinerary in itineraries">
                                            {{itinerary.destination}} : {{ moment(itinerary.start_date).format('Do MMMM YYYY')}} to {{moment(itinerary.end_date).format('Do MMMM YYYY')}}
                                        </option>
                                        </select>
                                        <span class="errors">{{ getErrors('itinerary_id') }}</span>
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12">
                                        <label class="required" for="start_time">Start time</label>
                                        <input id="start_time" type="time" v-model="event.start_time" class="form-control" name="start_time" autocomplete="start_time" >
                                          <span class="errors">{{ getErrors('start_time') }}</span>
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12">
                                        <label class="required" for="end_time">End time</label>
                                        <input id="end_time" v-model="event.end_time" type="time" class="form-control" name="end_time" autocomplete="end_time" >
                                          <span class="errors">{{ getErrors('end_time') }}</span>
                                    </div>
                                    <div class="form-group col-12">
                                        <label class="required" for="date">Date</label>
                                        <input id="date" v-model="event.date" type="date" class="form-control" name="date" autocomplete="date" >
                                          <span class="errors">{{ getErrors('date') }}</span>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="notes">Notes</label>
                                        <textarea id="notes" v-model="event.notes" type="text" class="form-control" name="notes" autocomplete="notes"></textarea>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>

                                    <div class="col-lg-3 col-sm-6">
                                        <button type="button" class="btn btn-secondary" @click="$emit('close')">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
var moment = require('moment');

export default {
    name: 'addToItinerary',
    props: ['aOr', 'id'],
    components: {},
    mounted() {},
    data() {
        return {
          moment: moment,
            event: {},
            itineraries: "",
            select: "Select Itinerary",
            errors: {}
        }
    },
    mounted() {
        this.getItineraries();
        this.setValues();
    },
    methods: {
        setValues() {
            console.log('aOr', this.aOr);
            console.log('id', this.id);
            if (this.aOr == 0) {
                this.event.attraction_id = this.id;
            } else {
                this.event.restaurant_id = this.id;
            }
        },
        getItineraries() {
            let app = this;
            let token = localStorage.getItem("token");
            axios.get('/api/viewItineraries', {
                    headers: {
                        Authorization: "Bearer " + token
                    }
                })
                .then(response => {
                    let results = response.data.data;
                    app.itineraries = results;
                    console.log(results);
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        addtoitinerary() {
            let app = this;
            axios.post('/api/addtoitinerary', {
                    restaurant_id: app.event.restaurant_id,
                    attraction_id: app.event.attraction_id,
                    start_time: app.event.start_time,
                    end_time: app.event.end_time,
                    date: app.event.date,
                    notes: app.event.notes,
                    itinerary_id: app.event.id
                })
                .then(function(response) {
                    console.log(response.data);
                     app.$emit('submit');
                })
                .catch(function(error) {
                    console.log(error);
                    app.errors = error.response.data.errors;
                    console.log(error);
                });
        },
        getErrors(field){
          if(this.errors[field]){
            return this.errors[field][0];
          }
        },
    },
}
</script>
