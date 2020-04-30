import home from './views/home';
import login from './views/login';
import register from './views/register';
import createItinerary from './views/createItinerary';
import searchIndex from './views/searchIndex';
import restaurant from './views/restaurant';
import myprofile from './views/myprofile';
import addtoitinerary from './views/addtoitinerary';
import saveItinerary from './views/saveItinerary';
import itinerariesIndex from './views/itinerariesIndex';
import howto from './views/howto';
import moreRestaurants from './views/moreRestaurants';
import attraction from './views/attraction';
import moreAttractions from './views/moreAttractions';
import itinerary from './views/itinerary';
import settings from './views/settings';

export default[
  {
    path: '/',
    component: home,
    name: 'home',
    meta: { hideFooter: true }
  },
  {
    path: '/sign-in',
    component: login,
    name: 'login',
  },
  {
    path: '/register-account',
    component: register,
    name: 'register',
    // meta: {registered: false}
  },
  {
    path: '/createItinerary',
    component: createItinerary,
    name: 'createItinerary',
    meta: {
            //if user is not signed in - reroute to sign in page
            authRequired: true }

  },
  {
    path: '/search/:city',
    component: searchIndex,
    name: 'searchIndex',
    props: true
  },
  {
    path: '/restaurant/:res_id',
    component: restaurant,
    name: 'restaurant',
    props: true
  },
  {
    path: '/my-profile/',
    component: myprofile,
    name: 'myprofile',
    props: true,
    meta: {authRequired: true}
  },
  {
    path: '/add-to-itinerary/:destination',
    component: addtoitinerary,
    name: 'addtoitinerary',
    props: true,
    meta: {
            //hide components
            hideFooter: true,
            hideNavigation: true,

            //if user is not signed in - reroute to sign in page
            authRequired: true}
  },
  {
    path: '/save-itinerary',
    component: saveItinerary,
    name: 'saveItinerary',
    props: true,
    meta: {
            //hide components
            hideFooter: true,
            hideNavigation: true,
            //if user is not signed in - reroute to sign in page
            authRequired: true}
  },
  {
    path: '/itinerariesIndex',
    component: itinerariesIndex,
    name: 'itinerariesIndex',
    props: true
  },
  {
    path: '/howto',
    component: howto,
    name: 'howto',
    props: true
  },
  {
    path: '/more-restaurants/:entity_id',
    component: moreRestaurants,
    name: 'moreRestaurants',
    props: true
  },
  {
    path: '/attraction/:att_id',
    component: attraction,
    name: 'attraction',
    props: true
  },
  {
    path: '/more-attractions',
    component: moreAttractions,
    name: 'moreAttractions',
    props: true
  },
  {
    path: '/itinerary/:itinerary_id',
    component: itinerary,
    name: 'itinerary',
    props: true
  },
  {
    path: '/edit-profile/',
    component: settings,
    name: 'settings',
    props: true,
    meta: { authRequired: true }
  },
]
