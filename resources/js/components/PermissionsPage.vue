<template>

    <div class="widget">
        <div class="widget-header"> <i class="icon-key"></i>
            <h3 v-if="permissionType == 1">Kullanıcı İzinleri</h3>
            <h3 v-else>Modül İzinleri</h3>
        </div>
        <!-- /widget-header -->
        <div class="widget-content">

            <div class="top-nav">
                <a v-bind:href="createUrl"><button type="button" class="btn btn-info"><i class="icon-plus"></i></button></a>
            </div>

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
                            <button class="btn"
                                    @click="onAction('edit-item', props.rowData, props.rowIndex)">
                                <i class="icon-pencil"></i>
                            </button>
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
        props: {
            permissionType: String,
            createUrl: String,
        },
        components: {
            Vuetable,
            VuetablePagination
        },
        mounted() {
            this.$events.$on('filter-set', eventData => this.onFilterSet(eventData));
            this.$events.$on('filter-reset', e => this.onFilterReset());
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
                        location.href = "/permissions/update/"+this.permissionType+'/'+data.id;
                        break;
                    case 'delete-item':
                        var c = confirm('Are you şur?');
                        if( c ){
                            this.deleteItem(data.id);
                        }
                        break;
                }
            },
            async deleteItem( dataId ){
                const response = await window.axios.delete('/api/permissions/'+dataId);
                console.log(response);
                if( response.data.data.hasOwnProperty('success') ){
                    window.location.reload(true);
                }
            }
        },
        data(){
            return {
                apiUrl: '/permissions/dataTables/'+this.permissionType,
                css: CssConfig,
                fields:[
                    'id',
                    {
                        name: 'name',
                        title:'İsim',
                        titleClass: 'center aligned',
                        dataClass: 'center aligned',
                        sortField: 'name'
                    },
                    {
                        name: 'description',
                        title:'Açıklama'
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