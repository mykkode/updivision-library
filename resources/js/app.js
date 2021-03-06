
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

Vue.component('authors-table', require('./components/AuthorsTable.vue').default);
Vue.component('authors-add', require('./components/AuthorsAdd.vue').default);
Vue.component('authors-edit', require('./components/AuthorsEdit.vue').default);

Vue.component('tags-table', require('./components/TagsTable.vue').default);
Vue.component('tags-add', require('./components/TagsAdd.vue').default);
Vue.component('tags-edit', require('./components/TagsEdit.vue').default);

Vue.component('books-table', require('./components/BooksTable.vue').default);
Vue.component('books-add', require('./components/BooksAdd.vue').default);
Vue.component('books-edit', require('./components/BooksEdit.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
