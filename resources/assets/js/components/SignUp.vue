<template>
    <div>
        <h1>ギルドメンバー登録</h1>
        <div class="panel-body">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import VueRouter from 'vue-router';
import Vuex from 'vuex';

import AuthInfo from './signup/AuthInfo.vue';
import ProfileInfo from './signup/ProfileInfo.vue';
import SchoolInfo from './signup/SchoolInfo.vue';

Vue.use(VueRouter);
Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        mailAddress: '',
        password: '',
        name: '',
        gender: '',
        introduction: '',
        studentNumber: 0,
        academicYear: 0,
        courseId: ''
    },
    mutations: {
        setAuthInfo(state, formData) {
            state.mailAddress = formData.mailAddress;
            state.password = formData.password;
        },
        setProfileInfo(state, formData) {
            state.name = formData.name;
            state.gender = formData.gender;
            state.introduction = formData.introduction;
        },
        setSchoolInfo(state, formData) {
            state.studentNumber = formData.studentNumber;
            state.academicYear = formData.academicYear;
            state.courseId = formData.courseId;
        }
    },
    actions: {
        setAuthInfo(context, formData) {
            context.commit('setAuthInfo', formData);
        },
        setProfileInfo(context, formData) {
            context.commit('setProfileInfo', formData);
        },
        setSchoolInfo(context, formData) {
            context.commit('setSchoolInfo', formData);
        }
    },
    getters: {
        signUpFormData(state) {
            return state;
        }
    }
});

const router = new VueRouter({
    routes: [
        {
            path: '/auth',
            component: AuthInfo
        },
        {
            path: '/profile',
            component: ProfileInfo
        },
        {
            path: '/school',
            component: SchoolInfo
        },
        {
            path: '/',
            redirect: '/auth'
        }
    ]
});

export default {
    router,
    store
}
</script>