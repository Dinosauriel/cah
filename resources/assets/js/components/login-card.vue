<template>
	<div class="card">
			<div class="card-body">
				<h5 class="card-title">Admin Login</h5>
				<p class="card-text">Log In to start creating games</p>
				<form id="login-form" :action="action" method="POST">
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" v-model="username" name="username" required>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" v-model="password" name="password" required>
					</div>
					<button v-on:click="submitLogin" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
</template>
<script>
export default {
	props: ["action"],
	data: function() {
		return {
			username: "",
			password: ""
		};
	},
	methods: {
		submitLogin: function() {
			console.log(this.data.username);
			console.log(this.data.password);
			return;
			var form = $("#login-form");
			window.Axios.post(form.attr("action"), {
				username: username,
				password: password,
				_token: window.csrf_token
			})
				.then(function(response) {
					console.log(response);
				})
				.catch(function(error) {
					console.log(error);
				});
		}
	}
};
</script>
