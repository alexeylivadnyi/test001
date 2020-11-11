import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import axios from "./axios";
import "./plugins/element.js";
import "element-ui/lib/theme-chalk/reset.css";
import "element-ui/lib/theme-chalk/index.css";

Vue.config.productionTip = false;
Vue.prototype.$http = Vue.http = axios;

new Vue({
  router,
  render: h => h(App)
}).$mount("#app");
