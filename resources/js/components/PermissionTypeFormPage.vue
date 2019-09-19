<template>

    <div class="widget">
        <div class="widget-header"> <i class="icon-compass"></i>
            <h3><i>{{ form.name }}</i> - İzin Tipi Form</h3>
        </div>
        <!-- /widget-header -->
        <div class="widget-content">

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

        </div>
        <!-- /widget-content -->
    </div>
    <!-- /widget -->

</template>

<script>
    import Vue from 'vue'
    import { Form, HasError, AlertError } from 'vform'

    Vue.component(HasError.name, HasError);
    Vue.component(AlertError.name, AlertError);

    export default {
        props: {
            'dataId' : String
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
                const response = await this.form.post('/api/permission_types');
                this.actionStatusCallback(response.data.data);
            },
            async update() {
                const response = await this.form.put('/api/permission_types/'+this.dataId);
                this.actionStatusCallback(response.data.data);
            },
            async fetch() {
                const response = await window.axios.get('/api/permission_types/'+this.dataId);
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
            }
        }
    }
</script>