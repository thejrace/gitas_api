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
        mounted() { // this method is called first when DOM is ready
            // download initial data
            this.fetch();
            // set timer to update data
            this.timer = setInterval( this.fetch, 10000 );
        },

        data: () => ({
            shown: [],
            items: [],
            impersonateFlag:false,
            timestamp: null,
            timer: null,
            impersonatedBusCode: null,
        }),

        methods: {
            impersonateV2(busCode){
                // reset shown data list
                this.shown = [];
                // index of active bus
                let index;
                // loop through the data to find bus with code busCode
                for( index = 0; index < this.items.length; index++ ){
                    if( this.items[index].code === busCode ){ // found!
                        // save bus code
                        this.impersonatedBusCode = busCode;
                        // set active flag for css class
                        this.items[index].activeFlag = true;
                        // find first 5 bus which are in front and back of our bus
                        for( let k = -5; k < 6; k++ ){
                            if( this.items[index-k] !== undefined ){
                                // skip active bus
                                if( k !== 0 ) this.items[index-k].position -= this.items[index].position; // calculate the stop difference
                                // add that bus to shown list
                                this.shown.push(this.items[index-k]);
                            }
                        }
                    }
                }
                // reverse the list to show data forward->backward
                this.shown.reverse();
                // set flag for impersonate
                this.impersonateFlag = true;
            },
            async fetch() {
                // get data from API
                const response = await window.axios.get('/api/downloadRouteScannerData/'+this.routeCode);

                // kahya data of the active bus
                let activeData = JSON.parse(response.data.data);

                // reset previous data
                this.items = [];

                // loop through intersections
                for( let x = 0; x < response.data.intersection_data.length; x++ ){
                    // single intersectiond data
                    let allData = response.data.intersection_data[x];
                    // kahya data of the intersected route
                    let routeData = JSON.parse(allData.data);
                    // we will put intersected bus data to this filtered list
                    var filtered = [];
                    // loop through instersected route's kahya data
                    for( let j = 0; j < routeData.data.length; j++ ){
                        // update the positions to match with active route's stop indexes
                        routeData.data[j]['position'] += allData.total_diff;
                        // for forward direction, we check if;
                        // bus is between intersection stop and direction merge point
                        if( allData.direction === 0 ){
                            if( routeData.data[j]['position'] < response.data.directionMergePoint && routeData.data[j]['position'] >= allData.intersection_index  ){
                                filtered.push( routeData.data[j] );
                            }
                        } else {
                            // for backward direction we check if;
                            // bus is between intersection stop and last stop
                            if( routeData.data[j]['position'] > response.data.directionMergePoint && routeData.data[j]['position'] >= allData.intersection_index  ){
                                filtered.push( routeData.data[j] );
                            }
                        }
                    }
                    // merge full data with intersection data
                    this.items = this.items.concat(filtered);
                }
                // merge active route's kahya data
                this.items = this.items.concat(activeData.data);
                // update timestamp data
                this.timestamp = activeData.timestamp;

                // remove undefined buses with undefined status
                for( let j = 0; j < this.items.length; j++ ) {
                    if (this.items[j].status === 'UNDEFINED') {
                        this.items.splice(j, 1);
                        continue;
                    }
                    this.items[j].activeFlag = false;
                }

                // sort list according to the positions
                this.items.sort((a, b) => (a.position < b.position ? 1 : -1));
                // if impersonate is active, call the method
                if( this.impersonateFlag ){
                    this.impersonateV2(this.impersonatedBusCode);
                } else {
                    this.shown = this.items;
                }

            }
        }
    }
</script>