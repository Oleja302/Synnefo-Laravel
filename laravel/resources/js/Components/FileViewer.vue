<template>
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown"
            aria-expanded="false">
            {{ this.type }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a @click="getFiles()" class="dropdown-item" href="#">Files</a></li>
            <li><a @click="getFavourite()" class="dropdown-item" href="#">Favourite</a></li>
            <li><a @click="getDeleted()" class="dropdown-item" href="#">Deleted</a></li>
        </ul>
    </div>

    <div id="inputRename" class="hide row m-2" v-on:keyup.enter="startRename" @keydown.esc="hideRename">
        <input id="textRename" v-model="this.file.path" class="col-6 rounded-pill" type="text">
    </div>

    <table id="table" class="table table-sm table-hover" oncontextmenu="return false;">
        <thead>
            <tr>
                <th class="text-center d-none" scope="col">id</th>
                <th class="text-center" scope="col">Title</th>
                <th class="text-center" scope="col">Type</th>
                <th class="text-center" scope="col">Created</th>
                <th class="text-center" scope="col">Updated</th>
            </tr>
        </thead>
        <tbody>
            <tr @dblclick="back()">
                <td colspan="100%"><i class="bi bi-arrow-90deg-up"></i></td>
            </tr>
            <tr v-for="file in this.viewFiles" :key="this.viewFiles" @click.right="showMenu(file, $event)"
                @dblclick="next(file, $event)" @click="markFile(file, $event)">
                <th class="d-none" scope="row">{{ file.id }}</th>

                <td>
                    <i v-if="file.id" class="bi bi-file-earmark-fill"></i>
                    <i v-if="!file.id" class="bi bi-folder-fill"></i>
                    {{ file.path }}
                </td>
                <td>{{ file.typeId.charAt(0).toUpperCase() + file.typeId.slice(1) }}</td>
                <td>{{ file.created_at.split('T')[0] }}</td>
                <td>{{ file.updated_at.split('T')[0] }}</td>
            </tr>
        </tbody>
    </table>

    <div id="menu" class="hide menu">
        <p><button @click="download()">Download <i class="bi bi-cloud-arrow-down-fill"></i></button></p>
        <p><button @click="favourite()">Favourite <i class="bi bi-star-fill"></i></button></p>
        <p><button @click="showRename()">Rename <i class="bi bi-pencil-square"></i></button></p>
        <p><button @click="remove()">Delete <i class="bi bi-trash-fill"></i></button></p>
    </div>

    <div id="favouriteMenu" class="hide menu">
        <p><button @click="downloadFavourite()">Download <i class="bi bi-cloud-arrow-down-fill"></i></button></p>
        <p><button @click="unfavourite()">Unfavourite <i class="bi bi-star"></i></button></p>
        <p><button @click="showRename()">Rename <i class="bi bi-pencil-square"></i></button></p>
        <p><button @click="removeFavourite()">Delete <i class="bi bi-trash-fill"></i></button></p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            type: '',
            files: [],
            viewFiles: [],
            markFiles: [],
            currentPath: '',
            level: 0,
            file: 0,
            initialFile: 0,
            event: ''
        }
    },
    mounted() {
        this.getFiles()
    },
    methods: {
        //Common function
        showFileTree() {

            this.viewFiles = []

            for (let i = 0; i < this.files.length; i++) {
                let path = this.files[i].path.split('/').slice(2).join('/')

                if (path.split('/').length <= this.level) continue

                if (path.includes(this.currentPath)) {
                    if (path.split('/')[this.level].match(/\./g)) {
                        this.viewFiles.push({
                            id: this.files[i].id,
                            path: this.files[i].path.split('/').at(-1),
                            typeId: this.files[i].typeId,
                            created_at: this.files[i].created_at,
                            updated_at: this.files[i].updated_at
                        })
                    }
                    else {
                        this.viewFiles.push({
                            id: '',
                            path: path.split('/')[this.level],
                            typeId: 'Folder',
                            created_at: '',
                            updated_at: ''
                        })
                    }
                }
            }

            const unique = [];
            this.viewFiles = this.viewFiles.filter(element => {
                if (!unique.includes(element.path)) {
                    unique.push(element.path);
                    return true;
                }
                return false;
            });

            this.refreshFileTree()
        },
        refreshFileTree() {
            let table = document.getElementById('table')
            while (table.rows.length - 2) {
                table.deleteRow(2);
            }
        },
        next(file, $event) {
            if (file.path.match(/\./g) == null) {
                this.currentPath += file.path + '/'
                this.level++

                this.markFiles = [] 
                this.showFileTree()
            } 
        },
        back() {
            if (this.level - 1 < 0) return
            this.currentPath = this.currentPath.split('/').filter(Boolean).slice(0, -1).join('/') 
            if(this.currentPath != '' && this.currentPath.at(-1)!='/') this.currentPath += '/'
            this.level-- 

            this.markFiles = [] 
            this.showFileTree() 
        },
        showMenu(file, $event) {
            if (document.getElementById('inputRename').classList.contains('hide') &&
            this.type != 'Deleted') {
                let menu
                if (this.type == 'Favourite') menu = document.getElementById('favouriteMenu')
                else menu = document.getElementById('menu')

                menu.style.position = "absolute";
                menu.style.left = $event.x + 'px';
                menu.style.top = $event.y + 'px';

                menu.classList.toggle('hide')

                this.file = file 
                this.initialFile = JSON.parse(JSON.stringify(file)) 
                this.event = $event
            }
        },
        markFile(file, $event) {
            if (file.id != '' 
            && this.type != 'Deleted') {
                let index = this.markFiles.indexOf(file.id)
                if (index >= 0)
                    this.markFiles.splice(index, 1)
                else
                    this.markFiles.push(file.id)
                $event.srcElement.parentElement.classList.toggle('mark-row')
            } 
        },
        removeFromFileTree()
        {
            this.files = this.files.filter(e => {
                return this.markFiles.indexOf(e.id) == -1;
            }) 
            
            this.viewFiles = this.viewFiles.filter(e => {
                return this.markFiles.indexOf(e.id) == -1;
            }) 
        },

        //Operation with file
        getFiles() {
            this.level = 0
            this.currentPath = ''
            this.type = "Files"

            axios.get('/file/get').then(
                response => {
                    this.files = response.data.data
                    this.showFileTree()
                })
        }, 
        download() {
            document.getElementById('menu').classList.add('hide')

            axios({
                method: 'post',
                url: 'file/download',
                data: {
                    filesID: this.markFiles
                },
                responseType: 'blob'
            })
                .then((response) => {
                    let fileURL = window.URL.createObjectURL(new Blob([response.data]));
                    let fURL = document.createElement('a');

                    fURL.href = fileURL;
                    fURL.setAttribute('download', 'archieve.zip');
                    document.body.appendChild(fURL);

                    fURL.click();
                });

            document.querySelectorAll(".mark-row").forEach(element => element.classList.remove('mark-row'));
            this.markFiles = []
        },
        showRename() {
            if (this.file.id != '') {
                document.getElementById('menu').classList.add('hide')
                document.getElementById('favouriteMenu').classList.add('hide')
                document.getElementById('inputRename').classList.remove('hide')
            }
        },
        startRename() {
            if (this.file.id == '' && document.getElementById("textRename").value == '') return;
            document.getElementById('inputRename').classList.add('hide')

            if(this.type == 'Files')
                axios.post('/file/rename',
                    {
                        id: this.file.id,
                        name: document.getElementById("textRename").value
                    }) 
            else if(this.type == 'Favourite')
                axios.post('/favourite/rename',
                    {
                        id: this.file.id,
                        name: document.getElementById("textRename").value
                    }) 
        },
        hideRename() {
            document.getElementById('inputRename').classList.add('hide') 
            this.file.path = this.initialFile.path
        },
        remove() {
            axios.post('/file/delete', this.markFiles)
            document.getElementById('menu').classList.add('hide')
            document.querySelectorAll(".mark-row").forEach(element => element.classList.remove('mark-row'))
            this.removeFromFileTree()
        },
        favourite() {
            axios.post('/file/favourite', this.markFiles)
            document.getElementById('menu').classList.add('hide')
            document.querySelectorAll(".mark-row").forEach(element => element.classList.remove('mark-row'));
            this.removeFromFileTree()
        },

        //Operation with favourite file
        getFavourite() {
            this.level = 0
            this.currentPath = ''
            this.type = "Favourite"

            axios.get('/file/favourite/get').then(
                response => {
                    this.files = response.data.data
                    this.showFileTree()
                })
        },
        downloadFavourite() {
            document.getElementById('favouriteMenu').classList.add('hide')

            axios({
                method: 'post',
                url: 'favourite/download',
                data: {
                    filesID: this.markFiles
                },
                responseType: 'blob'
            })
                .then((response) => {
                    let fileURL = window.URL.createObjectURL(new Blob([response.data]));
                    let fURL = document.createElement('a');

                    fURL.href = fileURL;
                    fURL.setAttribute('download', 'archieve.zip');
                    document.body.appendChild(fURL);

                    fURL.click();
                });

            document.querySelectorAll(".mark-row").forEach(element => element.classList.remove('mark-row'));
            this.markFiles = []
        },
        removeFavourite(){
            axios.post('/favourite/delete', this.markFiles)
            document.getElementById('favouriteMenu').classList.add('hide')
            document.querySelectorAll(".mark-row").forEach(element => element.classList.remove('mark-row'))
            this.removeFromFileTree()
        },
        unfavourite() {
            axios.post('/favourite/unfavourite', this.markFiles)
            document.getElementById('favouriteMenu').classList.add('hide')
            document.querySelectorAll(".mark-row").forEach(element => element.classList.remove('mark-row'))
            this.removeFromFileTree()
        },
        
        //Operation with deleted file
        getDeleted() {
            this.level = 0
            this.currentPath = ''
            this.type = "Deleted"

            axios.get('/file/deleted/get').then(
                response => {
                    this.files = response.data.data
                    this.showFileTree()
                })
        },
    }
} 
</script>

<style> .menu {
     padding: 10px;
     background-color: aliceblue;
     border-radius: 10px;
 }

 .hide {
     display: none;
 }

 .mark-row {
     background-color: aliceblue;
 }
</style>