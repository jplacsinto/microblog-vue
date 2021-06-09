<template>
	<form @submit.prevent="createPost">
		<div class="card mb-4">
			<div class="card-body">
		        <div class="d-flex">
		            <div class="flex-shrink-0">
		                <a :href="author.url">
		                    <img class="rounded rounded-circle" height="50" width="50" :src="`https://picsum.photos/50/50`" alt="Avatar">
		                </a>
		            </div>
		            <div class="flex-grow-1 ms-3">
		                <a :href="author.url" class="text-decoration-none"><strong>{{ author.username }}</strong></a>
		                <div class="form-floating mt-2">
							<textarea v-model="post.content" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
							<label for="floatingTextarea2">What's on your mind?</label>
						</div>
		            </div>
		        </div>
		    </div>
		    <div class="card-footer">
				<button type="submit" class="btn btn-primary text-light float-end px-5">Post</button>
			</div>
		</div>
	</form>
</template>

<script>
	export default {
		data () {
			return  {
				post: {
					user_id: 7
				},
				author: {
					username: 'JP Lacsinto',
					url: 'sample'
				}
			}
		},

		methods: {
            createPost() {
                window.axios
                    .post('https://microblog-vue.local.com/api/post', this.post)
                    .then(response => (
                        this.$router.push({ name: 'home' })
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }
        }
	}
</script>