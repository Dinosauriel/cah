

const store = new Vuex.Store({
    state: {
        //the game currently participating in
        game: {
            name: string,
            pointsRequired: integer,

        },
        //player
        player: {
            username: string,
            is_admin: boolean,
        },
        //list of games
        gameList: {
			
        }
    },
    mutations: {
        setGameList(state, gameList) {
            state.gameList = gameList;
		},
		addGameToList(state, game) {
			state.gameList.push(game);
		}
	},
	methods: {
        setupEventStream: function() {

        },
        downloadGameLists: function() {

		}
    }
});