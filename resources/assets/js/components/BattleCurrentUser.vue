<template>
<div>
    <div class="loading" v-show="loading"><i class="fa fa-spinner fa-pulse fa-fw"></i>loading...</div>
    <div class="photo__header" v-show="!loading">
        <h3>Battle List</h3>
    </div>
    <div class="pair__row" v-show="!loading">
    	<div class="pair__list">
            <div class="pair__main" v-if="battleList[0]">
                <div class="pair__item" v-for="battle in battleList">
                <div class="pair__time">END TIME: {{ battle.end_at }}</div>
                    <div class="pair__box">
                        <router-link class="photo__inner" :to="`/appendix/${battle.photo_you}`">
                            <img :src="battle.p1_path" v-if="battle.p1_path">
                        </router-link>
                        <div class="caption">
                            <p><b>{{ battle.u1name }}</b></p>
                            <p class="pair__circle"> {{ battle.COUNT_like_you }} pt</p>
                            <button class="square_btn__good"
                                    type="button"
                                    @click="voteBattle(battle.id, battle.photo_you)">good
                            </button>
                        </div>
                    </div>
                    <div class="pair__versus">VS</div>
                    <div class="pair__box">
                        <router-link class="photo__inner" :to="`/appendix/${battle.photo_enemy}`">
                            <img :src="battle.p2_path" v-if="battle.p2_path">
                        </router-link>
                        <div class="caption">
                            <p><b>{{ battle.u2name }}</b></p>
                            <p class="pair__circle"> {{ battle.COUNT_like_enemy }} pt</p>
                            <button class="square_btn__good"
                                    type="button" 
                                    @click="voteBattle(battle.id, battle.photo_enemy)">good
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pair__rules_wrapper" v-if="battleList[0]">
                <div class="pair__rules">
                    <p><b>Tips</b></p>
                    <p><i class="fa fa-lightbulb-o fa-fw"></i>Let's vote with the Good button!</p>
                </div>
                <div class="pair__rules">
                    <p><b>Rules</b></p>
                    <p><i class="fa fa-check fa-fw"></i>The fight will end in 48 hours.</p>
                    <p><i class="fa fa-check fa-fw"></i>You can vote any photos except photos posted by you.</p>
                    <p><i class="fa fa-check fa-fw"></i>If you ranked in the rankings, your photo may be treated as the main gallary of this site!!</p>
                </div>
            </div>
            <NotFoundPartial v-else></NotFoundPartial>
        </div>
        <vue-pagination
                v-if="battleList[0]"
                class="pagination-default"
                v-bind:namedRoute="namedRoute"
                v-bind:pagination="pagination"
                v-on:click.native="getPage(pagination.current_page)"
                :offset="8">
        </vue-pagination> 
    </div>
</div>
</template>

<script>
import { get, post } from '../helpers/api'
import Flash from '../helpers/flash'
import VuePagination from './Pagination.vue'
import NotFoundPartial from '../views/NotFoundPartial.vue'

export default {
    name: 'currentUserBattles',
    components: {
       VuePagination,
       NotFoundPartial
    },
    data() {
        return {
            battleList : [],
            error: {},
            initURL: `/api/user/current/battles/${this.$route.params.user_id}`,
            namedRoute: 'currentUserBattles',
            loading: true,
            counter: 0,
            pagination: {
                total: 0,
                per_page: 8,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 2,
            page: null,
        }
    },
    created() {
        this.getContents()
    },
    watch: {
        '$route' (to, from) {
            this.page = this.$route.query.page
            this.getContents()
        }
    },
    methods: {
        voteBattle: function(battle_id, photo_id) {
            post(`/api/vote`, {battle_id: battle_id, photo_id: photo_id})
            .then((res) => {
                if (res.data.saved) {
                    get(this.initURL+ `?page=` + this.pagination.current_page)
                    .then((res) => { 
                        this.battleList = res.data.data; 
                        this.loading = false;
                    })
                }
            })
            .catch((err) => {
                if(err.response.status === 405) {
                    this.error = err.response.data
                    Flash.setSuccess(this.error.messages)
                }
                this.isProcessing = false
            });
        },
        getContents() {
            get(this.initURL + `?page=` + this.$route.query.page)
                .then((res) => {
                    this.pagination = res.data;
                    this.battleList = res.data.data;
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
}
</script>
