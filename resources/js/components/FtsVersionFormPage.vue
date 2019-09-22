<template>

    <div class="widget">
        <div class="widget-header"> <i class="icon-github"></i>
            <h3><i>{{ form.major }} . {{ form.minor }} . {{ form.patch }}</i> - FTS Version Form</h3>
        </div>
        <!-- /widget-header -->
        <div class="widget-content">

            <form @submit.prevent="action" @keydown="form.onKeydown($event)" class="form-horizontal" >
                <div class="control-group">
                    <div class="control-group">
                        <label class="control-label" for="major">Major</label>
                        <div class="controls">
                            <input v-model="form.major" type="text" name="major" id="major">
                            <div class="alert alert-danger" v-if="form.errors.has('major')">
                                {{ form.errors.get('major') }}
                            </div>
                        </div>
                    </div>
                    <label class="control-label" for="minor">Minor</label>
                    <div class="controls">
                        <input v-model="form.minor" type="text" name="minor" id="minor">
                        <div class="alert alert-danger" v-if="form.errors.has('minor')">
                            {{ form.errors.get('minor') }}
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="patch">Patch</label>
                    <div class="controls">
                        <input v-model="form.patch" type="text" name="patch" id="patch">
                        <div class="alert alert-danger" v-if="form.errors.has('patch')">
                            {{ form.errors.get('patch') }}
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="change_log"></label>
                    <div class="controls">
                        <textarea v-model="form.change_log" type="text" name="change_log" id="change_log"></textarea>
                        <div class="alert alert-danger" v-if="form.errors.has('change_log')">
                            {{ form.errors.get('change_log') }}
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
            dataId : {
                type: String,
                default: null
            }
        },
        data () {
            return {
                form: new Form({
                    major: '',
                    minor: '',
                    patch: '',
                    change_log: ''
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
                const response = await this.form.post('/api/ftsVersions');
                this.actionStatusCallback(response.data.data);
            },

            async update() {
                const response = await this.form.put('/api/ftsVersions/'+this.dataId);
                this.actionStatusCallback(response.data.data);
            },
            async fetch() {
                const response = await window.axios.get('/api/ftsVersions/'+this.dataId);
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