<template>

    <div class="widget">
        <div class="widget-header"> <i class="icon-map-marker"></i>
            <h3><i>{{ routeName }}</i> - Duraklar</h3>
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
        props: {
            'parentId': String,
        },
        components: {
            Vuetable,
            VuetablePagination
        },
        mounted() {
            this.fetch();
            this.$events.$on('filter-set', eventData => this.onFilterSet(eventData));
            this.$events.$on('filter-reset', e => this.onFilterReset());
        },
        methods: {
            async fetch(){
                const response = await window.axios.get('/api/routes/'+this.parentId);
                this.routeName = response.data.data.code + ' ' + response.data.data.name;
            },
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

            },
        },
        data(){
            return {
                routeName:null,
                apiUrl: '/routeStops/'+this.parentId+'/dataTables',
                css: CssConfig,
                fields:[
                    {
                        name: 'route',
                        title:'Hat',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned',
                        sortField: 'route'
                    },
                    {
                        name: 'no',
                        title:'No',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned',
                        sortField: 'no'
                    },
                    {
                        name: 'name',
                        title:'İsim',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned',
                        sortField: 'name'
                    },
                    {
                        name: 'direction',
                        title:'Yön',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned',
                        sortField: 'direction'
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