import Vue from 'vue'
import Vuex from 'vuex'

import Tasks from './modules/tasks/tasks'
import Status from './modules/status/status'
import Preloader from './modules/preloader/preloader'
import Auth from './modules/auth/auth'


Vue.use(Vuex)


const store = new Vuex.Store({
    modules: {
        Tasks,
        Status,
        Preloader,
        Auth,
    },
})

export default store