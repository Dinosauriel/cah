<template>
	<div>
		<game-list-cell v-for="game in games" v-bind:game="game" v-bind:key="game.public_id"></game-list-cell>
	</div>
</template>
<script>
export default {
	mounted: function() {
        this.downloadGames();
	},
	data: function () {
		return {
			games: [
				
			]
		}
	},
	methods: {
		downloadGames: function() {
			Axios.post('/api/games', {
				cah_token: 'p1'
			})
			.then(response => {
				console.log(response.data.content);
				this.games = response.data.content;
			})
		}
	}
}
</script>

