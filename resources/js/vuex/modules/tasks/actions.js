

export default {

    loadTasks(context) {
        context.commit('PRELOADER', true)
        axios
            .get("/api/v1/tasks")
            .then((response) => {
                console.log(response)

                context.commit('LOAD_TASKS', response)

            })
            .catch((error) => {
                console.log(error());
            })
            .finally(() => context.commit('PRELOADER', false))
    },


    destroyTasks(context, id) {
        context.commit('PRELOADER', true)
        
        console.log("UPDATE " + id)

        return new Promise((resolve, reject) => {
            axios.delete('/api/v1/tasks/' + id)
                .then(response => resolve())
                .catch(error => reject(error))
                .finally(() => context.commit('PRELOADER', false))
        })
    },



    loadTask(context, id) {
        context.commit('PRELOADER', true)

        return new Promise((resolve, reject) => {
            axios.get(`/api/v1/tasks/${id}`)
                .then(response => {
                    resolve(response.data)
                 
                })
                .catch(error => reject(error))
                .finally(() => context.commit('PRELOADER', false))
        })
    },

    updateTasks(context, params) {
        context.commit('PRELOADER', true)


        return new Promise((resolve, reject) => {
            axios.put('/api/v1/tasks/' + params.id, params)
            console.log("UPDATE"+JSON.stringify(params))
                .then(response => resolve())
                .catch(error => reject(error))
                .finally(() => context.commit('PRELOADER', false))
        })
    },


    storeTasks(context, params) {

        context.commit('PRELOADER', true)

        return new Promise((resolve, reject) => {
            axios.post('/api/v1/tasks', params)
                .then(response => resolve())
                .catch(error => reject(error))
                .finally(() => context.commit('PRELOADER', false))
        })
    }

}


