import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

import Api from "./api/api.js";

export default new Vuex.Store({
    state: {
        test: 1,
        //the game currently participating in
        game: {
            name: "",
            pointsRequired: 0,
        },
        //player
        player: {
            username: "",
            is_admin: false,
        },
        //list of games
        gameList: []
    },
    mutations: {
        setGameList(state, gameList) {
            state.gameList = gameList;
		},
		addGameToList(state, game) {
			state.gameList.push(game);
		}
	},
	actions: {
        setupEventStream: function() {
            Api.calls.pollForEvents(
            function() {
                console.log("event");
            },
            function() {
                console.log("error");
            });
        },
        downloadGameList: function(context) {
            Api.calls.getGameList(
            function(games) {
                context.commit('setGameList', games);
            },
            function() {

            });
		}
    }
});