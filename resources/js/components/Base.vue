<template>
	<main>
		<navigation></navigation>
		<div class="container">
            <router-view></router-view>
	    </div>
	</main>
</template>

<script>
    export default {
    	/*data () {
    		return {
    			user: null
    		}
    	},

    	mounted () {
    		this.axios.get('/sanctum/csrf-cookie')
    			.then((res) => {
    				this.user = res.data;
    			})
    	}*/
    }
</script>