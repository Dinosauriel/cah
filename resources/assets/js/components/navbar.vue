<template>
	<nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand">Cards Against Humanity</span>
        <span class="navbar-text">{{ username }}</span>
    </nav>
</template>
<script>
import { mapState } from 'vuex'

export default {
	computed: mapState({
		username: state => state.player.username
	})
}
</script>
