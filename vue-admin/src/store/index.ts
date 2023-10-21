import { createStore } from 'vuex'
import UserModule from './UserModule'

export default createStore({
    state: {},
    getters: {},
    mutations: {},
    actions: {},
    modules: {
        User: UserModule
    }
})
