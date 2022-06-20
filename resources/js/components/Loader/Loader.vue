<template>

    <template v-if="isLoading">
    <div class="d-flex justify-content-center">
        <img :src="Loader" />
    </div>
    </template>
</template>

<script>
import Loader from "../../src/assets/loader/loader.gif"
export default {
    props:{
        isLoading:Boolean
    },
    setup() {

        return { Loader }
    }
}
</script>

<style>
</style>
