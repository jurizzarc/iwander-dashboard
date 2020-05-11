<template>
    <div class="container">
        <div class="body-content">
            <div class="row">

                <div class="col-12">
                    <h3>How To</h3>
                </div>

                <div class="col-lg-8">
                    <div class="ht-blocks">
                        <div class="row">

                            <div class="col-12">

                                <div class="ht-block">
                                    <h5>How do I create a travel itinerary on iWander?</h5>

                                    <p>
                                        You must first be a registered user on iWander to create a travel itinerary.
                                        <br /> To create one, click the <em>Create an Itinerary</em> button on
                                        the
                                        Home page, or go to <router-link to="/createItinerary">this</router-link> page
                                        after
                                        signing in to the application.
                                    </p>

                                    <ol>
                                        <li>In the form, enter the city of your destination, and the start and end dates
                                            of your trip. Click the <em>Create</em> button.
                                        </li>
                                        <li>
                                            Browse attractions and restaurants on the itinerary builder using the filter
                                            options on the left side of the page and sorting options on the top of the
                                            list of
                                            results. You can also use the <em>Attractions</em> and <em>Restaurants</em>
                                            tabs, which are beside the sorting options.
                                        </li>
                                        <li>Click the <em>Add to Itinerary</em> link on the card component of the
                                            attraction or restaurant of interest to you.
                                            A form will be displayed on the screen, where you must enter the time and
                                            date of your visit. You can also add reminders for yourself in the textbox
                                            of the form.</li>
                                        <li>After adding attractions and/or restaurants to your travel itinerary, click
                                            the <em>Proceed</em> link on the topbar.</li>
                                        <figure>
                                            <img src="/images/itinerary-builder.png" alt="Itinerary Builder">
                                        </figure>
                                        <li>Use the tabs on the left side of the page to see which places you are
                                            visiting for each day of your trip.</li>
                                        <li>You can edit the details of a visit by clicking the <em>Edit</em> link on
                                            the card component of that visit. To delete a visit from
                                            your travel itinerary, click the <em>Delete</em> link on the card component
                                            of that visit.</li>
                                        <li>To finish creating your travel itinerary, click the <em>Save</em> link on
                                            the topbar.</li>
                                        <figure>
                                            <img src="/images/itinerary-builder-2.png" alt="Itinerary Builder">
                                        </figure>
                                    </ol>

                                    <p>
                                        You can also create a travel itinerary on the page of a particular city. Fill in the
                                        form which is below the banner image on the right side of the page, and then
                                        follow steps 2 to 7 listed above.
                                    </p>
                                </div>

                                <div class="ht-block">
                                    <h5>How do I use the bookmark feature?</h5>

                                    <p>The bookmark feature can be used to save attractions, restaurants, and travel
                                        itineraries.</p>
                                    <p>To bookmark an attraction or restaurant...</p>
                                    <ul>
                                        <li>On the page of a specific attraction or restaurant, click the <em>Add to
                                                Bookmarks</em> button, which is placed below the banner image on the
                                            right side of the page.</li>
                                        <figure>
                                            <img src="/images/bookmark1.png" alt="Itinerary Builder">
                                        </figure>
                                        <li>On the page of a particular city, card components are used to display
                                            several attractions and restaurants. Each card component includes the name,
                                            categories, and image of an attraction or restaurant. On top of the image,
                                            there are two small buttons: the heart button and the plus button. Click the
                                            <em>heart</em> button on the card component of the attraction or restaurant
                                            that is of interest to you.</li>
                                        <figure>
                                            <img src="/images/bookmark2.png" alt="Itinerary Builder">
                                        </figure>
                                        <li>While browsing all attractions or restaurants, a different type of card
                                            component is also used to display each attraction and restaurant. This
                                            includes the name, address, and image of an attraction or restaurant. Beside
                                            the image, the card component also contains links. Click the <em>Add to
                                                Bookmarks</em> link on the card component to bookmark an attraction or
                                            restaurant. </li>
                                        <figure>
                                            <img src="/images/bookmark3.png" alt="Itinerary Builder">
                                        </figure>
                                    </ul>

                                    <p>To bookmark a travel itinerary...</p>
                                    <ol>
                                        <li>Click the <em>Browse</em> link on the navigation bar. You will then see a
                                            page that displays all travel itineraries created by various users of the
                                            application. When you click on any travel itinerary, you are lead to the
                                            page of that travel itinerary.</li>
                                        <li>On that page, click the <em>Add to Bookmarks</em> button, which is placed
                                            underneath the banner on the left.</li>
                                    </ol>
                                </div>

                                <div class="ht-block">
                                    <h5>How can I view the items I have bookmarked?</h5>
                                    <ol>
                                        <li>Click the <em>Profile</em> link on the navigation bar. This will lead you to
                                            your profile page.</li>
                                        <li>On your profile page, click the <em>Bookmarks</em> tab to view the
                                            attractions, restaurants, and/or travel itineraries you have bookmarked.
                                        </li>
                                    </ol>
                                </div>

                                <div class="ht-block">
                                    <h5>How can I edit a travel itinerary I have created?</h5>
                                    <ol>
                                        <li>Go to your profile page by clicking the <em>Profile</em> link on the
                                            navigation bar.</li>
                                        <li>Under the <em>Itineraries</em> tab is a list of travel itineraries you have
                                            created. Click the link to the travel itinerary that you want to edit.</li>
                                        <li>On the left side of the page, click the <em>Edit Itinerary</em> button below
                                            the banner.</li>
                                    </ol>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default{
  name: 'howto',
  components: {},
  data(){
    return{

    }
  }
}
</script>