<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <model-obj :src="path"></model-obj>
            </div>
        </div>

    </div>
</template>

<script>
    import { ModelObj } from 'vue-3d-model';

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
