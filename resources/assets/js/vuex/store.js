import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import SignUp from './modules/SignUp'

export default new Vuex.Store({
    modules: {
        SignUp
    }
})