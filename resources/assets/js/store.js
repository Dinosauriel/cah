import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

import api from "./api.js";

export default new Vuex.Store({
    state: {
        //the game currently participating in
        game: {},
        //player
        player: {},
        //list of games
        gameList: [],
        //all available cardsets
        cardsets: []
    },
    mutations: {
        setGameList(state, gameList) {
            state.gameList = gameList;
		},
        setCardsets(state, cardsets) {
            state.cardsets = cardsets;
        },
        setPlayer(state, player) {
            state.player = player;
        },
        setCurrentGame(state, game) {
            state.game = game;
        }
	},
	actions: {
        updatePlayer(context) {
            api.methods.callMethod('org.cah.player.info', null)
			.then(function(response) {
				context.commit('setPlayer', response.data);
			});
        },
        updateCardsets(context) {
            api.methods.callMethod('org.cah.cardset.list', null)
			.then(function(response) {
                context.commit('setCardsets', response.data);
			});
        },
        updateGameList(context) {
            api.methods.callMethod('org.cah.game.list', null)
            .then(function(response) {
                context.commit('setGameList', response.data);
            });
        },
        deleteGame(context, gameId) {
            api.methods.callMethod('org.cah.game.delete', {gameId: gameId})
            .then(function(response) {
                context.dispatch('updateGameList');
            });
        },
        createGame(context) {
            api.methods.callMethod('org.cah.game.create')
            .then(function(response) {
                context.dispatch('updateGameList');
            });
        },
        joinGame(context, gameId) {
            api.methods.callMethod('org.cah.game.join', {gameId: gameId})
            .then(function(response) {
                context.commit('setCurrentGame', response.data);
            })
        },
    }
});