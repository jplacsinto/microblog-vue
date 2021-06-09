<template>
	<div>
		<create-post></create-post>
	    <div v-for="post in posts" :key="post.id" class="card mb-4">
	        <div class="card-body">

	            <div class="d-flex">
	                <div class="flex-shrink-0">
	                    <a :href="post.author.url">
	                        <img class="rounded rounded-circle" height="50" width="50" :src="`https://picsum.photos/50/50?id=${post.id}`" alt="Avatar">
	                    </a>
	                </div>
	                <div class="flex-grow-1 ms-3">
	                    <a :href="post.author.url" class="text-decoration-none"><strong>{{ post.author.username }}</strong></a>
	                    <action :postId="post.id"></action>
	                    <p class="mt-1">{{ post.content }}</p>
	                </div>
	            </div>
	        </div>

	        <div class="card-footer">
	            <a href="#">
	            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
	              <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
	            </svg>
	            </a> <small>17 Likes</small>

	            <small class="text-muted float-end" :title="post.date_posted">{{ post.date_posted_for_human }}</small>

	            
	        </div>
	    </div>

	    <div class="d-flex justify-content-center my-4" v-if="loading">
	      <div class="spinner-border" role="status">
	        <span class="visually-hidden">Loading...</span>
	      </div>
	    </div>

	    <div class="d-flex justify-content-center my-4" v-if="end">
	        <span class="text-muted">No more posts to show</span>
	    </div>

	    <div v-if="posts.length" v-observe-visibility="{
	        callback: handleScrolledToBottom,
	        intersection: {
	            rootMargin: '0px 0px 70px'
	        }
	    }"></div>
    </div>
</template>

<script>
    //import axios from 'axios'

    const apiUrl = 'https://microblog-vue.local.com/api/post'

    import Action from './Action.vue'

    export default {
    	components: {
    		Action
    	},

    	props: {
    		'author': {
    			type: Number,
    			default: null
    		}
    	},

        data () {
            return {
                posts : [],
                page: 1,
                lastPage: 1,
                loading: false,
                end: false
            }
        },

        methods: {
            async fetch () {
                this.loading = true

                let feedUrl = apiUrl+`?page=${this.page}`

                if(this.author != null) feedUrl += `&author=${this.author}`

                let posts = await window.axios.get(feedUrl)
                    .catch((error) => {
                        console.log(error)
                    }).finally(() => {
                        this.loading =  false
                    })

                this.posts.push(...posts.data.data)

                this.lastPage = posts.data.meta.last_page
            },

            handleScrolledToBottom (isVisible, entry) {
                if(!isVisible) { return }

                if(this.page >= this.lastPage) {
                    this.end = true
                    return
                }
                
                this.page++

                this.fetch()
            }
        },

        mounted() {
            this.fetch()
        }
    }
</script>