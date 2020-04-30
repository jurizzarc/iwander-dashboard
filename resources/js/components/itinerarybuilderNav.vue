<template>
  <div class="navbar-container">
        <nav class="navbar builder-nav fixed-top navbar-expand-md">
            <div class="container">

                <div class="mr-auto order-1">
                    <a class="builder-prev" @click="$router.go(-1)">
                        <h5>Back</h5>
                    </a>
                </div>

                    <div v-if="!this.saveItinerary === true" class="ml-auto order-2">
                        <a class="builder-next" @click="$emit('proceed')">
                            <h5>Proceed</h5>
                        </a>
                    </div>
                    <div v-else class="ml-auto order-2">
                        <a class="builder-next" @click="$emit('save')">
                            <h5>Save</h5>
                        </a>
                    </div>
            </div>
        </nav>
    </div>
</template>
<script>
import autocomplete from './autocomplete'
export default {
    name: 'itinerarybuilderNav',
    props: ['itinerary_id', 'saveItinerary'],
    components: {
        autocomplete
    },
    methods:{
    }
}
</script>
<style>
</style>
