import Axios from "axios";

const api = {
	properties: {
		token: 'p1'
	},
	requests: [],
	methods: {
		setupWebSocket: function() {
			var promise = new Promise(function(resolve, reject) {
				api.socket = new WebSocket('ws://127.0.0.1:8100');
		
				api.socket.onopen = function (event) {
					console.log('onopen');
					//authenticate
					api.methods.callMethod('org.cah.authenticate', {
						token: api.properties.token
					})
					.then(function(data) {
						console.log('authenticated!');
						console.log(data);
						resolve();
					});
				};
		
				api.socket.onmessage = function (event) {
					console.log('onmessage');
					var data = JSON.parse(event.data);
					var responseId = data.id;
					api.requests[responseId](data);
				};
			});

			return promise;
		},
		callMethod: function(name, parameters) {
			var promise = new Promise(function(resolve, reject) {
				//remember this request
				var requestId = api.methods.getNextRequestId();
				api.requests[requestId] = resolve;
	
				//send the request
				api.socket.send(JSON.stringify({
					call: name,
					id: requestId,
					parameters: parameters,
				}));
			});
			return promise;
		},
		getNextRequestId: function() {
			var i = 0;
			while (api.requests[i]) {
				++i;
			}
			return i;
		}
	},
	calls: {
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
			api.methods.callMethod('org.cah.player.info', null)
			.then(function(data) {
				console.log('got player!');
				console.log(data);
			});
		}
	}
};

export default api;