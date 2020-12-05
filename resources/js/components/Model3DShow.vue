<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h1>{{model.title}}</h1>
                <p class="bg-secondary p-2 rounded text-white mt-3">{{model.description}}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <model3d-viewer :path="path"></model3d-viewer>
            </div>
        </div>
    </div>
</template>
<style>
</style>
<script>
    export default {
        props:['model'],
        data(){
            return{
                path:''
            }
        },
        mounted() {
            console.log(this.$props.model);
            this.path = '../storage/models3D/'+this.$props.model.user.root_dir+'/'+this.$props.model.file_name;
        }
    }
</script>
