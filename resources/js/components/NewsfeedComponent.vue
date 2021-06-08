<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-3">
                <div v-for="post in posts" :key="post.id" class="card mt-3">
                    <div class="card-body">

                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <a :href="post.author.url">
                                    <img class="rounded rounded-circle" height="50" width="50" :src="`https://picsum.photos/50/50?id=${post.id}`" alt="Avatar">
                                </a>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <a :href="post.author.url" class="text-decoration-none"><strong>{{ post.author.username }}</strong></a>
                                <div class="float-end">
                    
                                    <div class="dropdown">
                                      <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                          <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                          <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                                        </svg>
                                      </button>
                                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                      </ul>
                                    </div>
                                   
                                </div>
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
    import axios from 'axios'

    export default {
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

                let posts = await axios.get(`https://microblog-vue.local.com/api/post?page=${this.page}`)
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
