<template>
    <div>
        <vuetable ref="vuetable"
                  api-url="/api/buses"
                  :fields="fields"
                  pagination-path=""
                  :http-options="{ headers: {Authorization: 'Bearer tEZXkuGlRI9GKfMZVqpDndzO5uFxuxBR0nAHOFhYFrGKrvKf7AnIGo1qpX01'} }"
                  @vuetable:pagination-data="onPaginationData"
        ></vuetable>
        <vuetable-pagination ref="pagination" @vuetable-pagination:change-page="onChangePage"></vuetable-pagination>
    </div>
</template>

<script>
    import Vuetable from 'vuetable-2/src/components/Vuetable'
    import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'

    export default {
        components: {
            Vuetable,
            VuetablePagination
        },
        methods: {
            format(value){
                return '0000-00-00 00:00:00'
            },
            onPaginationData (paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
            },
            onChangePage (page) {
                this.$refs.vuetable.changePage(page)
            }
        },
        data(){
            return {
                fields:[
                    'id',
                    {
                        name: 'official_plate',
                        title:'Ruhsat Plaka',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned'
                    },
                    {
                        name: 'active_plate',
                        title:'Aktif Plaka'
                    },
                    {
                        name: 'created_at',
                        title:'Eklenme',
                        callback: 'format'
                    },
                ]
            }
        }
    }
</script>