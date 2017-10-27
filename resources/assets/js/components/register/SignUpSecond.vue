<template>
    <div>
        2
        <label for="name">名前</label>
        <input type="text" name="name" id="name" placeholder="(例) 山田太郎" :value="name" @change="changeName($event.target.value)">
        <div>
            性別
            <label for="gender-man">男</label>
            <input type="radio" name="gender" id="gender-man" value="mail">
            <label for="gender-woman">女</label>
            <input type="radio" name="gender" id="gender-woman" value="famail">
        </div>
        <label for="introduction">自己紹介</label>
        <textarea name="introduction" id="introduction" cols="30" rows="10"></textarea>
    </div>
</template>

<script>
    export default {
        methods: {
          changeName(name) {
              this.$store.commit('setName', name)
          }
        },
        computed: {
            name() {
                console.log(this)
                return this.$store.state.SignUp.studentNumber
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>