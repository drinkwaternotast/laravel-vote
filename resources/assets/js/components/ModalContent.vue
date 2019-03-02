<template>
<!-- Modal Contents-->
    <div class="stage__wrapper">
        <div class="stage__box" v-if="rowData.modalList.entry">
            <img :src="rowData.modalList.entry.original_path">
            <p><b>
                <p class="recipe__name">{{rowData.modalList.entry.name}}</p>
            </b></p>
        </div>
        <NotFoundOpponent v-else></NotFoundOpponent>

        <div class="stage__box" v-if="rowData.modalList.candidate">
            <img :src="rowData.modalList.candidate.original_path">
            <p><b>
                <p class="recipe__name">{{rowData.modalList.candidate.name}}</p>
            </b></p>
        </div>
        <NotFoundOpponent v-else></NotFoundOpponent>

        <div class="stage__submit">
        <div class="stage__border">Are you sure you want to battle this user?</div>
            <button type="button" 
                    class="square_btn__battle_start" 
                    @click="confirm">Battle Start
            </button>
        </div>
        
    </div>
</template>

<script>
import { post } from '../helpers/api'
import Flash from '../helpers/flash'
import { toMulipartedForm } from '../helpers/form'
import NotFoundOpponent from '../views/NotFoundOpponent.vue'


export default {
    components: {
       NotFoundOpponent
    },
    props: {
        rowData: {
            type: Object,
            required: true,
        }
    },
    data: function() {
        return {
            error: {},
        }
    },
    created() {
    	//
    },
    methods: {
	    confirm () {
            const form = toMulipartedForm(this.rowData.modalList, this.$route.meta.mode)
            post(`/api/user/battles`, form)
                .then((res) => {
                    if(res.data) {
                        Flash.setSuccess(res.data.message)
                        this.$router.push({ name: 'currentBattles'})
                    }
                })
                .catch((err) => {
                    if(err.response.status === 405) {
                        Flash.setError(err.response.data.messages)
                    }
                })
	    }
    }
}
</script>