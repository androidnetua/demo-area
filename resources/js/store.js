import {createStore} from "vuex";

const store = createStore({
    state() {
        return {
            user: null,
        }
    },
    mutations: {
        setUser(state, user) {
            state.user = user
        },
    },
    actions: {
        async getAuth(context){
            await axios.get('user').then(response => {
                context.commit('setUser', response.data.data)
            })
        }
    },
})

export default store
