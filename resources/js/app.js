
require('./bootstrap');

window.Vue = require('vue');


// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('post', require('./components/storePost').default);
Vue.component('follow', require('./components/follow').default);
Vue.component('send', require('./components/messages').default);
Vue.component('tofollow', require('./components/tofollow').default);

const app = new Vue({
    el: '#app',
});
