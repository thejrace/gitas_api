<template>
    <form @submit.prevent="login" @keydown="form.onKeydown($event)">
        <!-- Alert -->
        <div v-if="form.errors.any()">
            Validation error.
        </div>
        <div>
            <label for="active_plate">Active Plate</label>
            <input v-model="form.active_plate" type="text" name="active_plate" id="active_plate">
            <div v-if="form.errors.has('active_plate')">
                {{ form.errors.get('active_plate') }}
            </div>
        </div>
        <div>
            <label for="official_plate">Official Plate</label>
            <input v-model="form.official_plate" type="text" name="official_plate" id="official_plate">
            <div v-if="form.errors.has('official_plate')">
                {{ form.errors.get('official_plate') }}
            </div>
        </div>
        <div>
            <label>
                <input v-model="form.store_data" type="checkbox" value="1"  >
                Store Data
            </label>
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
            login () {
                // Submit the form via a POST request
                this.form.post('/api/buses')
                    .then(({ data }) => { console.log(data) })
            }
        }
    }
</script>