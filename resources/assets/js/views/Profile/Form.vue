<template>
	<div>
		<div class="loading" v-show="loading"><i class="fa fa-spinner fa-pulse fa-fw"></i>loading...</div>
		<div class="photo__header" v-show="!loading">
			<h3>{{action}} Profile</h3>
			<div>
				<button class="btn btn__primary" @click="save">Save</button>
				<button class="btn" @click="$router.back()">Cancel</button>
			</div>
		</div>
		<div class="photo__row" v-show="!loading">
			<div class="photo__image">
				<div class="photo__box">
					<image-upload v-model="form.image"></image-upload>
					<small class="error__control" v-if="error.image">{{error.image[0]}}</small>
				</div>
			</div>
			<div class="photo__details">
				<div class="photo__details_inner">
					<div class="form__group">
					    <label>Comment*</label>
					    <textarea type="text" class="form__control  form__comment" placeholder="e.g.) Please take a look at my photos! I'm waiting for job offers^^" v-model="form.comment"></textarea>
					    <small class="error__control" v-if="error.comment">{{error.comment[0]}}</small>
					</div>
					<div class="form__group">
					    <label>Facebook</label>
					    <input type="text" class="form__control form__facebook" v-model="form.facebook">
					    <small class="error__control" v-if="error.description">{{error.facebook[0]}}</small>
					</div>
					<div class="form__group">
					    <label>Twitter</label>
					    <input type="text" class="form__control form__twitter" v-model="form.twitter">
					    <small class="error__control" v-if="error.description">{{error.twitter[0]}}</small>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script type="text/javascript">
	import Vue from 'vue'
	import Flash from '../../helpers/flash'
	import { get, post } from '../../helpers/api'
	import { toMulipartedForm } from '../../helpers/form'
	import ImageUpload from '../../components/ImageUpload.vue'

	export default {
		components: {
			ImageUpload
		},
		data() {
			return {
				form: {},
				error: {},
				loading: true,
				initializeURL: `/api/profile/create`,
				storeURL: `/api/profile`,
				action: 'Create'
			}
		},
		created() {
			if(this.$route.meta.mode === 'edit') {
				this.initializeURL = `/api/profile/${this.$route.params.user_id}/edit`
				this.storeURL = `/api/profile/${this.$route.params.user_id}?_method=PUT`
				this.action = 'Update'
			}
			get(this.initializeURL)
				.then((res) => {
					Vue.set(this.$data, 'form', res.data.form)
					this.loading = false
				})
		},
		methods: {
			save() {
				const form = toMulipartedForm(this.form, this.$route.meta.mode)
				post(this.storeURL, form)
				    .then((res) => {
				        if(res.data.saved) {
				        	// use promise
				            Flash.setSuccess(res.data.message)
				            this.$router.push(`/photo/`)
				        }
						this.loading = false
				    })
				    .catch((err) => {
				        if(err.response.status === 422) {
				            this.error = err.response.data
				            // Flash.setError(this.error)
				        }
				        this.loading = false
				    })
			},
			remove(type, index) {
				if(this.form[type].length > 1) {
					this.form[type].splice(index, 1)
				}
			}
		}
	}
</script>
