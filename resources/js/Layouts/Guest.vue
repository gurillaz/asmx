<template>
	<v-app>
		<v-main>
			<v-container fluid class="fill-height  guest-bg-gradient">
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


<style lang="scss" scoped>


// Colors
$bg-color:#37474F;
$dot-color:#263238;

// Dimensions
$dot-size: 2px;
$dot-space: 15px;

.guest-bg-gradient {
	background:
		linear-gradient(90deg, $bg-color ($dot-space - $dot-size), transparent 1%) center,
		linear-gradient($bg-color ($dot-space - $dot-size), transparent 1%) center,
		$dot-color;
	background-size: $dot-space $dot-space;
}
</style>
