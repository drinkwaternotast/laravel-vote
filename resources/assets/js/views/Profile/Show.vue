<template>
	<div>
		<div class="loading" v-show="loading"><i class="fa fa-spinner fa-pulse fa-fw"></i>loading...</div>
		<div class="photo__row" v-show="!loading">
			<div class="photo__image">
				<div class="photo__box">
					<img :src="profile.image" v-if="profile.image">
				</div>
			</div>
			<div class="photo__details">
				<div class="photo__details_inner">
					<small>Submitted by: {{profile.name}}</small>
					<h1 class="profile__title">{{profile.name}}</h1>
					<p class="profile__comment" v-if="profile.comment">{{profile.comment}}</p>
					<p>
						<i class="fa fa-facebook-square fa-fw" style="color : #09548c; font-size: 1.5em;"></i>
						<a :href="profile.facebook" v-if="profile.facebook">{{profile.facebook_omit}}</a>
					</p>
					<p>
						<i class="fa fa-twitter fa-fw" style="color : rgb(133, 187, 227); font-size: 1.5em;"></i>
						<a :href="profile.twitter" v-if="profile.twitter">{{profile.twitter_omit}}</a>
					</p>		
					<div v-if="authState.api_token && authState.user_id === profile.user_id">
						<router-link :to="{ name: 'editProfiles', params: { user_id: profile.user_id }}" class="square_btn__default">
							Edit
						</router-link>
					</div>
				</div>
	            <div class="photo__details_menu" v-if="!(authState.api_token && authState.user_id === profile.user_id)">
	                <div style="margin-right: 15px;">
	                    <router-link :to="{ name: 'userPhotos', params: { user_id: profile.user_id }}">
	                    	<i class="fa fa-file-photo-o fa-fw"></i>Garally
	                    </router-link>
	                </div>
	                <div style="margin-right: 15px;">
	                    <router-link :to="{ name: 'currentUserBattles', params: { user_id: profile.user_id }}">
		                    <i class="fa fa-flag fa-fw"></i>Battles
	                    </router-link>
	                </div>
	                <div style="margin-right: 15px;">
	                    <router-link :to="{ name: 'historyUserBattles', params: { user_id: profile.user_id }}">
	                    	<i class="fa fa-external-link fa-fw"></i>Battle History 
	                    </router-link>
	                </div>	                
	            </div>
				<div v-if="authState.api_token && authState.user_id === profile.user_id" class="profile__menu">
					<div class="tabbed">
						<input type="radio" name="tabs" id="tab-nav-1" checked>
							<label for="tab-nav-1">
								Upload Image
							</label>
						<input type="radio" name="tabs" id="tab-nav-2">
							<label for="tab-nav-2">
								Published List							
							</label>
						<input type="radio" name="tabs" id="tab-nav-3">
							<label for="tab-nav-3">
								Favorite List							
							</label>
						<input type="radio" name="tabs" id="tab-nav-4">
							<label for="tab-nav-4">
								Battle List							
							</label>
						<div class="tabs">
							<div><h2>Memo</h2><p>Please upload and publish your image.</p>
								<p>All uploaded images can be viewed for every users. It can also be used for confrontation.</p>
								<p><router-link :to="{name: 'uploadPhoto'}" class="square_btn__default">Upload Image</router-link></p>
							</div>
							<div><h2>Memo</h2><p>Photos that you uploaded and published!</p>
								<p>Every user can see pictures here and select photos as opponents.</p>
								<p><router-link :to="{ name: 'userPhotos', params: { user_id: profile.user_id }}" class="square_btn__default">Published List</router-link></p>
							</div>
							<div><h2>Memo</h2><p>It's a favorite list!</p>
								<p>You can store other's images in the list.</p>
								<p><router-link :to="{name: 'favorites'}" class="square_btn__default">Favorite List</router-link></p>
								<p><router-link :to="`/fan/`" class="square_btn__default">Fan List</router-link></p>
							</div>
							<div><h2>Memo</h2><p>You can check your battle list</p>
								<p>You can see all the battles in which your photos are used.</p>
								<p><router-link :to="{ name: 'currentUserBattles', params: { user_id: profile.user_id }}" class="square_btn__default">Battle List</router-link></p>
								<p><router-link :to="{ name: 'historyUserBattles', params: { user_id: profile.user_id }}" class="square_btn__default">Battle History</router-link></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script type="text/javascript">
	import Auth from '../../store/auth'
	import Flash from '../../helpers/flash'
	import { get } from '../../helpers/api'
	export default {
		data() {
			return {
				authState: Auth.state,
				profile: {},
				error: {},
				loading: true,
			}
		},
		created() {
			get(`/api/profile/${this.$route.params.user_id}`)
				.then((res) => {
			        if(res.data.isRegistered) {
						this.profile = res.data.profile;
						this.loading = false;
			        }else {
	        			this.$router.push(`/profile/create`);
			        }
				})
			    .catch((err) => {
			        if(err.response.status === 404) {
			        	//from edit button to create button
			            this.error = err.response.data
			        }
			    })
		},
		methods: {

		}
	}
</script>
