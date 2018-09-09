import Axios from "axios";

const api = {
	properties: {
		token: 'p1'
	},
	calls: {
		setupWebSocket: function(responseHandler, errorHandler) {
			var socket = new WebSocket('ws://127.0.0.1:8100');

			socket.onopen = function (event) {
				console.log("onopen");
				socket.send(JSON.stringify({
					call: 'org.cah.authenticate',
					parameters: {
						token: api.properties.token
					},
				}));

				socket.send(JSON.stringify({
					call: 'org.cah.player.info',
				})); 
			};

			socket.onmessage = function (event) {
				console.log("onmessage");
				console.log(event.data);
			}
		},
		getGameList: function(responseHandler, errorHandler) {
			Axios.post('/api/games', {
				cah_token: api.properties.token
			})
			.then(response => {
				responseHandler(response.data.content);
			})
		},
		deleteGame: function(gameRoute) {
			Axios.delete(gameRoute, {
				data: {
					cah_token: api.properties.token
				}
			})
		},
		getGame: function(gameRoute, responseHandler, errorHandler) {
			Axios.post(gameRoute, {
				cah_token: api.properties.token
			})
			.then(response => {
				responseHandler(response.data.content);
			})
		},
		getCardsets: function(responseHandler, errorHandler) {
			Axios.post('/api/cardsets', {
				cah_token: api.properties.token
			})
			.then(response => {
				responseHandler(response.data.content);
			})
		},
		getPlayer: function(responseHandler, errorHandler) {
			Axios.post('/api/player', {
				cah_token: api.properties.token
			})
			.then(response => {
				responseHandler(response.data.content);
			})
		}
	}
};

export default api;