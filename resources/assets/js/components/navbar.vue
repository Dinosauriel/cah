<template>
	<nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand">Cards Against Humanity</span>
        <span class="navbar-text"><span class="badge badge-danger mr-3" v-if="!isConnected">Disconnected</span>{{ username }}</span>
    </nav>
</template>
<script>
import { mapState } from 'vuex';

export default {
	computed: mapState({
		username: state => state.player.username,
		isConnected: state => state.websocketConnectionIsActive,
	})
}
</script>
