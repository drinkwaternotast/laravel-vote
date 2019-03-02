
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue'
import VueRouter from 'vue-router'
import VueAnalytics from 'vue-analytics'
import vmodal from 'vue-js-modal'

import Login from '../views/Auth/Login.vue'
import Register from '../views/Auth/Register.vue'
import HomeView from '../components/HomeView.vue'
import About from '../components/About.vue'
import PhotoList from '../components/PhotoList.vue'
import PhotoUser from '../components/PhotoUser.vue'
import PhotoTagSearch from '../components/PhotoTagSearch.vue'
import PhotoAppendix from '../components/PhotoAppendix.vue'
import UploadPhoto from '../components/PhotoUpload.vue'
import FavoriteList from '../components/FavoriteList.vue'
import FanList from '../components/FanList.vue'
import BattleList from '../components/BattleList.vue'
import BattleCurrentUser from '../components/BattleCurrentUser.vue'
import BattleHistoryUser from '../components/BattleHistoryUser.vue'
import BattleCurrentPhoto from '../components/BattleCurrentPhoto.vue'
import BattleHistoryPhoto from '../components/BattleHistoryPhoto.vue'
import RankingList from '../components/RankingList.vue'
import ProfileForm from '../views/Profile/Form.vue'
import ProfileShow from '../views/Profile/Show.vue'
import HistoryList from '../components/HistoryList.vue'
import NotFound from '../views/NotFound.vue'

require('../bootstrap');

window.Vue = require('vue');
Vue.use(VueRouter);
Vue.use(vmodal);

Vue.config.productionTip = false;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));

const router = new VueRouter({
    base: '/', 
    mode: 'history',
    routes: [
        { path: '/', component: PhotoList, meta: { mode: 'photo' }},
    	{ path: '*', component: NotFound },
        { path: '/register', component: Register },
        { path: '/login', component: Login },
        { path: '/about', name: 'about', component: About },
        { path: '/battle/', component: BattleList, name: 'currentBattles' },
        { path: '/battle/current/user/:user_id', component: BattleCurrentUser, name: 'currentUserBattles' },
        { path: '/battle/history/user/:user_id', component: BattleHistoryUser, name: 'historyUserBattles' },
        { path: '/battle/current/photo/:photo_id', component: BattleCurrentPhoto, name: 'currentPhotoBattles' },
        { path: '/battle/history/photo/:photo_id', component: BattleHistoryPhoto, name: 'historyPhotoBattles' },
        { path: '/photo/', component: PhotoList, name: 'photos', meta: { mode: 'photo' }},
        { path: '/photo/user/:user_id', component: PhotoUser, name: 'userPhotos', meta: { mode: 'photo_user' }},
        { path: '/photo/search/:title_id/:tag_id', component: PhotoTagSearch, name: 'tagSearchPhotos' },
        { path: '/appendix/:photo_id', name: 'appendixPhotos', component: PhotoAppendix },
        { path: '/photo/upload', name: 'uploadPhoto', component: UploadPhoto },
        { path: '/ranking/', name: 'ranks', component: RankingList },
        { path: '/profile/create', component: ProfileForm, meta: { mode: 'create' }},
        { path: '/profile/:user_id/edit', name: 'editProfiles',component: ProfileForm, meta: { mode: 'edit' }},
        { path: '/profile/:user_id', name: 'profiles', component: ProfileShow},
        { path: '/favorite/', name: 'favorites', component: FavoriteList},
        { path: '/fan/', name: 'fans', component: FanList},
        { path: '/history/', name: 'histories', component: HistoryList } ,
    ]
})

Vue.use(VueAnalytics, {
  id: 'UA-110080728-1',
  router
})

export default router