<template>

    <div v-else>
        <div v-if="shown.length">

            <div class="timestamp"> {{ timestamp }} </div>

            <ul class="kahya-container impersonatable">
                <li v-for="item in shown" class="clearfix" @click="impersonateV2(item.code)" v-bind:class="{ active:item.activeFlag }" >
                    <div class="status" v-bind:class="item.status"></div>
                    <div class="box position">{{ item.position}}</div>
                    <div class="box code">{{ item.code}}</div>
                    <div class="box code">{{ item.route}}</div>
                    <div class="box stop">{{ item.stop }}</div>
                    <div class="box direction" v-bind:class="{ 'backward':item['direction'], 'forward':!item['direction'] }">{{ ( item.direction === 0 ) ? 'Gidiş' : 'Dönüş' }}</div>
                </li>
            </ul>
        </div>

        <div v-else>
            Veri yok!
        </div>

    </div>

</template>

<script>
    export default {
        props:{
            routeCode: String
        },
        mounted() {
            this.fetch();
            this.timer = setInterval( this.fetch, 10000 );
        },

        data: () => ({
            shown: [],
            items: [],
            impersonateFlag:false,
            forwardList:[],
            backwardList:[],
            timestamp: null,
            timer: null,
            impersonatedBusCode: null,
        }),

        methods: {
            impersonateV2(busCode){
                if( this.impersonateFlag && this.impersonatedBusCode === busCode ) return;
                this.shown = [];
                let index;
                for( index = 0; index < this.items.length; index++ ){
                    if( this.items[index].code === busCode ){
                        this.impersonatedBusCode = busCode;
                        this.items[index].activeFlag = true;
                        for( let k = -5; k < 6; k++ ){
                            if( this.items[index-k] !== undefined ){
                                // skip active bus
                                if( k !== 0 ) this.items[index-k].position -= this.items[index].position;
                                this.shown.push(this.items[index-k]);
                            }
                        }
                    }
                }
                this.shown.reverse();
                this.impersonateFlag = true;
            },
            async fetch() {
                const response = await window.axios.get('/api/downloadRouteScannerData/'+this.routeCode);

                let activeData = JSON.parse(response.data.data);

                this.items = [];

                for( let x = 0; x < response.data.intersection_data.length; x++ ){
                    let allData = response.data.intersection_data[x];
                    let routeData = JSON.parse(allData.data);
                    var filtered = [];
                    for( let j = 0; j < routeData.data.length; j++ ){
                        routeData.data[j]['position'] += allData.total_diff;
                        if( allData.direction === 0 ){
                            if( routeData.data[j]['position'] < response.data.directionMergePoint && routeData.data[j]['position'] >= allData.intersection_index  ){
                                filtered.push( routeData.data[j] );
                            }
                        } else {
                            if( routeData.data[j]['position'] > response.data.directionMergePoint && routeData.data[j]['position'] >= allData.intersection_index  ){
                                filtered.push( routeData.data[j] );
                            }
                        }
                    }

                    this.items = this.items.concat(filtered);
                }
                this.items = this.items.concat(activeData.data);
                this.timestamp = activeData.timestamp;

                // remove undefined buses with undefined status
                for( let j = 0; j < this.items.length; j++ ) {
                    if (this.items[j].status === 'UNDEFINED') {
                        this.items.splice(j, 1);
                        continue;
                    }
                    this.items[j].activeFlag = false;
                }
                // sort list to impersonate
                this.items.sort((a, b) => (a.position < b.position ? 1 : -1));

                if( this.impersonateFlag ){
                    this.impersonateV2(this.impersonatedBusCode);
                } else {
                    this.shown = this.items;
                }

            }
        }
    }
</script>