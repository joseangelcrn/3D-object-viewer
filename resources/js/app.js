/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Packages
 */
import VueConfirmDialog from 'vue-confirm-dialog'


Vue.use(VueConfirmDialog)


Vue.component('confirm-dialog', VueConfirmDialog.default)


/**
 *Components
 */

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('welcome', require('./components/Welcome.vue').default);
Vue.component('home', require('./components/Home.vue').default);

Vue.component('model3d-crud', require('./components/Model3DCrud.vue').default);
Vue.component('model3d-show', require('./components/Model3DShow.vue').default);
Vue.component('model3d-viewer', require('./components/Model3DViewer.vue').default);

Vue.component('gif-loading', require('./components/GifLoading.vue').default);


Vue.component('file-uploader', require('./components/FileUploader.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
