<template>
    <div>
        <vue-table-filter-bar></vue-table-filter-bar>
        <vuetable ref="vuetable"
                  api-url="buses/dataTables"
                  :fields="fields"
                  pagination-path="pagination"
                  :append-params="moreParams"
                  :css="css.table"
                  :http-options="{ headers: {Authorization: 'Bearer tEZXkuGlRI9GKfMZVqpDndzO5uFxuxBR0nAHOFhYFrGKrvKf7AnIGo1qpX01'} }"
                  @vuetable:pagination-data="onPaginationData"
        >
            <template slot="actions" scope="props">
                <div class="custom-actions">
                    <button class="ui basic button"
                            @click="onAction('edit-item', props.rowData, props.rowIndex)">
                        <i class="icon-pencil"></i>
                    </button>
                    <button class="ui basic button"
                            @click="onAction('delete-item', props.rowData, props.rowIndex)">
                        <i class="icon-remove"></i>
                    </button>
                </div>
            </template>
        </vuetable>
        <vuetable-pagination ref="pagination" @vuetable-pagination:change-page="onChangePage"  :css="css.pagination"></vuetable-pagination>
    </div>
</template>

<script>
    import Vuetable from 'vuetable-2/src/components/Vuetable';
    import VuetablePagination from 'vuetable-2/src/components/VuetablePagination';
    import CssConfig from './vuetable-styles.js';
    import VueEvents from 'vue-events';

    Vue.use(VueEvents);


    export default {
        components: {
            Vuetable,
            VuetablePagination
        },
        mounted() {
            this.$events.$on('filter-set', eventData => this.onFilterSet(eventData))
            this.$events.$on('filter-reset', e => this.onFilterReset())
        },
        methods: {
            transform(data){
                return this.vuetableTransformResponse(data);
            },
            onFilterSet (filterText) {
                this.moreParams = {
                    'filter': filterText
                };
                Vue.nextTick( () => this.$refs.vuetable.refresh())
            },
            onFilterReset () {
                this.moreParams = {}
                Vue.nextTick( () => this.$refs.vuetable.refresh())
            },
            onPaginationData (paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
            },
            onChangePage (page) {
                this.$refs.vuetable.changePage(page)
            },
            onAction (action, data, index) {
                switch( action ){
                    case 'edit-item':
                        window.open("/buses/busForm/"+data.id,'_blank');
                        break;
                    case 'delete-item':
                        break;
                }

                console.log('slot) action: ' + action, data.name, index)
            }
        },
        data(){
            return {
                css: CssConfig,
                fields:[
                    'id',
                    {
                        name: 'official_plate',
                        title:'Ruhsat Plaka',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned',
                        sortField: 'official_plate'
                    },
                    {
                        name: 'active_plate',
                        title:'Aktif Plaka',
                        sortField: 'official_plate'
                    },
                    {
                        name: 'created_at',
                        title:'Eklenme',
                    },
                    {
                        name: '__slot:actions',
                        title: 'Actions',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned'
                    },
                ],
                moreParams: {}
            }
        }
    }
</script>