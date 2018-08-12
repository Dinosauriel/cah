<template>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Invite</h5>
            <input id="invite-link" class="form-control mt-3 mb-3" type="text" v-bind:value="invitelink" readonly>
            <button type="button" class="btn btn-primary" v-on:click="copyLink">Copy Link</button>
        </div>
    </div>
</template>
<script>
export default {
	props: ["invitelink"],
	methods: {
		copyLink: function() {
			console.log("copy");
			var text = document.getElementById("invite-link");
			text.select();
			document.execCommand("copy");
		}
	}
};
</script>
