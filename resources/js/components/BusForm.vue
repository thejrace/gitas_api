<template>
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
</template>

<script>
    import Vue from 'vue'
    import { Form, HasError, AlertError } from 'vform'

    Vue.component(HasError.name, HasError);
    Vue.component(AlertError.name, AlertError);

    export default {
        props: {
            'updateFlag': Boolean,
            'dataId' : String
        },
        data () {
            return {
                // Create a new form instance
                form: new Form({
                    active_plate: '',
                    official_plate: '',
                    code: ''
                })
            }
        },
        methods: {
            action () {
                if( this.$props.updateFlag ){
                    this.form.put('/api/buses/'+this.$props.dataId)
                        .then(({ data }) => {
                            if( data.data.hasOwnProperty('success') ){
                                alert('Success!');
                            } else {
                                alert('Error');
                            }
                        })
                } else {
                    this.form.post('/api/buses')
                        .then(({ data }) => {
                            if( data.data.hasOwnProperty('success') ){
                                alert('Success!');
                            } else {
                                alert('Error');
                            }
                        })
                }
            },
            async fetch() {
                const response = await window.axios.get('/api/buses/'+this.$props.dataId);
                for( let key in response.data.data ){
                    if( this.form.hasOwnProperty(key) ){
                        this.form[key] = response.data.data[key];
                    }
                }
            }
        },
        mounted(){
            if( this.$props.updateFlag ){
                this.fetch();
            }
        }
    }
</script>