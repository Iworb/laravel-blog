import Quasar, * as All from 'quasar-framework/dist/quasar.mat.esm.js'
import Vue from 'vue'
import VueI18n from 'vue-i18n'
import VueMoment from 'vue-moment'

import axios from './axios'

import fa from 'quasar-framework/icons/fontawesome'

Vue.use(Quasar, {
  components: All,
  directives: All,
  plugins: All,
  animations: All,
  iconSet: fa
})

Vue.use(VueI18n)
Vue.use(VueMoment)

Vue.use(axios)
