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
                    <li class="list-group-item" v-for="(model,index) in data_user.models" :key="index">
                        <div class="row">
                            <div class="col-lg-8 col-md-6">
                                {{model.title}}
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <a :href="'/model/'+model.id" class="btn btn-primary btn-sm" :class="[sending ? 'disabled' : '']">Ver</a>
                                <a  @click="deleteModel(model.id,index)" class="btn btn-danger btn-sm" :class="[sending ? 'disabled' : '']">Borrar</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- <div class="row d-flex justify-content-center">
            <div class="col-lg-3 col-md-3 border rounded  m-1 py-2" v-for="(model,index) in data_user.models" :key="index">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center">{{model.title}}</h3>
                        <p class="text-center">{{model.description}}</p>
                    </div>
                </div>
               <div class="row justify-content-center bg-blue flex-grow-1">
                    <div class="    col-lg-12 col-md-12" >
                        <a :href="'/model/'+model.id" class="btn btn-primary btn-sm" :class="[sending ? 'disabled' : '']">Ver</a>
                        <a  @click="deleteModel(model.id,index)" class="btn btn-danger btn-sm" :class="[sending ? 'disabled' : '']">Borrar</a>
                    </div>
               </div>
            </div>
        </div> -->
<!--  -->



    </div>
</template>

<script>
    export default {
        props:['user'],
        data(){
            return{
                data_user:[],
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
                this.data_user.models.splice(index,1)
            }
        },
        beforeMount(){
            this.data_user = this.$props.user;
        },
        mounted() {
            console.log('Component mounted.')
            console.log(this.$props.user);
        }
    }
</script>
