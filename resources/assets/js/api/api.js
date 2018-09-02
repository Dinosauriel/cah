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

		getGameList: function(responseHandler, errorHandler) {
			Axios.post('/api/games', {
				cah_token: api.properties.token
			})
			.then(response => {
				responseHandler(response.data.content);
			})
		}
	}
};

export default api;