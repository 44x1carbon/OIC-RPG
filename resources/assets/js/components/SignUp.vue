<template>
    <div>
        <h1>ギルドメンバー登録</h1>
        <div class="panel-body">
            <router-view></router-view>
        </div>
        <router-link to="/1">SignUpFirst</router-link>
        <router-link to="/2">SignUpSecond</router-link>
        <router-link to="/3">SignUpThird</router-link>
        <button type="submit">登録</button>
    </div>
</template>

<script>
import VueRouter from 'vue-router'

import SignUpFirst from './register/SignUpFirst.vue';
import SignUpSecond from './register/SignUpSecond.vue';
import SignUpThird from './register/SignUpThird.vue';

const router = new VueRouter({
    routes: [
        {
            path: '/1',
            component: SignUpFirst
        },
        {
            path: '/2',
            component: SignUpSecond
        },
        {
            path: '/3',
            component: SignUpThird
        }
    ]
})

export default {
    router
}
</script>