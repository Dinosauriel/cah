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
        gameList: [],
        //all available cardsets
        cardsets: []
    },
    mutations: {
        setGameList(state, gameList) {
            state.gameList = gameList;
		},
		addGameToList(state, game) {
			state.gameList.push(game);
        },
        setCardsets(state, cardsets) {
            state.cardsets = cardsets;
        }
	},
	actions: {
        setupEventStream: function() {
            Api.calls.pollForEvents(
            function(data) {
                console.log("data received: ");
                console.log(data);
            },
            function(event) {
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
        },
        downloadCardsets: function(context) {
            Api.calls.getCardsets(
                function(cardsets) {
                    context.commit('setCardsets', cardsets);
                },
                function() {
    
                });
        }
    }
});