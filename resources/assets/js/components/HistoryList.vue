<template>
<div>
    <div class="loading" v-show="loading"><i class="fa fa-spinner fa-pulse fa-fw"></i>loading...</div>
    <div class="photo__header" v-show="!loading">
        <h3>History List</h3>
    </div>
    <div class="history__row" v-show="!loading">
        <div class="history__list">
            <div class="history__wrapper" v-for="history in historyList">
                <p class="history__time">END TIME: {{ history.end_at }}</p>
                <div class="history__item">
                    <div class="history__box">
                        <router-link :to="`/appendix/${history.photo_you}`">
                            <img :src="history.p1_path">
                        </router-link>
                        <div class="caption" v-if="history.u1 == history.WINNER">
                            <p><b>{{ history.u1name }}</b></p>
                            <p class="history__circle"> {{ history.COUNT_like_you }} pt</p>
                        </div>
                        <div class="history__overlay" v-if="!(history.u1 == history.WINNER)">
                            <div class="caption">
                                <p><b>{{ history.u1name }}</b></p>
                                <p class="history__circle"> {{ history.COUNT_like_you }} pt</p>
                            </div>
                        </div>
                    </div>
                    <div class="history__versus">VS</div>
                    <div class="history__box" v-if="history">
                        <router-link class="photo__inner" :to="`/appendix/${history.photo_enemy}`">
                            <img :src="history.p2_path" v-if="history.p2_path">
                        </router-link>
                        <div class="caption" v-if="history.u2 == history.WINNER">
                            <p><b>{{ history.u2name }}</b></p>
                            <p class="history__circle"> {{ history.COUNT_like_enemy }} pt</p>
                        </div>
                        <div class="history__overlay" v-if="!(history.u2 == history.WINNER)">
                            <div class="caption">
                                <p><b>{{ history.u2name }}</b></p>
                                <p class="history__circle"> {{ history.COUNT_like_enemy }} pt</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <vue-pagination
                v-if="historyList[0]"
                class="pagination-default"
                v-bind:namedRoute="namedRoute"
                v-bind:pagination="pagination"
                v-on:click.native="getContents(pagination.current_page)"
                :offset="8">
        </vue-pagination> 
    </div>
</div>
</template>

<script>
import { get } from '../helpers/api'
import Flash from '../helpers/flash'
import VuePagination from './Pagination.vue'

export default {
    components: {
       VuePagination
    },
    data() {
        return {
            historyList : [],
            error: {},
            initURL: `/api/user/history/battles`,
            namedRoute: 'histories',
            status: 'history',
            loading: true,
            counter: 0,
            pagination: {
                total: 0,
                per_page: 8,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 8,
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
        getContents() {
            get( this.initURL + `?page=` + this.$route.query.page)
                .then((res) => {
                    this.historyList = res.data.data;
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