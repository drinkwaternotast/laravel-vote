<template>
<!-- 親ビューは機能にする、子ビューはバトル一覧やマイバトルで再利用可能な素材にする -->
<div>
    <div class="loading" v-show="loading"><i class="fa fa-spinner fa-pulse fa-fw"></i>loading...</div>
        <div class="photo__header" v-show="!loading">
            <h3>{{status}} List</h3>
        </div>
    <div class="photo__row" v-show="!loading">
    	<div class="photo__list">
    		<li class="photo__item" v-for="fan in fanList">
    			<photo :rowData="fan" :status="status"></photo>
                <div class="photo__action">                    
                    <actions :rowData="fan" :status="status"></actions>                    
                </div>
    		</li>
    	</div>
        <vue-pagination
                class="pagination-default"
                v-bind:pagination="pagination"
                v-on:click.native="getPage(pagination.current_page)"
                :offset="8">
        </vue-pagination> 
    </div>
</div>
</template>

<script>
import photo from './Photo.vue'
import actions from './PhotoActions.vue'
import Flash from '../helpers/flash'
import { get, post } from '../helpers/api'
import { toMulipartedForm } from '../helpers/form'
import VuePagination from './Pagination.vue'

export default {
    name: 'photos',
    components: {
       photo,
       actions,
       VuePagination
    },
    data: function() {
        return {
            fanList : [],
            error: {},
            isProcessing: false,
            status: 'fan',
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
        getPage(page) {
            get(`/api/fan?page=` + page)
                .then((res) => {
                    this.pagination = res.data;
                    this.fanList = res.data.data;
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