<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h2 class="text-center">{{user.name}}</h2>
            </div>
        </div>
         <div class="row my-4">
            <div class="col-lg-12 col-md-12 text-center">
                <a href="/model/create" class="btn btn-success">Subir modelo 3D</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <ul class="list-group">
                    <li class="list-group-item" v-for="(model,index) in data_models" :key="index">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-xs-6">
                                {{model.title}}
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-6">
                                <a :href="'/model/'+model.id" class="btn btn-primary btn-sm border-dark" :class="[sending ? 'disabled' : '']">Ver</a>
                                <a :href="'/model/'+model.id+'/edit'" class="btn btn-warning btn-sm border-dark" :class="[sending ? 'disabled' : '']">Editar</a>
                                <a  @click="deleteModelWithConfirm(model.id,index)" class="btn btn-danger btn-sm border-dark" :class="[sending ? 'disabled' : '']">Borrar</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    <vue-confirm-dialog></vue-confirm-dialog>

    </div>
</template>

<script>
    export default {
        props:['user','models'],
        data(){
            return{
                data_user:[],
                data_models:[],
                sending:false
            }
        },
        methods:{
            deleteModel(idModel,index){
                    let that = this;
                    this.sending = true;
                    axios.delete('model/'+idModel, {params: {'id': idModel}})
                    .then(
                        (response)=>{
                            console.log('respnse');
                            console.log(response.status);
                            if (response.status === 200) {
                                that.deleteModelFromView(index);
                            }
                            that.sending = false;
                        },
                        (error)=>{
                            console.log('error');
                            console.log(error);
                            that.sending = false;

                        },
                    );


            },
            deleteModelFromView(index){
                this.data_models.splice(index,1)
            },
            deleteModelWithConfirm(idModel,index){
                let modelTitle = this.data_user.models[index].title;
                let message = "¿Estas seguro/a que deseas eliminar el modelo 3d con titulo: '"+modelTitle+"'?"
                let that = this;

                this.$confirm(
                        {
                        message,
                        button: {
                            no: 'No',
                            yes: 'Si'
                        },
                        /**
                         * Callback Function
                         * @param {Boolean} confirm
                         */
                        callback: (confirm) => {
                            if (confirm) {
                                this.deleteModel(idModel,index);
                            }
                        }
                        }
                    )
            }
        },
        beforeMount(){
            this.data_user = this.$props.user;
            this.data_models = this.$props.models;

        },
        mounted() {
            console.log('Component mounted.')
            console.log(this.$props.user);
        }
    }
</script>
