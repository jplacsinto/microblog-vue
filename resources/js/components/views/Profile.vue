<template>
	<div class="row justify-content-center">
		<div class="col-md-3 mb-3">
			<author></author>
		</div>
		<div class="col-md-6 mb-3">
			<news-feed :author="7"></news-feed>
		</div>
	</div>
</template>
<script>
import NewsFeed from '../newsfeed/Content.vue'

export default {
	components: {
		NewsFeed
	}
}
</script>