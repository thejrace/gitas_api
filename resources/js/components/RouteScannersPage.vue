<template>

    <div class="widget">
        <div class="widget-header"> <i class="icon-compass"></i>
            <h3> Kahyalar</h3>
        </div>
        <!-- /widget-header -->
        <div class="widget-content">

            <div class="top-nav">
                <a v-bind:href="createUrl"><button type="button" class="ui basic button btn btn-info"><i class="icon-plus"></i></button></a>
            </div>

            <div class="pricing-plans plans-3">
                <div class="plan-container" v-for="item in items">
                    <div class="plan" v-bind:class="{ 'green':item['status'], 'red':!item['status'] }">
                        <div class="plan-header">

                            <div class="plan-title">
                                {{ item.code }}
                            </div> <!-- /plan-title -->

                        </div> <!-- /plan-header -->

                        <div class="plan-features">
                            <ul>
                                <li><strong>{{  }}</strong> kullanıcı tanımlı.</li>
                            </ul>
                        </div> <!-- /plan-features -->

                        <div class="plan-actions">

                            <a href="javascript:;" @click="changeStatusAction(item)" class="btn" v-bind:class="{ 'btn-warning':item['status'], 'btn-success':!item['status'] }" ><i class="icon" v-bind:class="{ 'icon-stop':item['status'], 'icon-play':!item['status'] }"></i></a>
                            <a :href="'routeScannerForm/'+item.id" class="btn btn-info"><i class="icon icon-edit"></i></a>
                            <a :href="'routeScanners/preview/'+item.code" class="btn btn-info"><i class="icon icon-eye-open"></i></a>
                            <a href="javascript:;" @click="deleteAction(item)" class="btn btn-danger"><i class="icon icon-remove"></i></a>

                        </div> <!-- /plan-actions -->

                    </div> <!-- /plan -->
                </div> <!-- /plan-container -->
            </div> <!-- /pricing-plans -->

        </div>
        <!-- /widget-content -->
    </div>
    <!-- /widget -->


</template>

<script>
    export default {
        props:{
            createUrl: String,
        },
        data: () => ({
            items: []
        }),
        methods: {
            changeStatusAction(item){
                console.log(item);
            },
            deleteAction(item){

            },
            async fetch(){
                const response = await window.axios.get('/api/routeScanners');
                this.items = response.data.data;
            },
        },
        mounted(){
            this.fetch();
        }

    }
</script>