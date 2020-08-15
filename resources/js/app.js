require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('favorite-component', require('./components/FavoriteJobComponent.vue').default);
Vue.component('add-review-component', require('./components/AddReviewComponent.vue').default);

export const bus = new Vue();

const app = new Vue({
    el: '#app'
});
