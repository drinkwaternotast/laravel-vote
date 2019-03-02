<template>
<div>
	<div class="loading" v-show="loading"><i class="fa fa-spinner fa-pulse fa-fw"></i>loading...</div>
	<div v-show="!loading">
		<div class="topuser__section">
			<div class="topuser__wrapper">
				<div class="topuser__image">
					<img src="https://s3.ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/M0sazSik5IzMNFbkEW0SIVkYumZ6I0Pa.jpeg">
				</div>
				<div class="topuser__label">
					<div>Congraturation! {{ top.name }}</div>
				</div>
			</div>
			<div class="topuser__info_section">
				<div class="topuser__photos_list">
					<div v-for="topUserPhoto in topUserPhotoList">
						<img :src="topUserPhoto.original_path" v-if="topUserPhoto.original_path">
					</div>
				</div>
				<div class="topuser__list" v-if="top">
                	<div class="topuser__img">
                    	<router-link :to="`/profile/${top.user_id}`">
                    		<img :src="top.original_path" v-if="top.original_path">
                    	</router-link>                    		
                	</div>
                	<div class="topuser__information">
                		<div class="topuser__user">{{ top.name }}</div>
                		<div class="topuser__rank">{{ top.rank }}</div>
            			<div class="topuser__links">
	                        <div><i class="fa fa-external-link fa-fw"></i>
	                        	<router-link :to="{ name: 'profiles', params: { user_id: top.user_id }}">Profile</router-link>
	                        </div>
	                        <div><i class="fa fa-file-photo-o fa-fw"></i>
	                        	<router-link :to="`/photo/user/${top.user_id}`">Gallary</router-link>
	                        </div>
	                        <div><i class="fa fa-flag fa-fw"></i>
	                        	<router-link :to="{ name: 'currentUserBattles', params: { user_id: top.user_id }}">Battle List</router-link>
	                        </div>
	                    </div>
	                    <div class="topuser__sns">
	                        <div>
	                        	<i class="fa fa-facebook-square fa-fw" style="color : #09548c; font-size: 1.5em;"></i>
	                        	<a :href="top.facebook" v-if="top.facebook">{{top.facebook_omit}}</a>
	                        </div>
	                        <div>
	                        	<i class="fa fa-twitter fa-fw" style="color : rgb(133, 187, 227); font-size: 1.5em;"></i>
								<a :href="top.twitter" v-if="top.twitter">{{top.twitter_omit}}</a>
	                        </div>
	                    </div>
                	</div>
				</div>
			</div>
		</div>
        <div class="top__rankers">
            <div class="top__rankers__item" v-for="others in othersList">
            	<router-link :to="`/profile/${others.user_id}`" class="top__rankers__img">
            		<img :src="others.original_path" v-if="others.original_path">
            	</router-link>
            	<div class="top__rankers__infomation">
            		<div class="top__rankers__user">{{ others.name }}</div>
            		<div class="top__rankers__rank">{{ others.rank }}</div>
        			<div class="top__rankers__links">
                        <div><i class="fa fa-external-link fa-fw"></i>
                        	<router-link :to="{ name: 'profiles', params: { user_id: others.user_id }}">Profile</router-link>
                        </div>
                        <div><i class="fa fa-file-photo-o fa-fw"></i>
                        	<router-link :to="`/photo/user/${others.user_id}`">Gallary</router-link>
                        </div>
                        <div><i class="fa fa-flag fa-fw"></i>
                        	<router-link :to="{ name: 'currentUserBattles', params: { user_id: others.user_id }}">Battle List</router-link>
                        </div>
                    </div>
                    <div class="top__rankers__sns">
                        <div>
                        	<i class="fa fa-facebook-square fa-fw" style="color : #09548c; font-size: 1.5em;"></i>
                        	<a :href="others.facebook" v-if="others.facebook">{{others.facebook_omit}}</a>
                        </div>
                        <div>
                        	<i class="fa fa-twitter fa-fw" style="color : rgb(133, 187, 227); font-size: 1.5em;"></i>
							<a :href="others.twitter" v-if="others.twitter">{{others.twitter_omit}}</a>
                        </div>
                    </div>
            	</div>
            </div>
		</div>
		<div class="top_border">Hot Members!</div>
	    <div class="top__middle_section">
	        <h2>Hot Members!</h2>
			<div class="special">
				<div class="special__post" v-for="random in randomList">
					<router-link :to="`/profile/${random.user_id}`">
						<img :src="random.original_path" v-if="random.original_path">
					</router-link>
				</div>
			</div>
	        	<div class="top_border">Recent Members!</div>
	        <h2>Recent Members!</h2>
			<div class="special">
				<div class="special__post" v-for="newMember in newMemberList">
					<router-link :to="`/profile/${newMember.user_id}`">
						<img :src="newMember.image" v-if="newMember.image">
					</router-link>
				</div>
			</div>
		</div>
	 	<div class="photo__footer" v-show="!loading">
	 		<div class="photo__footer_inner">
	 			Copyright 2018 cosplayersmarket.com All Rights Reserved.
	 		</div>
	 	</div>
	</div>
</div>
</template>

<script>
import { get, post } from '../helpers/api'

export default {
	data () {
		return {
			topUserPhotoList : [],
			randomList : [],
			newMemberList : [],
			top : {},
			othersList : [],
			loading: true,
		}
	},
    mounted : function() {
	    get(`/api/home`)
	        .then((res) => {
	            this.topUserPhotoList = res.data.TopUserPhotos;
	            this.randomList = res.data.RandomPhotos;
	            this.newMemberList = res.data.NewMembers;
	            this.top = res.data.Top;
	            this.othersList = res.data.Others;
	            this.loading = false;
	        })
	        .catch((err) => {
	            if(err.response.status === 422) {
	                this.error = err.response.data
	            }
	            this.isProcessing = false
	        })

    },
}
</script>
