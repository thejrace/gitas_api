<template>
    <div class="filter-bar ui basic segment grid">
        <div class="ui form">
            <div class="inline field">
                <label>Ara:</label>
                <input type="text" v-model="filterText" class="three wide column" @keyup.enter="doFilter" placeholder="Arama..">
                <button class="btn" @click="doFilter" title="Ara"><i class="icon-search"></i></button>
                <button class="btn" @click="resetFilter" title="Sıfırla"><i class="icon-refresh"></i></button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            prefix: {
                type: String,
                default: null,
            }
        },
        data () {
            return {
                filterText: ''
            }
        },
        methods: {
            doFilter () {
                let eventName = 'filter-set';
                if( this.prefix ){
                    eventName = this.prefix + '-' + eventName;
                }
                this.$events.fire(eventName, this.filterText)
            },
            resetFilter () {
                this.filterText = '';  // clear the text in text input

                let eventName = 'filter-reset';
                if( this.prefix ){
                    eventName = this.prefix + '-' + eventName;
                }
                this.$events.fire(eventName, this.filterText)
            }
        }
    }
</script>