<template>
    <form @submit.prevent="action" @keydown="form.onKeydown($event)" class="form-horizontal" >
        <div class="control-group">
            <label class="control-label" for="name">Name</label>
            <div class="controls">
                <input v-model="form.name" type="text" name="name" id="name">
                <div class="alert alert-danger" v-if="form.errors.has('name')">
                    {{ form.errors.get('name') }}
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="description">Description</label>
            <div class="controls">
                <textarea v-model="form.description" type="text" name="description" id="description"></textarea>
                <div class="alert alert-danger" v-if="form.errors.has('description')">
                    {{ form.errors.get('description') }}
                </div>
            </div>
        </div>
        <button :disabled="form.busy" type="submit">
            Save
        </button>
    </form>
</template>

<script>
    import Vue from 'vue'
    import { Form, HasError, AlertError } from 'vform'

    Vue.component(HasError.name, HasError);
    Vue.component(AlertError.name, AlertError);

    export default {
        props: {
            'dataId' : String,
            'permissionPrefix': String
        },
        data () {
            return {
                // Create a new form instance
                form: new Form({
                    name: '',
                    description: ''
                })
            }
        },
        methods: {
            action () {
                this.dataId
                    ? this.update()
                    : this.store();
            },
            async store() {
                const response = await this.form.post('/api/permissions');
                this.actionStatusCallback(response.data.data);
            },
            async update() {
                const response = await this.form.put('/api/permissions/'+this.dataId);
                this.actionStatusCallback(response.data.data);
            },
            async fetch() {
                const response = await window.axios.get('/api/permissions/'+this.dataId);
                this.form.fill(response.data.data);
            },
            actionStatusCallback( response ){
                ( response.hasOwnProperty('success') )
                    ? alert('Success!')
                    : alert('Error');
            }
        },
        mounted(){
            if( this.dataId ){
                this.fetch();
            } else {
                this.form.name = this.$props.permissionPrefix;
            }
        }
    }
</script>