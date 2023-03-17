<template>
    <div class="area d-flex justify-content-center align-items-center">
        <svg v-if="ico" @click="postFiles()" id="cloud" xmlns="http://www.w3.org/2000/svg" width="100" height="100"
            viewBox="0 0 2048 2048" xml:space="preserve">
            <path style="fill:#bbecff"
                d="M576.257 1390.887C399.388 1390.887 256 1247.5 256 1070.617c0-88.441 35.854-168.502 93.797-226.459 57.957-57.957 138.032-93.797 226.459-93.797h18.995c0-236.797 191.951-428.748 428.748-428.748s428.748 191.951 428.748 428.748h18.995c176.869 0 320.257 143.374 320.257 320.257 0 88.441-35.854 168.502-93.797 226.473-57.957 57.943-138.032 93.797-226.459 93.797H576.257z" />
            <path style="fill:#72b8ce"
                d="M1024 1726.388c-13.682 0-24.774-11.092-24.774-24.774v-575.965c0-13.682 11.092-24.774 24.774-24.774s24.774 11.092 24.774 24.774v575.965c0 13.682-11.092 24.774-24.774 24.774z" />
            <path style="fill:#72b8ce"
                d="M1024 1726.388a24.773 24.773 0 0 1-17.518-7.256l-135.206-135.207c-9.675-9.675-9.675-25.361 0-35.036 9.675-9.674 25.36-9.674 35.036 0L1024 1666.578l117.688-117.688c9.675-9.675 25.361-9.675 35.036 0 9.674 9.675 9.674 25.361 0 35.036l-135.207 135.207a24.773 24.773 0 0 1-17.517 7.255z" />
        </svg>
        <svg v-if="!ico" id="checkbox" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="100" height="100">
            <path style="fill:#3caa3c"
                d="M2 20h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2zm2.707-9.707L7 12.586l8.293-8.293 1.414 1.414L7 15.414l-3.707-3.707z" />
        </svg>

        <input @change="handleFileUpload($event)" type="file" ref="files" multiple="multiple" /> 
    </div>
</template>

<script>
export default {
    data() {
        return {
            files: '',
            ico: true,
        }
    },
    methods: {
        handleFileUpload(event) {
            this.ico = true

            this.files = this.$refs.files.files;
            document.getElementsByClassName("area")[0].style.borderColor = "#6495ED"
        },
        postFiles() {
            document.getElementsByClassName("area")[0].style.borderColor = "#3caa3c"
            this.ico = false

            let formData = new FormData();
            for (let i = 0; i < this.files.length; i++) {
                formData.append('files[' + i + ']', this.files[i]);
            }

            axios.post('upload-file',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            )
        }
    }
}
</script>

<style> #cloud {
     position: absolute;
     top: (calc 50% - 50px);
 }

 #checkbox {
     position: absolute;
     top: (calc 50% - 50px);
 }

 .area {
     width: 100%;
     height: 75vh;
     border: 4px dashed #6495ED;
     box-sizing: border-box;
 }

 .area input {
     width: 400%;
     height: 100%;
     margin-left: -300%;
     border: none;
     cursor: pointer;
 }

 .area input:focus {
     display: none;
 }
</style>