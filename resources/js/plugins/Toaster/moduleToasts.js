const moduleToasts = {
    state() {
        return {
            toasts: [],
            toastsCount: 0,
        }
    },
    getters: {
        toasts: function(state) {
            return state.toasts.slice().reverse()
        }
    },
    mutations: {
        pushToast(state, toast){
            state.toastsCount++
            toast.id = state.toastsCount
            state.toasts.push(toast)
            setTimeout(() => {
                this.commit('toasts/hideToast', toast.id)
            }, toast.timeout)
        },
        hideToast(state, id){
            state.toasts.some((toast, index) => {
                if (id === toast.id){
                    state.toasts.splice(index, 1)
                }
            })
        },
    },
    namespaced: true,
}

export default moduleToasts
