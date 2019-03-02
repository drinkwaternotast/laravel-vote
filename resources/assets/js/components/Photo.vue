<template>
	<div class="photo__box">
		<router-link class="photo__inner" 
				v-if="status === 'default' || status ==='personal' || status ==='favorite'" 
				:to="{name: 'appendixPhotos', params: { photo_id: rowData.photo_id }}">
				<img :src="rowData.original_path">
		</router-link>
		<router-link class="photo__inner" 
				v-if="status === 'fan'" 
				:to="`/profile/${rowData.fan_id}`">
				<img :src="rowData.image" v-if="rowData.image">
		</router-link>
		<p>
			<b>
				<router-link class="photo__inner" :to="{name: 'profiles', params: { user_id: rowData.user_id }}">
			  		<p class="photo__user">{{rowData.name}}</p>
				</router-link>
			</b>
	  	</p>
	</div>
</template>

<script>

export default {
    props: {
        rowData: {
            type: Object,
            required: true,
        },
        status : {
            type: String,
            required: true,
        }

    }
}
</script>