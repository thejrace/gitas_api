<template>
    <form @submit.prevent="login" @keydown="form.onKeydown($event)" class="form-horizontal" >

        <h1>Login</h1>

        <div class="login-fields">

            <p>Gitas Admin</p>

            <div class="field">
                <label for="email">Email</label>
                <input type="text" v-model="form.email" id="email" name="email" placeholder="Email" class="login username-field" />
                <div class="alert alert-danger" v-if="form.errors.has('email')">
                    {{ form.errors.get('email') }}
                </div>
            </div> <!-- /field -->

            <div class="field">
                <label for="password">Password:</label>
                <input type="password" v-model="form.password" id="password" name="password"  placeholder="Password" class="login password-field"/>
                <div class="alert alert-danger" v-if="form.errors.has('password')">
                    {{ form.errors.get('password') }}
                </div>
            </div> <!-- /password -->

        </div> <!-- /login-fields -->

        <div class="login-actions">

            <button :disabled="form.busy" class="button btn btn-success btn-large" type="submit">
                Login
            </button>

        </div> <!-- .actions -->
    </form>
</template>




<script>
    import Vue from 'vue'
    import { Form, HasError, AlertError } from 'vform'

    Vue.component(HasError.name, HasError);
    Vue.component(AlertError.name, AlertError);

    export default {
        data () {
            return {
                // Create a new form instance
                form: new Form({
                    email: '',
                    password: ''
                })
            }
        },

        methods: {
            login () {
                // Submit the form via a POST request
                this.form.post('/login')
                    .then(({ data }) => { location.reload(); })
            }
        }
    }
</script>