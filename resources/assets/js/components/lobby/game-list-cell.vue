<template>
	<div class="card mt-3 mb-3">
		<div class="card-body">
			<h5 class="card-title">{{ game.name }}</h5>
			<h6 class="card-subtitle mb-2 text-muted">{{ game.name }}</h6>
			<button v-on:click="joinGame" class="btn btn-primary">Join</button>
			<button v-on:click="deleteGame" class="btn btn-primary">Delete</button>
		</div>
	</div>
</template>
<script>
import Api from '../../api/api.js';

export default {
	props: {
		game: Object
	},
	data: function() {
		return {

		}
	},
	methods: {
		joinGame: function() {
			location.href = this.game.join_route;
		},
		deleteGame: function() {
			Api.calls.deleteGame(this.game.delete_route);
		}
	}
}
</script>