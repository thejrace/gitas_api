<template>
    <div class="widget">
        <div class="widget-header"> <i class="icon-truck"></i>
            <h3 v-if="type === 'defined'"><i>'{{userName}}'</i> Tanımlı Otobüsler</h3>
            <h3 v-else><i>'{{userName}}'</i> Otobüs Tanımla</h3>
        </div>

        <!-- /widget-header -->
        <div class="widget-content">

            <div>
                <vue-table-filter-bar :prefix="this.type"></vue-table-filter-bar>
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

                        <button v-if="type === 'defined'" type="button" class="btn btn-danger" title="Kaldır" @click="onAction('undefine', props.rowData, props.rowIndex)"><i class="icon-remove"></i></button>
                        <button v-else type="button" class="btn btn-success" title="Ekle" @click="onAction('define', props.rowData, props.rowIndex)"><i class="icon-plus"></i></button>
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
            userName: String,
            type:String,
        },
        components: {
            Vuetable,
            VuetablePagination
        },
        mounted() {
            this.$events.$on(this.type+'-filter-set', eventData => this.onFilterSet(eventData))
            this.$events.$on(this.type+'-filter-reset', e => this.onFilterReset())
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
                    case 'define':

                    break;

                    case 'undefine':

                    break;
                }
            },
        },
        data(){
            return {
                apiUrl:"/users/"+this.userId+"/buses/dataTables/"+this.type,
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
                        title:'Olaylar',
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