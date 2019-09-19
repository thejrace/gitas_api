<template>

    <div class="widget">
        <div class="widget-header"> <i class="icon-code"></i>
            <h3> Servisler</h3>
        </div>
        <!-- /widget-header -->
        <div class="widget-content">

            <div>
                <vue-table-filter-bar></vue-table-filter-bar>
                <vuetable ref="vuetable"
                          :api-url="apiUrl"
                          :fields="fields"
                          pagination-path="pagination"
                          :append-params="moreParams"
                          :css="css.table"
                          :http-options="httpOptions"
                          @vuetable:pagination-data="onPaginationData"
                >
                    <div slot="status-slot" slot-scope="props">
                        <button v-if="props.rowData.status === 1" type="button" class="btn btn-danger" title="Çalıştır" @click="onAction('stop', props.rowData, props.rowIndex)"><i class="icon-stop"></i></button>
                        <button v-else type="button" class="btn btn-success" title="Durdur" @click="onAction('start', props.rowData, props.rowIndex)"><i class="icon-play"></i></button>
                    </div>

                    <template slot="actions" scope="props">
                        <div class="custom-actions">
                            <button class="btn button" title="Ayarlar"
                                    @click="onAction('show-settings', props.rowData, props.rowIndex)">
                                <i class="icon-gears"></i>
                            </button>
                        </div>
                    </template>

                </vuetable>
                <vuetable-pagination ref="pagination" @vuetable-pagination:change-page="onChangePage"  :css="css.pagination"></vuetable-pagination>
            </div>

        </div>
        <!-- /widget-content -->
    </div>
    <!-- /widget -->

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
                    case 'show-settings':
                        location.href = '/services/'+data.id+'/settings';
                    break;
                    case 'start':
                        this.startService(data, 1);
                    break;

                    case 'stop':
                        this.stopService(data, 0);
                    break;
                }
            },
            async startService(item){
                this.changeServiceStatus(item.id, 1);
            },
            async stopService(item){
                this.changeServiceStatus(item.id, 0);
            },
            async changeServiceStatus( id, newStatus ){
                const response = await window.axios.put('/api/services/'+id+'/updateStatus', {status: newStatus});

                ( response.data.data.success )
                    ? alert('Success')
                    : alert('Error');

                location.reload();
            }
        },
        data(){
            return {
                apiUrl: '/services/dataTables',
                css: CssConfig,
                fields:[
                    'id',
                    {
                        name: 'type',
                        title:'Tip',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned',
                        sortField: 'type'
                    },
                    {
                        name: 'name',
                        title:'İsim',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned',
                        sortField: 'name'
                    },
                    {
                        name: '__slot:status-slot',
                        title:'Durum',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned',
                        sortField: 'status'
                    },
                    {
                        name: '__slot:actions',
                        title: 'İşlemler',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned'
                    },
                ],
                moreParams: {},
                httpOptions: {
                    headers: {
                        'Authorization': window.axios.defaults.headers.common['Authorization']
                    }
                }
            }
        }
    }
</script>