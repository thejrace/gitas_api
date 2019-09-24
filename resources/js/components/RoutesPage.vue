<template>

    <div class="widget">
        <div class="widget-header"> <i class="icon-road"></i>
            <h3> Hatlar</h3>
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
                    <template slot="actions" scope="props">
                        <div class="custom-actions">
                            <button class="btn" title="Duraklar"
                                    @click="onAction('show-stops', props.rowData, props.rowIndex)">
                                <i class="icon-map-marker"></i>
                            </button>
                            <button class="btn" title="Hat Kesişimleri"
                                    @click="onAction('show-intersections', props.rowData, props.rowIndex)">
                                <i class="icon-random"></i>
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
                    case 'show-stops':
                        location.href = "/routeStops/"+data.id;
                        break;
                    case 'show-intersections':
                        location.href = "/routeIntersections/"+data.id;
                        break;
                }
            },
        },
        data(){
            return {
                apiUrl: '/routes/dataTables',
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
                        name: 'name',
                        title:'İsim',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned',
                        sortField: 'name'
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