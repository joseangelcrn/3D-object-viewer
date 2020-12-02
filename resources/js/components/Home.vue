<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h2 class="text-center">{{user.name}}</h2>
            </div>
        </div>
         <div class="row my-4">
            <div class="col-lg-12 col-md-12 text-center">
                <a href="/model/create" class="btn btn-success">Subir objeto 3D</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-3 col-md-3 border rounded  m-1 py-2" v-for="(object,index) in objects" :key="index">
                <h3 class="text-center">{{object.title}}</h3>
                <p class="text-center">{{object.description}}</p>
                <div class="text-center">
                    <a href="#" class="btn btn-primary btn-sm">Ver</a>
                    <a href="#" class="btn btn-danger btn-sm">Borrar</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['user'],
        data(){
            return{
                objects:[
                    {
                        title:'Titulo 3d',
                        description:'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam illum laudantium iure! Praesentium accusantium quas atque dolor accusamus obcaecati quisquam, ratione molestiae aliquid. Eius esse eos ipsa culpa, nisi ullam.'
                    },
                    {
                        title:'Titulo 3d',
                        description:'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam illum laudantium iure! Praesentium accusantium quas atque dolor accusamus obcaecati quisquam, ratione molestiae aliquid. Eius esse eos ipsa culpa, nisi ullam.'
                    },
                    {
                        title:'Titulo 3d',
                        description:'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam illum laudantium iure! Praesentium accusantium quas atque dolor accusamus obcaecati quisquam, ratione molestiae aliquid. Eius esse eos ipsa culpa, nisi ullam.'
                    },
                    {
                        title:'Titulo 3d',
                        description:'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam illum laudantium iure! Praesentium accusantium quas atque dolor accusamus obcaecati quisquam, ratione molestiae aliquid. Eius esse eos ipsa culpa, nisi ullam.'
                    },
                    {
                        title:'Titulo 3d',
                        description:'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam illum laudantium iure! Praesentium accusantium quas atque dolor accusamus obcaecati quisquam, ratione molestiae aliquid. Eius esse eos ipsa culpa, nisi ullam.'
                    },
                    {
                        title:'Titulo 3d',
                        description:'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam illum laudantium iure! Praesentium accusantium quas atque dolor accusamus obcaecati quisquam, ratione molestiae aliquid. Eius esse eos ipsa culpa, nisi ullam.'
                    },
                    {
                        title:'Titulo 3d',
                        description:'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam illum laudantium iure! Praesentium accusantium quas atque dolor accusamus obcaecati quisquam, ratione molestiae aliquid. Eius esse eos ipsa culpa, nisi ullam.'
                    },
                    {
                        title:'Titulo 3d',
                        description:'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam illum laudantium iure! Praesentium accusantium quas atque dolor accusamus obcaecati quisquam, ratione molestiae aliquid. Eius esse eos ipsa culpa, nisi ullam.'
                    },
                    {
                        title:'Titulo 3d',
                        description:'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam illum laudantium iure! Praesentium accusantium quas atque dolor accusamus obcaecati quisquam, ratione molestiae aliquid. Eius esse eos ipsa culpa, nisi ullam.'
                    },
                    {
                        title:'Titulo 3d',
                        description:'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam illum laudantium iure! Praesentium accusantium quas atque dolor accusamus obcaecati quisquam, ratione molestiae aliquid. Eius esse eos ipsa culpa, nisi ullam.'
                    },
                    {
                        title:'Titulo 3d',
                        description:'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam illum laudantium iure! Praesentium accusantium quas atque dolor accusamus obcaecati quisquam, ratione molestiae aliquid. Eius esse eos ipsa culpa, nisi ullam.'
                    },
                ]
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
