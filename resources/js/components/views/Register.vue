<template>
	<div class="row justify-content-center mt-5">
		<!-- <div class="col-md-4 mb-3">
		</div> -->
		<div class="col-md-6 mb-3">
			<div class="card p-4">
				
				<div class="card-body">
					<div class="mb-4">
						<h4>Register Account</h4>
						<p>Create you account now and start posting what's on your mind!</p>
					</div>
					<div class="form-floating mb-4">
						<input v-model="form.name" type="text" class="form-control" :class="{ 'is-invalid' : errors.name}" id="name" placeholder="name">
						<label for="name">Name</label>
						<div class="invalid-feedback" v-if="errors.name">{{ errors.name[0] }}</div>
					</div>
					<div class="form-floating mb-4">
						<input v-model="form.username" type="text" class="form-control" :class="{ 'is-invalid' : errors.username}" id="username" placeholder="Username">
						<label for="username">Username</label>
						<div class="invalid-feedback" v-if="errors.username">{{ errors.username[0] }}</div>
					</div>
					<div class="form-floating mb-4">
						<input v-model="form.password" type="password" class="form-control" :class="{ 'is-invalid' : errors.password}" id="password" placeholder="Password">
						<label for="password">Password</label>
						<div class="invalid-feedback" v-if="errors.password">{{ errors.password[0] }}</div>
					</div>
					<div class="form-floating mb-4">
						<input v-model="form.password_confirmation" type="password" class="form-control" :class="{ 'is-invalid' : errors.password}" id="password-confirmation" placeholder="Confirm password">
						<label for="password-confirmation">Confirm Password</label>
					</div>

					<div class="d-flex flex-row-reverse">
						<button @click.prevent="submitForm" type="button" class="btn btn-primary btn-lg text-light px-5">Register</button>
					</div>
					
				</div>
			</div>
			
		</div>
	</div>
</template>
<script>
export default {
	data () {
		return {
			form: {
				name: '',
				username: '',
				password: '',
				password_confirmation: '',
			},
			errors: []
		}
	},

	methods: {
		submitForm() {
			window.axios.post('https://microblog-vue.local.com/api/user/register', this.form)
			.then(() => {
				this.$router.push({name: "login", params: {registered:'true'}})
			})
            .catch((error)=>{
            	this.errors = error.response.data.errors;
            })
            //.finally(() => this.loading = false)
		}
	}
}
</script>