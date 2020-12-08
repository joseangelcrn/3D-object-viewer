<template>
    <div>
        <input type="file" @change="select">
        <progress :value="progress"></progress>
        <!-- Info del fichero -->
        <div v-if="file != null" class="bg-dark text-white">
            <p>Fichero: {{file.name}}</p>
            <p>Tamaño: {{(file.size/1024).toFixed(2)}} KB</p>
            <p>Progreso: {{progress}} % </p>
        </div>
    </div>
</template>
<script>
    export default {
        watch: {
            chunks(n, o) {
                if (n.length > 0) {
                    this.upload();
                }
            }
        },

        data() {
            return {
                file: null,
                chunks: [],
                uploaded: 0
            };
        },

        computed: {
            progress() {
                let progress = 0;

                if (this.file != null) {
                    // progress =  Math.floor((this.uploaded * 100) / this.file.size);
                    progress =  (this.uploaded * 100) / this.file.size;
                }

                return progress;
            },
            formData() {
                let formData = new FormData;

                formData.set('is_last', this.chunks.length === 1);
                formData.set('file', this.chunks[0], `${this.file.name}.part`);

                return formData;
            },
            config() {
                return {
                    method: 'POST',
                    data: this.formData,
                    url: 'test',
                    headers: {
                        'Content-Type': 'application/octet-stream'
                    },
                    onUploadProgress: event => {
                        this.uploaded += event.loaded;
                    }
                };
            }
        },

        methods: {
            select(event) {
                this.file = event.target.files.item(0);
                console.log(this.file);
                this.createChunks();
            },
            upload() {
                axios(this.config).then(response => {
                    this.chunks.shift();
                }).catch(error => {});
            },
            createChunks() {
                let size = 1024; //original
                // size = size * 10;
                let chunks = this.file.size.toFixed(2) / size;

                console.log(this.file.size+' /  '+size+' = '+chunks); //



                for (let i = 0; i < chunks; i++) {
                    this.chunks.push(this.file.slice(
                        i * size, Math.min(i * size + size, this.file.size), this.file.type
                    ));
                }
            }
        }
    }
</script>


