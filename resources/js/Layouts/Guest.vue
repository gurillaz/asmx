<template>
	<v-app>
		<v-main>
			<v-container fluid class="fill-height guest-bg-gradient">
                <slot/>
			</v-container>
		</v-main>
	</v-app>
</template>
<script>

    export default {
        components: {
        }
    }
</script>


<style scoped>
.guest-bg-gradient{


/* background: rgb(139,133,251);
background: radial-gradient(circle, rgba(139,133,251,1) 0%, rgba(211,211,246,1) 35%, rgba(255,255,255,1) 100%); */

background: rgb(139,133,251);
background: linear-gradient(13deg, rgba(139,133,251,1) 0%, rgba(211,211,246,1) 35%, rgba(255,255,255,1) 100%);

}
</style>
