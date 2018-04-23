import Vue from 'vue'
import './plugins'
/**
 * Router and Vuex
 */
import router from './router'
import store from './store'
/**
 * Master App
 */
import App from './components/App'

const app = new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App),
  beforeCreate () {
    // bindings
  }
})

export default app
