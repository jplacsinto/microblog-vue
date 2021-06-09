<template>
	<div class="row justify-content-center mt-5">
		<!-- <div class="col-md-4 mb-3">
		</div> -->
		<div class="col-md-5 mb-3">
			<div class="card p-4">
				
				<div class="card-body">
					<div class="mb-4">
						<h4>Login</h4>
					</div>

					{{ registeredMessage }}

					<div class="form-floating mb-4">
						<input value="jplacsinto" v-model="form.username" type="text" class="form-control" :class="{ 'is-invalid' : errors.username}" id="username" placeholder="Username">
						<label for="username">Username</label>
						<div class="invalid-feedback" v-if="errors.username">{{ errors.username[0] }}</div>
					</div>
					<div class="form-floating mb-4">
						<input value="password123" v-model="form.password" type="password" class="form-control" :class="{ 'is-invalid' : errors.password}" id="password" placeholder="Password">
						<label for="password">Password</label>
						<div class="invalid-feedback" v-if="errors.password">{{ errors.password[0] }}</div>
					</div>

					<div class="d-flex flex-row-reverse">
						<button @click.prevent="submitForm" type="button" class="btn btn-primary btn-lg text-light px-5">Login</button>
					</div>
					
				</div>
			</div>
			
		</div>
	</div>
</template>
<script>
export default {
	props: [
		'registered'
	],

	data () {
		return {
			form: {
				username: '',
				password: ''
			},
			errors: [],
			registeredMessage: ''
		}
	},

	methods: {
		submitForm() {
			window.axios.post('https://microblog-vue.local.com/api/user/login', this.form)
			.then((response) => {
				localStorage.setItem('token', response.data.token)
				this.$router.push({name: "home"})
			})
            .catch((error)=>{
            	if(error.response.data.hasOwnProperty('errors')){
            		console.log(error.response.data.errors);
            		this.errors = error.response.data.errors;
            	}
            })
            //.finally(() => this.loading = false)
		}
	},

	mounted (){
		this.registeredMessage = this.registered;
	}
}
</script>