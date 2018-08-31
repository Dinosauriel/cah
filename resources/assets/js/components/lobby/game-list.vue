<template>
	<div>
		<game-list-cell v-for="game in games" v-bind:game="game" v-bind:key="game.public_id"></game-list-cell>
	</div>
</template>
<script>
import { mapState } from 'vuex'

export default {
	mounted: function() {

	},
	data: function () {
		return {

		}
	},
	methods: {
		update: function() {
			this.$store.downloadGameLists();
		}
	},
	computed: mapState({
		// arrow functions can make the code very succinct!
		games: state => state.games,
	})
}
</script>

