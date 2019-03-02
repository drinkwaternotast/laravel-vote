<template>
    <div>
        <div class="photo__header">
            <h3>{{action}} Photo</h3>
            <div>
                <button class="square_btn__default" @click="save" :disabled="isProcessing">Publish</button>
                <button class="square_btn__default" @click="$router.back()" :disabled="isProcessing">Cancel</button>
            </div>
        </div>
        <div class="photo__row">
            <div class="photo__image">
                <div class="photo__box">
                    <image-upload v-model="form.image"></image-upload>
                    <small class="error__control" style="color: red;" v-if="error.image">{{error.image[0]}}</small>
                </div>
            </div>
            <div class="photo__details">
                <div class="photo__details_inner">
                    <div class="form__group">
                        <label>Character Tag</label>
                            <v-select 
                                :debounce="300"
                                :on-search="getOptions"
                                :options="options"
                                placeholder="Search Character (EN)"
                                label="tag"
                                :on-change="bindTagData">
                            </v-select>
                        <small class="error__control" style="color: blue;">※タイトルのみ日本語検索が可能です。キャラクター名(英語)が不明の場合は、日本語タイトルから探してみてください。</small>
                        <small class="error__control" style="color: red;" v-if="error.tag_data">{{error.tag_data[0]}}</small>
                        <small class="error__control" style="color: red;" v-if="error.messages">{{error.error}} / {{error.messages}}</small>
                    </div>
                    <div class="form__group">
                        <label>Description</label>
                            <textarea 
                                class="form__control form__description" 
                                placeholder="e.g.) It is a picture taken at Ikebukuro Japan! Pls check my photo list as well XD" 
                                v-model="form.description">
                            </textarea>
                        <small class="error__control" v-if="error.description">{{error.description[0]}}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import Vue from 'vue'
    import Flash from '../helpers/flash'
    import { get, post } from '../helpers/api'
    import { toMulipartedForm } from '../helpers/form'
    import ImageUpload from './ImageUpload.vue'
    import vSelect from 'vue-select'

    export default {
        components: {
            ImageUpload,
            vSelect,
        },
        data() {
            return {
                form: [],
                error: {},
                isProcessing: false,
                initializeURL: `/api/photo/create`,
                storeURL: `/api/photo`,
                action: 'Upload',
                options: null,
            }
        },
        created() {
            get(this.initializeURL)
                .then((res) => {
                    Vue.set(this.$data, 'form', res.data.form)
                })
        },
        methods: {
            // getOptions(search, loading) {
            //     loading(true)
            //     get('/api/tag/' + search)
            //     .then(res => {
            //         this.options = res.data.tag_data
            //         loading(false)
            //     })
            //     .catch((err) => {
            //         //
            //     })
            // },
            getOptions(search, loading) {
                loading(true)
                get('/api/tag/appropriate/' + search)
                .then(res => {
                    this.options = res.data.tag_data
                    loading(false)
                })
                .catch((err) => {
                    //
                })
            },
            bindTagData: function(mutableValue) {
                this.form.tag_data = mutableValue;
            },
            save() {
                const form = toMulipartedForm(this.form, this.$route.meta.mode)
                post(this.storeURL, form)
                    .then((res) => {
                        if(res.data.saved) {
                            Flash.setSuccess(res.data.message)
                            this.$router.push(`/photo`)
                        }
                        this.isProcessing = false
                    })
                    .catch((err) => {
                        if(err.response.status === 422 || err.response.status === 400) {
                            this.error = err.response.data
                        }
                        this.isProcessing = false
                    })
            }
        }
    }
</script>
