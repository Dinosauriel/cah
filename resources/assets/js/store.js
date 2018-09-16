import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import VuexPersistence from 'vuex-persist';

import api from "./api.js";

const vuexLocal = new VuexPersistence({
    storage: window.localStorage
})

export default new Vuex.Store({
    plugins: [vuexLocal.plugin],
    state: {
        websocketConnectionIsActive: false,
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
        setWebsocketConnection(state, value) {
            state.websocketConnectionIsActive = value;
        },
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
                location.href = response.data.relative_route;
            })
        },
    }
});