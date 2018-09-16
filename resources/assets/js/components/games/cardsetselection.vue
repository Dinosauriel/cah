<template>
	<div class="card form-group">
        <div class="card-body">
            <h5 class="card-title">Cardsets</h5>
            <div v-for="cardset in cardsets" v-bind:key="cardset.id" class="form-check form-check-inline">
				<input type="checkbox" class="form-check-input" :id="'cardset_' + cardset.id" :value="'cardset_' + cardset.id">
				<label class="form-check-label" :for="'cardset_' + cardset.id">{{ cardset.name }}</label>
			</div>
        </div>
    </div>		
</template>
<script>
import { mapState } from 'vuex';

export default {
	methods: {
	},
	computed: mapState({
		cardsets: state => state.cardsets
	})
};
</script>