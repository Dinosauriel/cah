//fetch the csrf Token from the meta tag
window.csrfToken = $("meta[name='csrf-token']").attr("content");

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.Vue = require("vue");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component("login-card", require("./components/login-card.vue"));
Vue.component("invite-link", require("./components/games/invitelink.vue"));

const app = new Vue({
	el: "#vue-app",
	data: {
        stockData: null
    },
    created() {
        this.setupStream();
	},
    methods: {
        setupStream() {
            var es = new EventSource('/api/poll?cah_token=p1');

			es.addEventListener('message', event => {
				//console.log(event);
                let data = JSON.parse(event.data);
                this.stockData = data.stockData;
			}, false);
			
			es.addEventListener('joined', event => {
				console.log('event received!: ' + event);
			});
			
			es.addEventListener('error', event => {
                if (event.readyState == EventSource.CLOSED) {
                    console.log('Event was closed');
                    console.log(EventSource);
                }
            }, false);
        }
    }
});
