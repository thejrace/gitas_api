<template>

    <div class="widget">
        <div class="widget-header"> <i class="icon-compass"></i>
            <h3><i>{{ form.code }}</i> - Otobüs Form</h3>
        </div>
        <!-- /widget-header -->
        <div class="widget-content">

            <form @submit.prevent="action" @keydown="form.onKeydown($event)" class="form-horizontal" >
                <div class="control-group">
                    <div class="control-group">
                        <label class="control-label" for="official_plate">Kapı Kodu</label>
                        <div class="controls">
                            <input v-model="form.code" type="text" name="code" id="code">
                            <div class="alert alert-danger" v-if="form.errors.has('code')">
                                {{ form.errors.get('code') }}
                            </div>
                        </div>
                    </div>
                    <label class="control-label" for="active_plate">Aktif Plaka</label>
                    <div class="controls">
                        <input v-model="form.active_plate" type="text" name="active_plate" id="active_plate">
                        <div class="alert alert-danger" v-if="form.errors.has('active_plate')">
                            {{ form.errors.get('active_plate') }}
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="official_plate">Ruhsat Plaka</label>
                    <div class="controls">
                        <input v-model="form.official_plate" type="text" name="official_plate" id="official_plate">
                        <div class="alert alert-danger" v-if="form.errors.has('official_plate')">
                            {{ form.errors.get('official_plate') }}
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
                    active_plate: '',
                    official_plate: '',
                    code: ''
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
                const response = await this.form.post('/api/buses');
                this.actionStatusCallback(response.data.data);
            },

            async update() {
                const response = await this.form.put('/api/buses/'+this.dataId);
                this.actionStatusCallback(response.data.data);
            },
            async fetch() {
                const response = await window.axios.get('/api/buses/'+this.dataId);
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