<template>
	<div>
		<game-list-cell v-for="game in games" v-bind:game="game" v-bind:key="game.public_id"></game-list-cell>
	</div>
</template>
<script>
import { mapState } from 'vuex'

export default {
	mounted: function() {
		console.log(this.$store);
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
	computed: {
		games() {
			return this.$store.state.games;
		}
	}
}
</script>

