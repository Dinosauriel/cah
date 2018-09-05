/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require("vue");
window.Vuex = require("vuex");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const VueNavBar = Vue.component("navbar", require("./components/navbar.vue"));
const VueLoginCard = Vue.component("login-card", require("./components/login-card.vue"));
const VueInviteLink = Vue.component("invite-link", require("./components/games/invitelink.vue"));
const VueCardSelection = Vue.component("cardset-selection", require("./components/games/cardsetselection.vue"));
const VueGameList = Vue.component("game-list", require("./components/lobby/game-list.vue"));
const VueGameListCell = Vue.component("game-list-cell", require("./components/lobby/game-list-cell.vue"));

import store from "./store.js";

const app = new Vue({
    el: "#vue-app",
    //inject store into root component
    store,
    components: {
        VueNavBar,
        VueLoginCard,
        VueInviteLink,
        VueGameList,
        VueGameListCell,
        VueCardSelection
    },
	data: function() {
        return {
            stockData: null
        }
    },
    mounted: function() {
        //this.$store.dispatch('setupEventStream');
        this.$store.dispatch('downloadPlayer');
        this.$store.dispatch('downloadGame');
        this.$store.dispatch('setupWebSocket');
	},
});
