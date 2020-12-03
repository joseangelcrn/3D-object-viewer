<template>
    <div class="container">
       3d viewer
    </div>
</template>

<script>
    export default {
        props:['path'],
        data(){
            return{
            }
        },
        mounted() {
            console.log('3D viewer montado !.');
            console.log(this.$props.path);
        }
    }
</script>
