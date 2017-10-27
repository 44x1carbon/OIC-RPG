export default {
    state: {
        studentNumber: '山田'
    },
    mutations: {
        setName(state, name) {
            state.studentNumber = name
        }
    }
}