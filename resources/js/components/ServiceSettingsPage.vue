<template>

    <div class="widget">
        <div class="widget-header"> <i class="icon-code"></i>
            <h3><i>{{ serviceName }}</i> - Servis Ayarları</h3>
        </div>
        <!-- /widget-header -->
        <div class="widget-content">

            <form class="form-horizontal service-settings">

                <div class="top-nav">
                    <button type="button" class="btn btn-success" @click="save()"><i class="icon-save"></i></button>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend input-append">
                            <span class="add-on">API TOKEN</span>
                            <input v-model="serviceAPIToken" disabled class="span8" type="text">
                        </div>
                    </div>	<!-- /controls -->
                </div> <!-- /control-group -->
                <div class="dashed-seperator">
                    <label>YENİ EKLE</label>
                </div>

                <div class="control-group">
                    <label class="control-label">Key / Val / Açıklama</label>
                    <div class="controls">
                        <div class="input-prepend input-append">
                            <input class="span2" type="text" v-model="activeData.key" v-on:input="activeData.key = $event.target.value" placeholder="Key">
                            <input class="span1" type="text" v-model="activeData.value" v-on:input="activeData.value = $event.target.value" placeholder="Value">
                            <input class="span7" type="text" v-model="activeData.description" v-on:input="activeData.description = $event.target.value" placeholder="Açıklama">
                            <button type="button" class="btn btn-info" :disabled="busy" @click="add()"><i class="icon-plus"></i></button>
                        </div>
                    </div>	<!-- /controls -->
                </div> <!-- /control-group -->

                <div class="dashed-seperator">
                    <label>EKLİ AYARLAR</label>
                </div>

                <div class="control-group" v-if="settings"  v-for="setting in settings.slice().reverse()">
                    <label class="control-label">Key / Val / Açıklama</label>
                    <div class="controls">
                        <div class="input-prepend input-append">
                            <input class="span2" type="text" v-model="setting.key" placeholder="Key">
                            <input class="span1" type="text" v-model="setting.value" placeholder="Value">
                            <input class="span7" type="text" v-model="setting.description" placeholder="Value">
                            <button type="button" class="btn btn-danger" :disabled="busy" @click="remove(setting.key)"><i class="icon-remove"></i></button>
                        </div>
                    </div>	<!-- /controls -->
                </div> <!-- /control-group -->

            </form>

        </div>
        <!-- /widget-content -->
    </div>
    <!-- /widget -->

</template>

<script>
    export default {
        props:{
            dataId: String,
        },
        mounted() {
            this.fetch();
        },

        data: () => ({
            serviceName:null,
            serviceAPIToken: null,
            busy:false,
            status:null,
            settings: [],
            activeData:{
                key:'',
                value:'',
                description:'',
            }
        }),

        methods: {
            async add(){
                let data = Object.assign({}, this.activeData);
                this.settings.push(data);
                this.activeData.key = '';
                this.activeData.value = '';
                this.activeData.description = '';
            },
            async save(){
                this.busy = true;

                const response = await window.axios.put('/api/services/'+this.dataId+'/updateSettings', {settings: JSON.stringify(this.settings)});

                ( response.data.data.success )
                    ? alert('Success')
                    : alert('Error');

                this.busy = false;
            },
            remove(key){
                let index = this.settings.findIndex(function(elem){
                    return elem.key === key;
                });
                this.settings.splice(index,1);
            },
            async fetch() {
                const response = await window.axios.get('/api/services/'+this.dataId+'/settings');

                console.log(response.data);

                this.settings = response.data.data.settings;
                this.serviceName = response.data.data.name;
                this.serviceAPIToken = response.data.data.api_token;
            }
        }
    }
</script>

<style scoped>

</style>