<template>
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
                    <button class="ui basic button" title="İzinler"
                            @click="onAction('show-permissions', props.rowData, props.rowIndex)">
                        <i class="icon-key"></i>
                    </button>
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
        props: {
            permissionType: Number
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
                    case 'show-permissions':
                        window.open("/user_permissions/"+data.id,'_blank');
                        break;
                    case 'edit-item':
                        window.open("/users/form/"+data.id,'_blank');
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
                const response = await window.axios.delete('/api/users/'+dataId);
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