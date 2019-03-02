<template>
    <div>
        <div class="loading" v-show="loading"><i class="fa fa-spinner fa-pulse fa-fw"></i>loading...</div>
        <div class="photo__header" v-show="!loading">
            <h3>{{status}} List</h3>
        </div>
        <div class="photo__row" v-show="!loading">
        	<div class="photo__list">
        		<li class="photo__item" v-for="favorite in favoriteList">

        			<photo :rowData="favorite" :status="status"></photo>

                    <div class="photo__action">
                        <div class="photo__action_main">
                            <button type="button"
                                    class="square_btn__entry"
                                    @click="showModal(favorite.photo_id)">Entry
                            </button>
                        </div>
                        
                        <actions :rowData="favorite" :status="status"></actions>                    
                    </div>

        		</li> 
        	</div>
            <vue-pagination
                    class="pagination-default"
                    v-bind:pagination="pagination"
                    v-on:click.native="getPage(pagination.current_page)"
                    :offset="8">
            </vue-pagination> 
            <!-- Modal window -->
            <modal name="stage-view" :width="500" :height="500">
                <modalcontent :rowData="{modalList}"></modalcontent>
            </modal>

        </div>
    </div>
</template>

<script>
import photo from './Photo.vue'
import actions from './PhotoActions.vue'
import Flash from '../helpers/flash'
import { get, post } from '../helpers/api'
import { toMulipartedForm } from '../helpers/form'
import modalcontent from './ModalContent.vue'
import VuePagination from './Pagination.vue'

export default {
    name: 'photos',
    components: {
       photo,
       actions,
       modalcontent,
       VuePagination
    },
    data: function() {
        return {
            favoriteList : [],
            error: {},
            initURL: `/api/favorite/`,
            isProcessing: false,
            status: 'favorite',
            modalList : {
                entry : [],
                candidate : []
            },
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
        }
    },
    mounted : function() {
        this.getPage(this.pagination.current_page);
    },
    methods: {
        showModal($photo_id) {
            const form = toMulipartedForm({photo_id: $photo_id})
            post(`/api/stage`, form)
                .then((res) => {
                    if(res.data) {
                        console.log(this.$data);
                        //Flash.setSuccess(res.data.message)
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
        getPage(page) {
            get(`/api/favorite?page=` + page)
                .then((res) => {
                    this.pagination = res.data;
                    this.favoriteList = res.data.data;
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