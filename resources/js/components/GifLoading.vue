<template>
    <div id="gif_loading">
        <img id="gif_img"  :src="'../storage/system/loader.gif'" alt="Gif loading">
    </div>
</template>
<style>
    #gif_loading{
        position: absolute;
        right:0;
        z-index: 1;
    }
    #gif_img{
        width:50px;
        height: 50px;
    }
</style>
<script>
    export default {
        data(){
            return{
                path:'../storage/system/loader.gif'
            }
        }

    }
</script>
