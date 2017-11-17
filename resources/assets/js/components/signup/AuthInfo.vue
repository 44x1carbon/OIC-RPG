<template>
    <div>
        <label for="mail-address">メールアドレス</label>
        <input type="email" id="mail-address" v-model="formData.mailAddress">
        <label for="password">パスワード</label>
        <input type="password" id="password" v-model="formData.password">
        <router-link to="/profile" @click.native="dispatch">次へ</router-link>
    </div>
</template>

<script>
export default {
    data() {
        return {
            formData: {
                mailAddress: '',
                password: '',
            }
        }
    },
    methods: {
        dispatch() {
            this.$store.dispatch('setAuthInfo', this.formData);
        }
    }
}
</script>