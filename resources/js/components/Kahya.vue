<template>

    <div v-if="impersonateFlag">

        <div class="timestamp"> {{ timestamp }} </div>

        <ul class="kahya-container">

            <li v-for="item in forwardList" class="clearfix" v-bind:class="{ active:item.activeFlag }" >
                <div class="status" v-bind:class="item.status" v-on="{ click:item.activeFlag ? stopImpersonate : null }"></div>
                <div class="box position">{{ item.position}}</div>
                <div class="box code">{{ item.code}}</div>
                <div class="box stop">{{ item.stop }}</div>
                <div class="box direction" v-bind:class="{ 'backward':item['direction'], 'forward':!item['direction'] }">{{ ( item.direction === 0 ) ? 'Gidiş' : 'Dönüş' }}</div>
            </li>

            <li v-for="item in backwardList" class="clearfix" >
                <div class="status" v-bind:class="item.status"></div>
                <div class="box position">{{ item.position}}</div>
                <div class="box code">{{ item.code}}</div>
                <div class="box stop">{{ item.stop }}</div>
                <div class="box direction" v-bind:class="{ 'backward':item['direction'], 'forward':!item['direction'] }">{{ ( item.direction === 0 ) ? 'Gidiş' : 'Dönüş' }}</div>
            </li>

        </ul>

    </div>

    <div v-else>
        <div v-if="items.length">

            <div class="timestamp"> {{ timestamp }} </div>

            <ul class="kahya-container impersonatable">
                <li v-for="(item, index) in items" class="clearfix" @click="impersonate(item, index)">
                    <div class="status" v-bind:class="item.status"></div>
                    <div class="box position">{{ item.position}}</div>
                    <div class="box code">{{ item.code}}</div>
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
        },

        data: () => ({
            items: [],
            impersonateFlag:false,
            forwardList:[],
            backwardList:[],
            timestamp: null,
        }),

        methods: {
            stopImpersonate(){
                this.impersonateFlag = false;
                this.fetch();  // @todo find a way to immutable clone an array
                this.forwardList = [];
                this.backwardList = [];
            },
            impersonate(bus, index){
                this.impersonateFlag = true;
                let x = index, k = index;
                let prev, next;

                // active bus
                bus.activeFlag = true;
                this.forwardList.push(bus);

                // find its adjacent buses
                for( let j = 0; j < 3; j++ ){
                    k--;
                    x++;
                    prev = this.items[x];
                    next = this.items[k];

                    if( prev ){
                        prev.position =  prev.position - bus.position;
                        this.backwardList.push(prev);
                    }
                    if( next ){
                        next.position = '+' + (next.position - bus.position);
                        this.forwardList.push(next);
                    }
                }

                this.forwardList.reverse();
            },
            async fetch() {
                const response = await window.axios.get('/api/downloadRouteScannerData/'+this.routeCode);

                this.items = response.data.data;
                this.timestamp = response.data.timestamp;

                // remove undefined buses with undefined status
                for( let j = 0; j < this.items.length; j++ ) {
                    this.items[j].activeFlag = false;
                    if (this.items[j].status === 'UNDEFINED') {
                        this.items.splice(j, 1);
                    }
                }
                // sort list to impersonate
                this.items.sort((a, b) => (a.position < b.position ? 1 : -1));
            }
        }
    }
</script>