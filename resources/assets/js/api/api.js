import Axios from "axios";

const api = {
	properties: {
		token: 'p1'
	},
	calls: {
		pollForEvents: function(responseHandler, errorHandler) {
			var es = new EventSource('/api/poll?cah_token=' + api.properties.token);

			es.addEventListener('message', event => {
                let data = JSON.parse(event.data);
                responseHandler(data);
			}, false);
			
			es.addEventListener('error', event => {
                if (event.readyState == EventSource.CLOSED) {
                    console.log('Event was closed');
                    console.log(EventSource);
				}
				errorHandler(event);
            }, false);
		},
		setupWebSocket: function(responseHandler, errorHandler) {
			var socket = new WebSocket('ws://127.0.0.1:8100');

			socket.onopen = function (event) {
				console.log("onopen");
				socket.send("Here's some text that the server is urgently awaiting!"); 
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