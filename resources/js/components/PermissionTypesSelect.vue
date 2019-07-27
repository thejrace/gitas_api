<template>
    <div class="control-group">
        <label class="control-label" for="permission_type">İzin Tipi</label>
        <div class="controls">
            <select name="permission_type" id="permission_type">
                <option v-for="permission in permissionTypes" :value="permission.id" :selected="selectedId == permission.id" >
                    {{ permission.name }}
                </option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            selectedId : String
        },
        data(){
            return {
                permissionTypes: [],
            };
        },
        methods: {
            async fetch(){
                const response = await window.axios.get('/api/permission_types/');
                console.log(response);
                this.permissionTypes = response.data.data;
            },
        },
        mounted(){
            this.fetch();
        }
    }
</script>