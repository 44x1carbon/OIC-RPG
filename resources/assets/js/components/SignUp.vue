<template>
    <div>
        <router-link to="/foo">Go to Foo</router-link>
        <router-link to="/bar">Go to Bar</router-link>
        <div class="panel-body">
            <router-view></router-view>
        </div>
        <input type="text" name="mail_address">
        <input type="password" name="password">
        <input type="text" name="name">
        <label for="">男</label><input type="radio" name="gender" value="mail">
        <label for="">女</label><input type="radio" name="gender" value="famail">
        <textarea name="introduction" id="" cols="30" rows="10"></textarea>
        <input type="text" name="academic_year">
        <input type="text" name="course_id">
        <button type="submit">送信</button>
    </div>
</template>

<script>
    import VueRouter from 'vue-router'

    const Foo = { template: '<div>foo</div>' }
    const Bar = { template: '<div>bar</div>' }

    const routes = [
        { path: '/foo', component: Foo },
        { path: '/bar', component: Bar }
    ]

    const router = new VueRouter({
        routes // `routes: routes` の短縮表記
    })

    export default {
        router
    }
</script>