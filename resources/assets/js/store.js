import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

import Api from "./api/api.js";

export default new Vuex.Store({
    state: {
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
        setGame(state, game) {
            state.game = game;
        },
        setCardsets(state, cardsets) {
            state.cardsets = cardsets;
        },
        setPlayer(state, player) {
            state.player = player;
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
        setupWebSocket: function() {
            Api.calls.setupWebSocket(
                function(event) {

                },
                function(event) {
                    
                }
            );
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
        },
        downloadPlayer: function(context) {
            Api.calls.getPlayer(
                function(player) {
                    context.commit('setPlayer', player);
                },
                function() {
    
                });
        },
        downloadGame: function(context) {
            Api.calls.getGame(
                '/api/games/gameA',
                function(game) {
                    context.commit('setGame', game);
                },
                function() {
    
                });
        }
    }
});