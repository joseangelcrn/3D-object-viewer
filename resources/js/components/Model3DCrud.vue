<template>

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-10 col-md-10">
                <form>
                    <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" class="form-control" name="title" v-model="model3d.title">
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea class="form-control" rows="3" name="description" v-model="model3d.description"></textarea>
                    </div>

                    <div class="form-group" v-if="file ==  null">
                        <label>Fichero</label> <br>
                        <input type="file" name="file" @change="loadPreviewFile"  :disabled="file!= null">
                    </div>

                    <div class="form-group" v-if="file != null">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <img class="img-thumbnail" src="https://unity3d.com/profiles/unity3d/themes/unity/images/pages/branding_trademarks/unity-tab-square-black.png" alt="Preview Img">
                                <label>{{file.name}}</label>
                                <br>
                                <label>{{file.size/1024}} KB</label>
                                <button class="btn btn-sm btn-danger w-100" type="button" @click="deletePreviewFile">
                                    Borrar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button
                        :class="[isCreate ? 'btn btn-success' : 'btn btn-primary']"
                        :disabled="model3d.title.trim() === '' || sending || file == null"
                         type="button" @click="httpSend">
                            <span v-if="isCreate">Crear</span>
                            <span v-else>Actualizar</span>
                        </button>
                    </div>
                    <!-- Messages displayer -->
                    <div class="form-group">
                        <div
                            class="alert"
                            :class="{
                            'alert-success':isResponseOk === true,
                            'alert-danger':isResponseOk === false
                            }"
                            role="alert"
                            v-if="isResponseOk != null">

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="isResponseOk = null">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <p v-if="isResponseOk">Se ha guardado correctamente el modelo.</p>
                            <p v-else>Ha ocurrido un error al guardar el modelo.</p>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props:{
            model3d: {
                type: Object,
                default() {
                    return {
                        title:'titulo desde vuejs',
                        description:'descripcion desde vuejs'
                    }
                }
            }
        },
        data(){
            return{
                isCreate:true,
                isResponseOk:null,
                sending:false,
                file:null,
                headers:{
                    'Content-Type': 'multipart/form-data',
                }
            }
        },
        methods:{
            httpSend(){
                console.log('Envio!');
                console.log(this.$props.model3d);
                this.sending = true;

                if (this.isCreate) {
                    console.log('storing.. !');
                    this.store();
                } else {
                    console.log('updating..!');
                    this.update();
                }

            },
            store(){

                let data = new FormData();
                data.append('title',this.$props.model3d.title);
                data.append('description',this.$props.model3d.description);
                data.append('file',this.file);

                axios.post('/model',data,this.headers)
                .then(
                   (response)=>{
                       console.log(response);
                       this.isResponseOk = true;
                       this.clearForm();

                    },
                   (error)=>{
                        console.log(error);
                        this.isResponseOk = false;
                   }
                )
                .finally(() => {
                    console.log('Finally');
                    this.sending = false;
                });

            },
            update(){
                let data = new FormData();
                data.append('title',this.$props.model3d.title);
                data.append('description',this.$props.model3d.description);
                // data.append('file',this.file);
                console.log('Form');
                console.log(data);
                 axios.post('/model/' + this.$props.model3d.id, {
                    data: data,
                    _method: 'PUT'
                }).then(
                   (response)=>{
                       console.log('response');
                       console.log(response);
                       this.sending = false;
                    },
                   (error)=>{
                        console.log('error');
                        console.log(error);
                       this.sending = false;

                   }
                );
            },

            clearForm(){
                this.$props.model3d = {
                    title:'',
                    description:''
                };

                this.file = null;
            },
            loadPreviewFile(event){
                console.log('Pre-load files');
                this.file = event.target.files[0];
                console.log('----+++---');
                console.log(this.file);
            },
            deletePreviewFile(){
                console.log('Delete preview file');
                this.file = null;
            }
        },
        mounted() {
            console.log(this.$props.model3d);
            console.log('Component mounted.')
            if (this.$props.model3d.title != null) {
                this.isCreate = false;
                this.file = this.$props.model3d.file_name
            }
            console.log('isCreate ?: '+this.isCreate);
        },
        computed: {
        }
    }
</script>
