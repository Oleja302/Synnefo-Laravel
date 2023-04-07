<template>
    <div id="areaFile" class="area d-flex justify-content-center align-items-center"> 
        
        <svg v-if="icoFile" @click="postFiles()" class="ico" width="90" height="90" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="mdi-file-upload">
            <path style="fill: #3E5F8A;" d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M13.5,16V19H10.5V16H8L12,12L16,16H13.5M13,9V3.5L18.5,9H13Z" />
        </svg>

        <svg v-if="!icoFile" id="checkbox" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="100" height="100">
            <path style="fill:#3caa3c"
                d="M2 20h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2zm2.707-9.707L7 12.586l8.293-8.293 1.414 1.414L7 15.414l-3.707-3.707z" />
        </svg>

        <input @change="handleFileUpload($event)" type="file" ref="files" multiple="" />
    </div>

    <div id="areaFolder" class="area d-flex justify-content-center align-items-center"> 

        <svg v-if="icoFolder" @click="postFolder()" class="ico" width="100" height="100" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="mdi-folder-upload">
            <path style="fill:#3E5F8A;" d="M20,6A2,2 0 0,1 22,8V18A2,2 0 0,1 20,20H4A2,2 0 0,1 2,18V6A2,2 0 0,1 4,4H10L12,6H20M10.75,13H14V17H16V13H19.25L15,8.75" />
        </svg>

        <svg v-if="!icoFolder" class="ico" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="100" height="100">
            <path style="fill:#3caa3c"
                d="M2 20h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2zm2.707-9.707L7 12.586l8.293-8.293 1.414 1.414L7 15.414l-3.707-3.707z" />
        </svg>

        <input @change="handleFolderUpload($event)" type="file" ref="folders" multiple="" directory="" webkitdirectory="" />
    </div>
</template>

<script>
export default {
    data() {
        return {
            files: [],
            icoFile: true,
            icoFolder: true,
        }
    },
    methods: {
        handleFileUpload(event) {
            this.icoFile = true
            this.files = this.$refs.files.files; 
            document.getElementById("areaFile").style.borderColor = "#A2ADD0" 
        },
        handleFolderUpload(event) {
            this.icoFolder = true
            this.files = this.$refs.folders.files;
            document.getElementById("areaFolder").style.borderColor = "#A2ADD0"
        },
        postFiles() {
            if(this.files.length==0) return

            document.getElementById("areaFile").style.borderColor = "#3caa3c"
            this.icoFile = false 

            let formData = new FormData();
            for (let i = 0; i < this.files.length; i++) {
                formData.append('files[' + i + ']', this.files[i]);
            } 

            axios.post('file/upload',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            )
        },
        postFolder() {
            if(this.files.length==0) return

            document.getElementById("areaFolder").style.borderColor = "#3caa3c"
            this.icoFolder = false 

            let formData = new FormData();
            let paths = [];
            for (let i = 0; i < this.files.length; i++) {
                formData.append('files[' + i + ']', this.files[i]);
                paths.push(this.files[i].webkitRelativePath)
            }

            formData.append('paths', paths);

            axios.post('folder/upload',
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

<style> 
 .ico {
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
     border: 4px dashed #A2ADD0;
     box-sizing: border-box;
 }

 #areaFile input {
     width: 100%;
     height: 150%; 
     border: none;
     cursor: pointer;
 }

 #areaFolder input { 
     width: 100%;
     height: 150%; 
     border: none;
     cursor: pointer;
 }

 .area input:focus {
     display: none;
 }</style>