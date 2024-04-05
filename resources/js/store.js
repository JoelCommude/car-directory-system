import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';

Vue.use(Vuex)

export default new Vuex.Store({
    state:{
        UserLog:'',
        Datas:[]
    },
    actions:{},
    mutations:{
        userLog(state,payload) {
            state.UserLog=payload.value
        },
        data(state,payload) {
            state.Datas=payload.value
        },
    },
    getters:{},
    plugins:[createPersistedState()]
})