<template>
<div>
    <div class="loading" v-show="loading"><i class="fa fa-spinner fa-pulse fa-fw"></i>loading...</div>
    <div class="appendix" v-show="!loading">
    	<div class="appendix__box">
    		<img :src="appendixList.photo.original_path">
    	</div>
        <div class="appendix__infomation">
            <div class="appendix__photo_info">
                <p v-if="appendixList.tags" class="appendix__title">{{appendixList.tags.title}}</p>
                <div v-if="appendixList.tags" class="border">{{ appendixList.tags.character }}</div>
                <p v-if="appendixList.photo.description">{{appendixList.photo.description}}</p>
            </div>
            <div class="appendix__battle_info">
                <div class="appendix__flag">
                    <div><i class="fa fa-trophy fa-fw"></i>{{appendixList.history.wonCount}}</div>
                    <div><i class="fa fa-flag-o fa-fw"></i>{{appendixList.history.entryCount}}</div>
                </div>
                <div class="appendix__ratio">
                    <div style="font-size: 1.6em;"><b>{{appendixList.history.winRatio}}</b></div>
                    <div>win ratio</div>
                </div>
                <div class="appendix__link">
                    <router-link :to="{ name: 'profiles', params: { user_id: appendixList.photo.user_id }}">Profile
                        <i class="fa fa-external-link fa-border"></i>
                    </router-link>
                </div>
            </div>
            <div class="appendix__battle_info">
                <div style="font-size:0.8em; display:flex;">
                    <p><router-link :to="{ name: 'currentPhotoBattles', params: { photo_id: appendixList.photo.photo_id }}">This photo's current battle
                        <i class="fa fa-external-link fa-fw"></i>
                    </router-link></p>
                    <p><router-link :to="{ name: 'historyPhotoBattles', params: { photo_id: appendixList.photo.photo_id }}">This photo's battle history
                        <i class="fa fa-external-link fa-fw"></i>
                    </router-link></p>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { get, post } from '../helpers/api'
import Flash from '../helpers/flash'

export default {
    data() {
        return {
            appendixList : {
                photo: {},
                // tags: {},
                history: {}
            },
            error: {},
            loading: true,
        }
    },
    created() {
        get(`/api/appendix/${this.$route.params.photo_id}`)
            .then((res) => {
                this.appendixList = res.data;
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