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
                          <form v-on:submit.prevent="updateItinerary">
                            <div class="form-row">
                                <div class="form-group col-lg-6 col-sm-12">
                                    <label class="required" for="start_time">Start time</label>
                                    <input id="start_time" type="time" v-model="event.start_time" class="form-control" name="start_time" autocomplete="start_time">
                                    <span class="errors">{{ getErrors('start_time') }}</span>
                                </div>
                                <div class="form-group col-lg-6 col-sm-12">
                                    <label class="required" for="end_time">End time</label>
                                    <input id="end_time" v-model="event.end_time" type="time" class="form-control" name="end_time" autocomplete="end_time">
                                    <span class="errors">{{ getErrors('end_time') }}</span>
                                </div>
                                <div class="form-group col-12">
                                    <label class="required" for="date">Date</label>
                                    <input id="date" v-model="event.date" type="date" class="form-control" name="date" autocomplete="date">
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
export default {
    name: "editEvent",
    props: ['app', 'event_id'],
    components: {

    },
    data() {
        return {
            event: {},
            errors: []
        }
    },
    created() {
        let app = this;
        let token = localStorage.getItem("token");
        axios.get(`/api/edit/event/${app.event_id}`, {
                headers: {
                    'Authorization': 'Bearer ' + token
                },
            })
            .then(function(response) {
                console.log("Event:", response.data);
                app.event = response.data;
                // console.log(app.event);
            })
            .catch(function(error) {
                console.log(error);
            });
    },
    methods: {
        updateItinerary() {
            let app = this;
            axios.post(`/api/update-event/${app.event_id}`, app.event)
                .then(function(response) {
                    console.log(response.data);
                    app.$emit('submit');
                })
                .catch(function(error) {
                    console.log(error);
                    app.errors = error.response.data.errors;
                });
        },
        getErrors(field) {
            if (this.errors[field]) {
                return this.errors[field][0];
            }
        },
    }
}
</script>
<style>
</style>
