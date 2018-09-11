import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

import api from "./api.js";

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
        }
    }
});