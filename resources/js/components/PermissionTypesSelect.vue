<template>
    <div>
        <select name="permission_type" id="permission_type">
            <option v-for="permission in permissionTypes" :value="permission.id" :selected="selectedId == permission.id" >
               {{ permission.name }}
            </option>
        </select>
    </div>
</template>

<script>
    export default {
        props:{
            selectedId : String
        },
        data(){
            return {
                permissionTypes: [
                    { id:1, name:'Obarey'},
                    { id:2, name:'Hederoy'},
                    { id:3, name:'At'},
                ],
            };
        },
        async fetch(){
            const response = await window.axios.get('/api/permission_types/');
            console.log(response);
            this.permissionTypes = response.data.data;
        },
        mounted(){
            //this.fetch();
        }
    }
</script>