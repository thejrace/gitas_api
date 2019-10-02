<template>
    <div class="widget">
        <div class="widget-header"> <i class="icon-truck"></i>
            <h3> Kullanıcı Otobüsleri</h3>
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
                    <div slot="defined-slot" slot-scope="props">
                        <button v-if="props.rowData.defined === 1" type="button" class="btn btn-success" title="Tanımla" @click="onAction('stop', props.rowData, props.rowIndex)"><i class="icon-plus"></i></button>
                        <button v-else type="button" class="btn btn-danger" title="Kaldır" @click="onAction('start', props.rowData, props.rowIndex)"><i class="icon-remove"></i></button>
                    </div>

                </vuetable>
                <vuetable-pagination ref="pagination" @vuetable-pagination:change-page="onChangePage" :css="css.pagination"></vuetable-pagination>
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
            userId: String,
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
                }
            },
        },
        data(){
            return {
                apiUrl:"/users/"+this.userId+"/buses/dataTables",
                css: CssConfig,
                fields:[
                    'id',
                    {
                        name: 'code',
                        title:'Kapı Kodu',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned',
                        sortField: 'code'
                    },
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
                        titleClass: 'center aligned',
                        dataClass: 'center aligned',
                        sortField: 'official_plate'
                    },
                    {
                        name: '__slot:defined-slot',
                        title:'Tanımlanmış',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned',
                        sortField: 'defined'
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