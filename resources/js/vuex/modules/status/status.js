import axios from "axios"

export default {
    state: {
        items: {
            data: [],
        },
    },
    mutations: {
        LOAD_STATUS(state, status) {
            state.items = status
        }
    },
    actions: {
        destroyStatus(context, id){
            context.commit('PRELOADER', true)
            console.log("UPDATE "+id)

            return new Promise((resolve, reject) => {
                axios.delete('/api/v1/status/'+id)
                    .then(response => resolve())
                    .catch(error => reject(error))
                    .finally(() => context.commit('PRELOADER', false))
            })
        },

        loadStatus(context,params) {
            context.commit('PRELOADER', true)
            axios
                .get("/api/v1/status", {params})
                .then((response) => {
                    console.log(response)
                    context.commit('LOAD_STATUS', response)
                })
                .catch((error) => {
                    console.log(error());
                })
                .finally(() => context.commit('PRELOADER', false))
        },

        loadItem(context, id) {
            context.commit('PRELOADER', true)

            return new Promise((resolve, reject) => {
                axios.get(`/api/v1/status/${id}` )
                    .then(response => resolve(response.data))
                    .catch(error => reject(error))
                    .finally(() => context.commit('PRELOADER', false))
            })
        },

        updateStatus(context, params){
            context.commit('PRELOADER', true)
        

            return new Promise((resolve, reject) => {
                axios.put('/api/v1/status/'+params.id, params)
                    .then(response => resolve())
                    .catch(error => reject(error))
                    .finally(() => context.commit('PRELOADER', false))
            })
        },
        

        storeStatus(context, params) {

            context.commit('PRELOADER', true)

            return new Promise((resolve, reject) => {
                axios.post('/api/v1/status', params)
                    .then(response => resolve())
                    .catch(error => reject(error))
                    .finally(() => context.commit('PRELOADER', false))
            })
        }
    },


    getters: {

    }
}
