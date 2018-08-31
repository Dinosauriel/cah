//fetch the csrf Token from the meta tag
window.csrfToken = $("meta[name='csrf-token']").attr("content");

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.Vue = require("vue");
window.Vuex = require("vuex");
Vue.use(Vuex);

window.Axios = require("axios");
window.Api = require("./api/api.js");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component("login-card", require("./components/login-card.vue"));
Vue.component("invite-link", require("./components/games/invitelink.vue"));
Vue.component("game-list", require("./components/lobby/game-list.vue"));
Vue.component("game-list-cell", require("./components/lobby/game-list-cell.vue"));
  
require("./store.js");


const app = new Vue({
    el: "#vue-app",
    //inject store into root component
    store,
	data: function() {
        return {
            stockData: null
        }
    },
    mounted: function() {

	},
});
