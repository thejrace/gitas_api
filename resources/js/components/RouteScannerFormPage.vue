<template>

    <div class="widget">
        <div class="widget-header"> <i class="icon-compass"></i>
            <h3><i>{{ form.code }}</i> - Kahya Form</h3>
        </div>
        <!-- /widget-header -->
        <div class="widget-content">

            <form @submit.prevent="action" @keydown="form.onKeydown($event)" class="form-horizontal" >

                <div class="top-nav">
                    <button :disabled="form.busy" type="submit" class="btn btn-success"><i class="icon-save"></i></button>
                </div>

                <div class="control-group">
                    <div class="control-group">
                        <label class="control-label" for="code">Hat</label>
                        <div class="controls">
                            <input v-model="form.code" type="text" name="code" id="code">
                            <div class="alert alert-danger" v-if="form.errors.has('code')">
                                {{ form.errors.get('code') }}
                            </div>
                        </div>
                    </div>
                </div>

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
            dataId : {
                type: String,
                default: null
            }
        },
        data () {
            return {
                form: new Form({
                    code: '',
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
                const response = await this.form.post('/api/routeScanners');
                this.actionStatusCallback(response.data.data);
            },

            async update() {
                const response = await this.form.put('/api/routeScanners/'+this.dataId);
                this.actionStatusCallback(response.data.data);
            },
            async fetch() {
                const response = await window.axios.get('/api/routeScanners/'+this.dataId);
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