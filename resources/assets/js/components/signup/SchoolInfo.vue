<template>
    <div>
        <label for="student-number">学籍番号</label>
        <input type="number" id="student-number" v-model="formData.studentNumber" @change="dispatch">
        <label for="academic-year">学年</label>
        <input type="number" id="academic-year" v-model="formData.academicYear" @change="dispatch">
        <label for="course-id">コース</label>
        <input type="text" id="course-id" v-model="formData.courseId" @change="dispatch">
        <router-link to="/profile">戻る</router-link>
        <input type="hidden" name="form_data" id="form-data" :value="formData.all">
        <div @click="getSignUpFormData">sss</div>
        <button type="submit">登録</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            formData: {
                studentNumber: 0,
                academicYear: 0,
                courseId: '',
                all: ''
            },
        }
    },
    methods: {
        dispatch() {
            this.$store.dispatch('setSchoolInfo', this.formData);
        },
        getSignUpFormData() {
            this.formData.all = JSON.stringify(this.$store.getters.signUpFormData);
        }
    }
}
</script>