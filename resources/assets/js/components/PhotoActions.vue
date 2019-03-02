<template>
    <!-- button action -->
    <div class="photo__action_sub">
        <div>
            <button v-if="(status === 'default' || status ==='ranking' ) && rowData.isPrivateFlag !== 'true'" 
                    type="button" 
                    class="square_btn__favorite"
                    @click="addFavorite(rowData)">
                    <i class="fa fa-heart fa-fw"></i>
            </button>
        </div>
        <div>
            <button v-if="(status === 'default' || status ==='ranking'　|| status ==='favorite' || status ==='ranking')
                    && rowData.isPrivateFlag !== 'true'"
                    class="square_btn__fan"
                    @click="addFan(rowData)">
                    <i class="fa fa-user-plus fa-fw"></i>
            </button>
        </div>
        <div>
            <button v-if="status === 'favorite' && (authState.api_token && authState.user_id === rowData.user_id)"
                    class="square_btn__close"
                    @click="removeFavorite(rowData)">
                    <i class="fa fa-trash-o fa-fw"></i>
            </button>
        </div>
        <div>
            <button v-if="status === 'fan' && (authState.api_token && authState.user_id === rowData.user_id)"
                    class="square_btn__close"
                    @click="removeFan(rowData)">
                    <i class="fa fa-trash-o fa-fw"></i>
            </button>
        </div>
        <div>
            <router-link class="square_btn__close" 
                    v-if="(authState.api_token && authState.user_id === rowData.user_id) && rowData.isPrivateFlag == 'true'" tag="button" 
                    :to="{ name: 'currentPhotoBattles', params: { photo_id: rowData.photo_id }}">
                    <i class="fa fa-flag fa-fw"></i>
            </router-link>
        </div>
        <div>
            <button v-if="(authState.api_token && authState.user_id === rowData.user_id) && rowData.isPrivateFlag == 'true'"
                    class="square_btn__close" 
                    @click="removePhoto(rowData)">
                    <i class="fa fa-trash-o fa-fw"></i>
            </button>
        </div>
    </div>

</template>

<script>
import Auth from '../store/auth'
import { get, post, del } from '../helpers/api'
import { toMulipartedForm } from '../helpers/form'
import Flash from '../helpers/flash'

export default {
    data() {
        return {
            authState: Auth.state,
            loading: true,
        }
    },
    props: {
        //ここをPhotoListから受け取るデータへ変更する
        isRemoving: false,
        rowData: {
            type: Object,
            required: true,
        },
        status: {
            type: String,
            required: true,                
        }
    },
    methods: {
        //お気に入り登録
        addFavorite(rowData) {
            const form = toMulipartedForm({photo_id: this.rowData.photo_id})
            post(`/api/favorite`, form)
                .then((res) => {
                    if(res.data) {
                        Flash.setSuccess(res.data.message)
                        this.$router.push({ name: 'favorites'})
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
        //お気に入り登録
        addFan(rowData) {
            const form = toMulipartedForm({fan_id: this.rowData.user_id})
            post(`/api/fan`, form)
                .then((res) => {
                    if(res.data.registered) {
                        Flash.setSuccess(res.data.message)
                        this.$router.push({ name: 'fans'})
                    }
                    this.isProcessing = false
                })
                .catch((err) => {
                    if(err.response.status === 405) {
                        this.error = err.response.data
                        Flash.setError(this.error.messages)
                    }
                    this.isProcessing = false
                })
        },
        //showでは対戦中のバトル等を見れるようにする
        showData(rowData) {
            this.$dispatch('showData', rowData);
        },
        removeFavorite() {
            this.loading = false
            del(`/api/favorite/${this.rowData.favorite_id}`)
                .then((res) => {
                    if(res.data.deleted) {
                        // data re-set in the same page (do not send data from child to parent)
                        Flash.setSuccess('You have successfully deleted image from favorite list!')
                        location.reload();
                    }
                })
        },
        removePhoto(rowData) {
            this.loading = false
            del(`/api/photo/${this.rowData.photo_id}`)
                .then((res) => {
                    if(res.data.deleted) {
                        // data re-set in the same page (do not send data from child to parent)
                        Flash.setSuccess('You have successfully deleted image from photo list!')
                        location.reload();
                    }
                })
        },
        removeFan(rowData) {
            this.loading = false
            del(`/api/fan/${this.rowData.id}`)
                .then((res) => {
                    if(res.data.deleted) {
                        // data re-set in the same page (do not send data from child to parent)
                        Flash.setSuccess('You have successfully deleted user from fan list!')
                        location.reload();
                    }
                })
        }
    }
}
</script>
