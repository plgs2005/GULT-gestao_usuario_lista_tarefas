import axios from "axios"
import { reject } from "lodash"
import { NAME_TOKEN } from "../../../config/config"

export default {
    state: {
        me: {},
        authenticated: false,
        urlBack: 'home',
    },

    mutations: {
        AUTH_USER_OK(state, user) {
            state.authenticated = true,
                state.me = user
        },
        CHANGE_URL_BACK(state, url) {
            state.urlBack = url
        },
        AUTH_USER_LOGOUT(state){
            state.me = {},
            state.authenticated=false
        }
    },
    actions: {
        login(context, params) {
            return axios.post('/api/auth', params)
                .then(response => {
                    context.commit('AUTH_USER_OK', response.data.user)
                    const token= response.data.token
                    localStorage.setItem(NAME_TOKEN, token )

                    window.axios.defaults.headers.common['Authorization']= `Bearer ${token}`;
                })
                .catch(error => console.log(error))
        },

        checkLogin(context) {
            return new Promise((resolve, reject) => {
                const token = localStorage.getItem(NAME_TOKEN)
                if (!token)
                    return reject()

                axios.get('/api/user')
                    .then(response => {
                        context.commit('AUTH_USER_OK', response.data.user)
                        resolve()
                    })
                    .catch(() => reject())
            })
        },

        logout() {
            localStorage.removeItem(NAME_TOKEN)
            context.commit('AUTH_USER_LOGOUT')
        }



    }

}
