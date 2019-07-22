<template>
    <form @submit.prevent="action" @keydown="form.onKeydown($event)" class="form-horizontal" >
        <div class="control-group">
            <label class="control-label" for="name">İsim</label>
            <div class="controls">
                <input v-model="form.name" type="text" name="name" id="name">
                <div class="alert alert-danger" v-if="form.errors.has('name')">
                    {{ form.errors.get('name') }}
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="email">Email</label>
            <div class="controls">
                <input v-model="form.email" type="text" name="email" id="email">
                <div class="alert alert-danger" v-if="form.errors.has('email')">
                    {{ form.errors.get('email') }}
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="password">Password</label>
            <div class="controls">
                <input v-model="form.password" type="password" name="password" id="password">
                <div class="alert alert-danger" v-if="form.errors.has('password')">
                    {{ form.errors.get('password') }}
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
                    name: '',
                    email: '',
                    password: ''
                })
            }
        },
        methods: {
            action () {
                if( this.$props.updateFlag ){

                    this.form.put('/api/app_module_users/'+this.$props.dataId)
                        .then(({ data }) => {
                            if( data.data.hasOwnProperty('success') ){
                                alert('Success!');
                            } else {
                                alert('Error');
                            }
                        })
                } else {
                    this.form.post('/api/app_module_users')
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
                const response = await window.axios.get('/api/app_module_users/'+this.$props.dataId);
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