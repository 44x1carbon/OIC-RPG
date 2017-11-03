<template>
    <div>
        <label for="name">名前</label>
        <input type="text" name="name" id="name" placeholder="(例) 山田太郎" v-model="formData.name">
        <div>
            性別
            <label for="gender-man">男</label>
            <input type="radio" name="gender" id="gender-man" value="mail" v-model="formData.gender">
            <label for="gender-woman">女</label>
            <input type="radio" name="gender" id="gender-woman" value="famail" v-model="formData.gender">
        </div>
        <label for="introduction">自己紹介</label>
        <textarea name="introduction" id="introduction" cols="30" rows="10" v-model="formData.introduction"></textarea>
        <router-link to="/auth">戻る</router-link>
        <router-link to="/school" @click.native="dispatch">次へ</router-link>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                formData: {
                    name: '',
                    gender: '',
                    introduction: ''
                },
            }
        },
        methods: {
            dispatch() {
                this.$store.dispatch('setProfileInfo', this.formData);
            }
        }
    }
</script>