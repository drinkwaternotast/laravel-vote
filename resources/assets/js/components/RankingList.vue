<template>
    <div>
        <div class="loading" v-show="loading"><i class="fa fa-spinner fa-pulse fa-fw"></i>loading...</div>
        <div class="ranking__row" v-show="!loading">
        	<div class="ranking__list">
                <div class="ranking__main">
            		<div v-for="ranking in rankingList" class="ranking__item">
                        <div class="ranking__box">
                            <img :src="ranking.original_path" />
                        </div>
                        <div class="ranking__infomation">
                            <b><p class="ranking__name">{{ ranking.name }}</p></b>
                            <div class="ranking__rank">{{ ranking.RANK }}</div>
                            <div class="border">&nbsp{{ ranking.title_en }}&nbsp/&nbsp{{ ranking.character }}&nbsp</div>
                            <div>{{ ranking.description }}</div>
                            <div class="ranking__icons">
                                <p>
                                    <i class="fa fa-external-link fa-border"></i>
                                    <router-link :to="{ name: 'profiles', params: { user_id: ranking.user_id }}">Profile</router-link>
                                </p>
                                <p>
                                    <i class="fa fa-file-photo-o fa-border"></i>
                                    <router-link :to="{ name: 'userPhotos', params: { user_id: ranking.user_id }}">Gallary</router-link>
                                </p>
                                <p>
                                    <i class="fa fa-flag fa-border"></i>
                                    <router-link :to="{ name: 'currentUserBattles', params: { user_id: ranking.user_id }}">Battle List</router-link>
                                </p>
                            </div>
                            <p class="ranking__circle">{{ ranking.COUNT }} pt</p>
                            <div class="ranking__action">
                                <div class="ranking__action_main">
                                    <button type="button"
                                            class="square_btn__entry"
                                            @click="showModal(ranking.photo_id)">Entry
                                    </button>
                                </div>
                                <actions :rowData="ranking" :status="status"></actions>
                            </div>
                        </div>
            		</div>
                </div>
                <div class="pair__rules_wrapper">
                    <div class="ranking__rules">
                        <p><b>Tips</b></p>
                        <p><i class="fa fa-heart fa-fw"></i>We ranked the photos in order of the number of votes.</p>
                        <p><i class="fa fa-heart fa-fw"></i>If your photo gets the same score, the earlier registered user will get high rank.</p>
                        <p class="pair__rules_jp"><i class="fa fa-heart-o fa-fw"></i>このランキングは、得票数の多い写真を順に並べています。</p>
                        <p class="pair__rules_jp"><i class="fa fa-heart-o fa-fw"></i>得票数が同じ場合、会員登録日の早いユーザーが上位にランクインします。</p>
                    </div>
                </div>
        	</div>
            <vue-pagination
                    v-if="rankingList[0]"
                    class="pagination-default"
                    v-bind:namedRoute="namedRoute"
                    v-bind:pagination="pagination"
                    v-on:click.native="getContents(pagination.current_page)"
                    :offset="10">
            </vue-pagination> 
            <!-- insert modal window-->
            <modal name="stage-view" :width="500" :height="500">
                <modalcontent :rowData="{modalList}"></modalcontent>
            </modal>
        </div>
    </div>
</template>

<script>
import actions from './PhotoActions.vue'
import { get, post } from '../helpers/api'
import Flash from '../helpers/flash'
import { toMulipartedForm } from '../helpers/form'
import modalcontent from './ModalContent.vue'
import VuePagination from './Pagination.vue'

export default {
    components: {
       actions,
       modalcontent,
       VuePagination
    },
    data() {
        return {
            rankingList : [],
            status: 'ranking',
            initURL: `/api/ranking`,
            namedRoute: 'ranks',
            modalList : {
                entry : [],
                candidate : []
            },
            loading: true,
            counter: 0,
            pagination: {
                total: 0,
                per_page: 5,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 5,
            page: null,
        }
    },
    mounted : function() {
        this.$route.query.page == null ? this.$route.query.page = 1 : this.page = this.$route.query.page;
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
                this.battleList = res.data;
            })
            .catch((err) => {
                alert(err);
            });
        },
        showModal($photo_id) {
            const form = toMulipartedForm({photo_id: $photo_id})
            post(`/api/stage`, form)
                .then((res) => {
                    if(res.data) {
                        Flash.setSuccess(res.data.message)
                        Vue.set(this.$data, 'modalList', res.data.form);
                        this.$modal.show('stage-view');
                    }
                    this.isProcessing = false
                })
                .catch((err) => {
                    if(err.response.status === 422) {
                        this.error = err.response.data
                    }
                    this.isProcessing = false
                })
        },
        getContents() {
            get( this.initURL + `?page=` + this.$route.query.page)
                .then((res) => {
                    this.rankingList = res.data.data;
                    this.pagination = res.data;
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