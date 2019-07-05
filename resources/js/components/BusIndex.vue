<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> Bus List</div>

                    <div class="card-body">
                       


<div v-if="items.length">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Active Plate</th>
                <th>Official Plte</th>
                <th>Store Data</th>
                <th>Created At</th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="item in items">
                <td>{{ item.id }}</td>
                <td>{{ item.active_plate }}</td>
                <td class="ahmet">{{ item.official_plate }}</td>
                <td>{{ item.store_data == 1 ? 'Yes' : 'No' }}</td>
                <td>{{ item.created_at }}</td>
            </tr>
        </tbody>
    </table>
</div>

<div v-else>
    Bus list is empty
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.fetch();
        },

        data: () => ({
            items: []
        }),

        methods: {
            async fetch() {
                const response = await window.axios.get('/api/buses');

                this.items = response.data.data;
            }
        }
    }
</script>
