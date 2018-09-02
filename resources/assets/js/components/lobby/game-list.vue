<template>
	<div>
		<game-list-cell v-for="game in games" v-bind:game="game" v-bind:key="game.public_id"></game-list-cell>
	</div>
</template>
<script>
import { mapState } from 'vuex'

export default {
	mounted: function() {
		this.update();
	},
	data: function () {
		return {

		}
	},
	methods: {
		update: function() {
			this.$store.dispatch('downloadGameList');
		}
	},
	computed: mapState({
		games: state => state.gameList
	})
}
</script>

