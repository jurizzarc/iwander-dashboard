<template>
  <div class="container-fluid lg-banner">
        <div class="row full-height">
            <div class="col-12 welcome-col">

                <div class="vertical-center">
                    <div class="row welcome-msg">
                        <h1>
                            Travel planning<br />
                            made easier<br />
                            with iWander
                        </h1>
                        <router-link to="/createItinerary" class="btn btn-tertiary" role="button">Create an Itinerary</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default{
  name: 'home'
}
</script>
