<template>
	<div class="edit-game">
		<div class="row mt-3">
			<div class="col col-sm-8">
				<form method="POST" action="">
					<div class="form-group">
						<label for="game_name">Name</label>
						<input type="text" class="form-control" id="game_name" name="game_name"  :value="game.name" required>
					</div>
					<div class="form-group">
						<label for="game_points">Points</label>
						<input type="number" class="form-control" id="game_points" aria-describedby="game_points_help" :value="game.points_required" min="1" max="64" name="game_name" required>
						<small id="game_points_help" class="form-text text-muted">How many points are required to win?</small>
					</div>
					<cardset-selection></cardset-selection>
					<button type="submit" class="btn btn-primary">Start Game</button>
				</form>
			</div>

			<div class="col col-sm-4">
				<invite-link v-bind:invitelink="game.route"></invite-link>

				<div class="card mt-3">
					<div class="card-header">
						Players
					</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item">
							Cras justo odio
							<button type="button" class="btn btn-primary btn-sm float-right">Kick</button>
						</li>
					</ul>
				</div>

				<a class="btn btn-danger btn-block mt-3" href="">Delete Game</a>
			</div>
		</div>
	</div>
</template>
<script>
import { mapState } from 'vuex';

export default {
	created: function() {
		document.addEventListener('websocketDidSetup', this.updateGame);
	},
	methods: {
		updateGame: function() {
			this.$store.dispatch('updateCurrentGame', game.public_id);
		}
	},
	computed: mapState({
		game: state => state.game
	})
}
</script>
