require('./bootstrap');
window.Vue = require('vue');

import Toastr from 'vue-toastr';
import VueSweetalert2 from 'vue-sweetalert2';

require('vue-toastr/src/vue-toastr.scss');

import VoerroTagsInput from '@voerro/vue-tagsinput';

Vue.component('tags-input', VoerroTagsInput);

Vue.use(Toastr);
Vue.use(VueSweetalert2);

Vue.component('alert-success', require('./components/alert-success.vue'));
Vue.component('alert-error', require('./components/alert-error.vue'));

Vue.component('profile', require('./components/profile.vue'));

Vue.component('setting-edit', require('./components/setting-edit.vue'));

Vue.component('new-post', require('./components/new-post.vue'));
Vue.component('add-edit-category', require('./components/add-edit-category.vue'));

Vue.component('subscribers-index', require('./components/subscribers-index.vue'));

Vue.component('newsletter', require('./components/newsletter.vue'));

Vue.component('posts-index', require('./components/posts-index.vue'));
Vue.component('categories-index', require('./components/categories-index.vue'));

const app = new Vue({
    el: '#app'
});
