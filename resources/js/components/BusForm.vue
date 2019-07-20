<template>
    <form @submit.prevent="action" @keydown="form.onKeydown($event)" class="form-horizontal" >
        <div class="control-group">
            <label class="control-label" for="active_plate">Active Plate</label>
            <div class="controls">
                <input v-model="form.active_plate" type="text" name="active_plate" id="active_plate">
                <div class="alert alert-danger" v-if="form.errors.has('active_plate')">
                    {{ form.errors.get('active_plate') }}
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="official_plate">Official Plate</label>
            <div class="controls">
                <input v-model="form.official_plate" type="text" name="official_plate" id="official_plate">
                <div class="alert alert-danger" v-if="form.errors.has('official_plate')">
                    {{ form.errors.get('official_plate') }}
                </div>
            </div>
        </div>
        <button :disabled="form.busy" type="submit">
            Add
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
                    store_data: 0
                })
            }
        },
        methods: {
            action () {
                if( this.$props.updateFlag ){
                    this.form.put('/api/buses/'+this.$props.dataId)
                        .then(({ data }) => { /*console.log(data)*/ })
                } else {
                    this.form.post('/api/buses')
                        .then(({ data }) => { /*console.log(data)*/ })
                }
            },
            async fetch() {
                const response = await window.axios.get('/api/buses/'+this.$props.dataId);
                this.form.active_plate = response.data.data[0].active_plate;
                this.form.official_plate = response.data.data[0].official_plate;
            }
        },
        mounted(){
            if( this.$props.updateFlag ){
                this.fetch();
            }
        }
    }
</script>