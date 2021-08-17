import axios from "axios"
import actions from "./actions"
import getters from "./getters"
import mutations from "./mutations"
import state from "./state"

export default {
    state: state,
    mutations: mutations,
    actions: actions,
    getters: getters,
}
