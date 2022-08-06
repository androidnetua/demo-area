import store from "../../store";

const toaster = {
    install(app, options){
        const api = {
            show: function (toast) {
                if (toast.timeout === undefined || !toast.timeout)
                    toast.timeout = options.timeout

                if (toast.message === undefined || !toast.message)
                    return

                store.commit('toasts/pushToast', toast)
            },

            success: function (message) {
                this.show({
                    message: message,
                    type: 'success'
                })
            },
            info: function (message) {
                this.show({
                    message: message,
                    type: 'info'
                })
            },
            warning: function (message) {
                this.show({
                    message: message,
                    type: 'warning'
                })
            },
            danger: function (message) {
                this.show({
                    message: message,
                    type: 'danger'
                })
            },
        }

        app.config.globalProperties.$toast = api
    }
}

export default toaster
