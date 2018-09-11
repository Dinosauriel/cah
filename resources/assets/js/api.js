

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
						resolve();
					});
				};
		
				api.socket.onmessage = function (event) {
					console.log('onmessage');

					//resolve the call
					var data = JSON.parse(event.data);
					console.log(data);
					var responseId = data.id;
					api.requests[responseId].res(data);
					api.requests[responseId] = null;
				};
			});

			return promise;
		},
		callMethod: function(name, parameters) {
			//remember this request
			var requestId = api.methods.getNextRequestId();
			console.log('calling Method: ' + name + ':' + requestId);

			var promise = new Promise(function(resolve, reject) {
				//remember the request
				api.requests[requestId] = {res: resolve, rej: reject};
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
		
	}
};

export default api;