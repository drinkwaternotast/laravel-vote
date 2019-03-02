<template>
	<div class="container">
<!-- 		<div class="navbar">
			<div class="navbar__brand">
				<router-link to="/">COSPLAYER'S FORUM</router-link>
			</div>
			<ul class="navbar__list">
				<li class="navbar__item"  v-if="guest">
					<router-link to="/login">LOGIN</router-link>
				</li>
				<li class="navbar__item"  v-if="guest">
					<router-link to="/register">REGISTER</router-link>
				</li>
				<li class="navbar__item"  v-if="auth">
					<router-link :to="`/profile/${authState.user_id}`">My Page</router-link>
				</li>
				<li class="navbar__item"  v-if="auth">
					<a @click.stop="logout">LOGOUT</a>
				</li>
			</ul>
		</div>
		<div class="flash flash__error" v-if="flash.error">
			{{flash.error}}
		</div>
		<div class="flash flash__success" v-if="flash.success">
			{{flash.success}}
		</div> -->
<nav class="menu" tabindex="0">
<div class="smartphone-menu-trigger"></div>
	<header class="avatar">
		<img src="https://s3-ap-northeast-1.amazonaws.com/cosplay-logo/LogoMaker.png" />
		<h2>COSPLAYER'S MARKET</h2>
	</header>
	<ul>
		<router-link tag="li" tabindex="0" class="icon-login" v-if="guest" to="/login"><span>LOGIN</span></router-link>
		<router-link tag="li" tabindex="0" class="icon-register" v-if="guest" to="/register"><span>REGISTER</span></router-link>
		<router-link tag="li" tabindex="0" class="icon-mypage" v-if="auth" :to="`/profile/${authState.user_id}`"><span>My Page</span></router-link>
<!--         <router-link tag="li" tabindex="0" class="icon-home" :to="{name: 'home'}"><span>HOME</span></router-link> -->
        <router-link tag="li" tabindex="0" class="icon-about" :to="{name: 'about'}"><span>ABOUT</span></router-link>
        <router-link tag="li" tabindex="0" class="icon-cosplayers" :to="{name: 'photos'}"><span>COSPLAYER</span></router-link>
        <router-link tag="li" tabindex="0" class="icon-battles" :to="{name: 'currentBattles'}"><span>BATTLE</span></router-link>
        <router-link tag="li" tabindex="0" class="icon-rankings" :to="{name: 'ranks'}"><span>RANKING</span></router-link>
        <router-link tag="li" tabindex="0" class="icon-histories" :to="{name: 'histories'}"><span>HISTORY</span></router-link>
		<li class="icon-logout" tabindex="0" v-if="auth"><a @click.stop="logout"><span style="color: #fff;">LOGOUT</span></a></li>
	</ul>
</nav>
<main>
  <div class="helper">
      <router-view 
        keep-alive
            transition
            transition-mode="out-in">
        </router-view>
  </div>
</main>
<!-- 		<div class="photo__show">
		    <div class="photo__header">
		        <h3>MENU</h3>
		        <ul class="navbar__list">
		            <router-link tag="li" class="navbar__item" :to="{name: 'home'}">HOME</router-link>
		            <router-link tag="li" class="navbar__item" :to="{name: 'about'}">ABOUT</router-link>
		            <router-link tag="li" class="navbar__item" :to="{name: 'photos'}">COSPLAYER</router-link>
		            <router-link tag="li" class="navbar__item" :to="{name: 'currentBattles'}">BATTLE</router-link>
		            <router-link tag="li" class="navbar__item" :to="{name: 'ranks'}">RANKING</router-link>
		            <router-link tag="li" class="navbar__item" :to="{name: 'histories'}">HISTORY</router-link>
		        </ul>
		    </div>
			<router-view 
				keep-alive
	        	transition
	        	transition-mode="out-in">
	     	</router-view>
		</div> -->
	</div>
</template>
<script type="text/javascript">
	import Auth from './store/auth'
	import Flash from './helpers/flash'
	import { post, interceptors } from './helpers/api'
	export default {
		created() {
			// global error http handler
			interceptors((err) => {
				if(err.response.status === 401) {
					Auth.remove()
					this.$router.push('/login')
				}

				if(err.response.status === 500) {
					Flash.setError(err.response.statusText)
				}

				if(err.response.status === 404) {
					this.$router.push('/not-found')
				}
			})
			Auth.initialize()
		},
		data() {
			return {
				authState: Auth.state,
				flash: Flash.state
			}
		},
		computed: {
			auth() {
				if(this.authState.api_token) {
					return true
				}
				return false
			},
			guest() {
				return !this.auth
			}
		},
		methods: {
			logout() {
				post('/api/logout')
				    .then((res) => {
				        if(res.data.done) {
				            // remove token
				            Auth.remove()
				            Flash.setSuccess('You have successfully logged out.')
				            this.$router.push('/login')
				        }
				    })
			}
		}
	}
</script>
