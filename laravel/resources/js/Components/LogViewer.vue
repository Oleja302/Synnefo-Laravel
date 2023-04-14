<template> 
    <table id="table" class="table table-sm table-hover" oncontextmenu="return false;">
        <thead>
            <tr> 
                <th class="text-center" scope="col">Description</th>
                <th class="text-center" scope="col">Created</th>
                <th class="text-center" scope="col">Updated</th> 
            </tr>
        </thead>
        <tbody> 
            <tr v-for="log in this.logs" :key="this.logs"> 
                <td>{{ log.description }}</td>
                <td>{{ log.created_at.split('T')[0] }}</td>
                <td>{{ log.updated_at.split('T')[0] }}</td>
            </tr>
        </tbody>
    </table> 
</template>

<script>
export default {
    data() {
        return {
            logs: ''
        }
    },
    mounted() {
        this.getLogs()
    },
    methods: { 
        getLogs() { 
            axios.get('/log/get').then( response => { this.logs = response.data }) 
        }
    }
} 
</script> 