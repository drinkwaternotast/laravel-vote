<template>
<div>
    <div class="loading" v-show="loading"><i class="fa fa-spinner fa-pulse fa-fw"></i>loading...</div>
        <div class="photo__header" v-show="!loading">
            <h3>{{title}} List</h3>
            <div class="search_wrapper">
                <v-select 
                    :debounce="250"
                    :on-search="getOptions"
                    :options="options"
                    placeholder="Search Titles (EN/JP) / Character (EN)..."
                    label="tag"
                    :on-change="setTagData">
                </v-select>
                <router-link 
                    v-if="tag"
                    tag="button"
                    class="square_btn__tag_search" 
                    :to="{ name: 'tagSearchPhotos', params: { title_id: tag.title_id, tag_id: tag.tag_id } }">
                    <i class="fa fa-search fa-fw"></i>        
                </router-link>
            </div>
        </div>
    <div class="photo__row" v-show="!loading">
    	<div class="photo__list" v-if="photoList[0]">
    		<li class="photo__item" v-for="photo in photoList">
    			<photo :rowData="photo" :status="status"></photo>
                <div class="photo__action">
                    <div class="photo__action_main">
                        <button type="button"
                                class="square_btn__entry"
                                @click="showModal(photo.photo_id)">Entry
                        </button>
                    </div>
                    <actions :rowData="photo" :status="status"></actions>
                </div>
    		</li>
    	</div>
        <NotFoundPartial v-else></NotFoundPartial>
        <vue-pagination
                v-if="photoList[0]"
                class="pagination-default"
                v-bind:namedRoute="namedRoute"
                v-bind:pagination="pagination"
                v-on:click.native="getContents(pagination.current_page)"
                :offset="8">
        </vue-pagination> 
        <!-- insert modal window-->
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
import vSelect from 'vue-select'
import VuePagination from './Pagination.vue'
import NotFoundPartial from '../views/NotFoundPartial.vue'

export default {
    name: 'photos',
    components: {
       photo,
       actions,
       modalcontent,
       vSelect,
       VuePagination,
       NotFoundPartial
    },
    data: function() {
        return {
            photoList : [],
            error: {},
            initURL: `/api/photo`,
            namedRoute: 'photos',
            isProcessing: false,
            title: 'Photo',
            status: 'default',
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
            options: null,
            tag: {
                title_id: null,
                tag_id: null
            }
        }
    },
    created() {
        this.getContents(this.$route.query.page)
    },
    watch: {
        '$route' (to, from) {
            this.getContents(this.$route.query.page)
        }
    },
    methods: {
        showModal($photo_id) {
            const form = toMulipartedForm({photo_id: $photo_id})
            post(`/api/stage`, form)
                .then((res) => {
                    if(res.data) {
                        Flash.setSuccess(res.data.message)
                        Vue.set(this.$data, 'modalList', res.data.form);
                        this.$modal.show('stage-view');
                    }
                    this.loading = false
                })
                .catch((err) => {
                    if(err.response.status === 422) {
                        this.error = err.response.data
                    }
                    this.loading = false
                })
        },
        getContents(page) {
            get(this.initURL+ '?page=' + page)
                .then((res) => {
                    this.pagination = res.data;
                    this.photoList = res.data.data;
                    this.loading = false;
                })
                .catch((err) => {
                    if(err.response.status === 422) {
                        this.error = err.response.data
                    }
                    this.loading = false
                })
        },
        getOptions(search, loading) {
            loading(true)
            get('/api/tag/' + search)
            .then(res => {
               this.options = res.data.tag_data
               loading(false)
            })
            .catch((err) => {
                if(err.response.status === 500) {
                    Flash.setError('No matching data found')
                }
                this.loading = false
            })
        },
        setTagData: function(mutableValue) {
            this.tag = mutableValue
        },
    },
    filters: {
        //
    }
}
</script>