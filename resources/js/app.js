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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('bus-index', require('./components/BusIndex.vue').default);
Vue.component('test-form', require('./components/TestForm.vue').default);
Vue.component('bus-form', require('./components/BusForm.vue').default);
Vue.component('user-form', require('./components/UserForm.vue').default);
Vue.component('permission-form', require('./components/PermissionForm.vue').default);
Vue.component('permission-type-form', require('./components/PermissionTypeForm.vue').default);
Vue.component('login-form', require('./components/LoginForm.vue').default);
Vue.component('app-module-form', require('./components/AppModuleForm.vue').default);
Vue.component('app-module-user-form', require('./components/AppModuleUserForm.vue').default);
Vue.component('my-vuetable', require('./components/MyVuetable.vue').default);
Vue.component('buses-vuetable', require('./components/BusesTable.vue').default);
Vue.component('user-permissions-vuetable', require('./components/UserPermissionsTable.vue').default);
Vue.component('add-user-permissions-vuetable', require('./components/AddUserPermissionsTable.vue').default);
Vue.component('add-app-module-user-permissions-vuetable', require('./components/AddAppModuleUserPermissionsTable.vue').default);
Vue.component('users-vuetable', require('./components/UsersTable.vue').default);
Vue.component('permissions-vuetable', require('./components/PermissionsTable.vue').default);
Vue.component('permission-types-vuetable', require('./components/PermissionTypesTable.vue').default);
Vue.component('app-modules-vuetable', require('./components/AppModulesTable.vue').default);
Vue.component('app-module-users-vuetable', require('./components/AppModuleUsersTable.vue').default);
Vue.component('app-module-permissions-vuetable', require('./components/AppModulePermissionsTable.vue').default);
Vue.component('app-module-user-permissions-vuetable', require('./components/AppModuleUserPermissionsTable.vue').default);
Vue.component('vue-table-filter-bar', require('./components/VueTableFilterBar.vue').default);
Vue.component('permission-types-select', require('./components/PermissionTypesSelect.vue').default);

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

