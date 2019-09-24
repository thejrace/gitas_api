<template>

    <div class="widget">
        <div class="widget-header"> <i class="icon-compass"></i>
            <h3> Kahyalar</h3>
        </div>
        <!-- /widget-header -->
        <div class="widget-content">

            <div class="top-nav">
                <a v-bind:href="createUrl"><button type="button" class="ui basic button btn btn-info"><i class="icon-plus"></i></button></a>
                <button type="button" class="btn btn-success" title="Tümünü Başlat" @click="batchUpdate('startAll')"><i class="icon-play"></i></button>
                <button type="button" class="btn btn-danger" title="Tümünü Durdur" @click="batchUpdate('stopAll')"><i class="icon-stop"></i></button>
            </div>

            <div>
                <vue-table-filter-bar></vue-table-filter-bar>
                <vuetable ref="vuetable"
                          api-url="routeScanners/dataTables"
                          :fields="fields"
                          pagination-path="pagination"
                          :append-params="moreParams"
                          :css="css.table"
                          :http-options="httpOptions"
                          @vuetable:pagination-data="onPaginationData"
                >
                    <div slot="status-slot" slot-scope="props">
                        <button v-if="props.rowData.status === 1" type="button" class="btn btn-danger" title="Durdur" @click="onAction('stop', props.rowData, props.rowIndex)"><i class="icon-stop"></i></button>
                        <button v-else type="button" class="btn btn-success" title="Başlat" @click="onAction('start', props.rowData, props.rowIndex)"><i class="icon-play"></i></button>
                    </div>

                    <template slot="actions" scope="props">
                        <div class="custom-actions">
                            <a v-bind:href="'/routeScanners/preview/'+props.rowData.code" class="btn">
                                <i class="icon-eye-open"></i>
                            </a>
                            <a v-bind:href="'/routeScannerForm/'+props.rowData.id" class="btn">
                                <i class="icon-pencil"></i>
                            </a>
                            <button class="btn"
                                    @click="onAction('delete-item', props.rowData, props.rowIndex)">
                                <i class="icon-remove"></i>
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
        props:{
            createUrl: String,
        },
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
                    case 'delete-item':
                        var c = confirm('Are you şur?');
                        if( c ){
                            this.deleteItem(data.id);
                        }
                    break;
                    case 'start':
                        this.switchStatus(data.id, 'start');
                        break;
                    case 'stop':
                        this.switchStatus(data.id, 'stop');
                        break;
                }
            },
            async switchStatus(id, newStatus){
                await window.axios.put('/api/routeScanners/'+id+'/'+newStatus);
                this.$refs.vuetable.reload();
            },
            async batchUpdate(action){
                var c = confirm('Emin misin?');
                if( !c ) return;
                await window.axios.put('/api/routeScanners/'+action);
                this.$refs.vuetable.reload();
            },
            async deleteItem( dataId ){
                await window.axios.delete('/api/routeScanners/'+dataId);
                this.$refs.vuetable.reload();
            }
        },
        data(){
            return {
                css: CssConfig,
                fields:[
                    'id',
                    {
                        name: 'code',
                        title:'Hat',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned',
                        sortField: 'code'
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