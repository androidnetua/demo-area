import store from "../../store";

const toaster = {
    install(app, options){
        const api = {
            show: (toast) => {
                if (toast.timeout === undefined || !toast.timeout)
                    toast.timeout = options.timeout

                if (toast.message === undefined || !toast.message)
                    return

                store.commit('toasts/pushToast', toast)
            },

            success: (message) => {
                api.show({
                    message: message,
                    type: 'success'
                })
            },
            info: (message) => {
                api.show({
                    message: message,
                    type: 'info'
                })
            },
            warning: (message) => {
                api.show({
                    message: message,
                    type: 'warning'
                })
            },
            danger: (message) => {
                api.show({
                    message: message,
                    type: 'danger'
                })
            },
        }

        app.config.globalProperties.$toast = api
    }
}

export default toaster
