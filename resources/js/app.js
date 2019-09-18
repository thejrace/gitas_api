/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('login-form', require('./components/LoginForm.vue').default);
Vue.component('vue-table-filter-bar', require('./components/VueTableFilterBar.vue').default);

// pages
Vue.component('buses-page', require('./components/BusesPage.vue').default);
Vue.component('bus-form-page', require('./components/BusFormPage.vue').default);
Vue.component('users-page', require('./components/UsersPage.vue').default);
Vue.component('user-form-page', require('./components/UserFormPage.vue').default);
Vue.component('permission-types-page', require('./components/PermissionTypesPage.vue').default);
Vue.component('permission-type-form-page', require('./components/PermissionTypeFormPage.vue').default);
Vue.component('permissions-page', require('./components/PermissionsPage.vue').default);
Vue.component('permission-form-page', require('./components/PermissionFormPage.vue').default);

// kahya pages
Vue.component('route-scanners-page', require('./components/RouteScannersPage.vue').default);
Vue.component('route-scanner-form-page', require('./components/RouteScannerFormPage.vue').default);
Vue.component('routes-page', require('./components/RoutesPage.vue').default);
Vue.component('route-stops-page', require('./components/RouteStopsPage.vue').default);
Vue.component('route-intersections-page', require('./components/RouteIntersectionsPage.vue').default);
Vue.component('services-page', require('./components/ServicesPage.vue').default);
Vue.component('service-settings-page', require('./components/ServiceSettingsPage.vue').default);

// default
Vue.component('sub-nav-bar', require('./components/SubNavBar.vue').default);
Vue.component('kahya', require('./components/Kahya.vue').default);
Vue.component('add-user-permissions-vuetable', require('./components/AddUserPermissionsTable.vue').default);
Vue.component('user-permissions-vuetable', require('./components/UserPermissionsTable.vue').default);




Vue.mixin({
    methods: {
        vuetableTransformResponse: (data) => { // transform laravel response to vue-table format
            var transformed = {};
            transformed.pagination = {
                total: data.meta.total,
                per_page: data.meta.per_page,
                current_page: data.meta.current_page,
                last_page: data.meta.last_page,
                next_page_url: data.links.next,
                prev_page_url: data.links.prev,
                from: data.meta.from,
                to: data.meta.to
            };
            transformed.data = data.data;
            return transformed;
        }
    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});

