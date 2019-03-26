// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import './config/rem'
import Http from './config/http';
import './style/commom/commom.scss'
import vuePicturePreview from 'vue-picture-preview'
Vue.use(vuePicturePreview);

Vue.config.productionTip = false

Vue.Http = Vue.prototype.$Http = Http;

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
