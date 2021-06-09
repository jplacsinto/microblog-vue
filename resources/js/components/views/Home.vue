<template>
	<div class="row justify-content-center">
		<!-- <div class="col-md-4 mb-3">
		</div> -->
		<div class="col-md-6 mb-3">
			<news-feed />
		</div>
	</div>
</template>

<script>
import NewsFeed from '../newsfeed/Content.vue'

export default {
	components: {
		NewsFeed
	},

	data () {
		return {
			user: null,
			token: localStorage.getItem('token')
		}
	},

	mounted() {
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            window.axios.get('api/user').then((response) => {
                this.user = response.data
            }).catch((errors) => {
                console.log(errors)
            })
        }
}
</script>