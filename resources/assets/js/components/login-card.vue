<template>
	<div class="card">
			<div class="card-body">
				<h5 class="card-title">Admin Login</h5>
				<p class="card-text">Log In to start creating games</p>
				<form :action="action" method="POST">
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" id="username" name="username" required>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" id="password" name="password" required>
					</div>
					<button v-on:click="submitLogin" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
</template>
<script>
export default {
	props: ["action"],
	methods: {
		submitLogin: function() {}
	}
};
</script>
