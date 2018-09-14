<template>
	<transition-group name="slide-list" tag="div">
		<game-list-cell v-for="game in games" v-bind:game="game" v-bind:key="game.public_id"></game-list-cell>
	</transition-group>
</template>
<script>
import { mapState } from 'vuex'

export default {
	created: function() {
		document.addEventListener('websocketDidSetup', this.update);
	},
	data: function () {
		return {

		}
	},
	methods: {
		update: function() {
			this.$store.dispatch('updateGameList');
		}
	},
	computed: mapState({
		games: state => state.gameList
	})
}
</script>

