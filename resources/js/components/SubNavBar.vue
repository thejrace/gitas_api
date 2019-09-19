<template>
    <!-- /navbar -->
    <div class="subnavbar">
        <div class="subnavbar-inner">
            <div class="container">
                <ul class="mainnav">
                    <li v-for="nav in navs" v-bind:class="[ nav['active'] ? 'active' : '']"><a v-bind:href="nav.href" ><i v-bind:class="[ nav['icon'] ]"></i><span>{{ nav.title }}</span></a></li>
                </ul>
            </div>
            <!-- /container -->
        </div>
        <!-- /subnavbar-inner -->
    </div>
    <!-- /subnavbar -->
</template>

<script>
    import $ from 'jquery';

    export default {
        name: "SubNavBar",
        data(){
            return {
                navs:[
                    {
                        title:'Kullanıcılar',
                        href:'/moduleUsers',
                        icon:'icon-group',
                        active:false,
                    },
                    {
                        title:'Kahyalar',
                        href:'/routeScanners',
                        icon:'icon-compass',
                        active:false,
                    },
                    {
                        title:'Servisler',
                        href:'/services',
                        icon:'icon-code',
                        active:false,
                    },
                    {
                        title:'Hatlar',
                        href:'/routes',
                        icon:'icon-road',
                        active:false,
                    },
                    {
                        title:'Ayarlar',
                        href:'/settings',
                        icon:'icon-gear',
                        active:false,
                    },
                ],
                pathMatchers:[
                    'moduleUser',
                    'routeScanner',
                    'service',
                    'route',
                    'setting',
                ],
            }
        },
        mounted(){
            this.checkUrl();
        },
        methods:{
            checkUrl(){
                let path = window.location.pathname;
                for( let k = 0; k < this.pathMatchers.length; k++ ){
                    if( path.includes(this.pathMatchers[k])){
                        this.navs[k].active = true;
                        break;
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>