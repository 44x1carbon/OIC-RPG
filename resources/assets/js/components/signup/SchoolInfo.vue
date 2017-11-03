<template>
    <div>
        <label for="student-number">学籍番号</label>
        <input type="number" name="student_number" id="student-number" v-model="formData.studentNumber">
        <label for="academic-year">学年</label>
        <input type="number" name="academic_year" id="academic-year" v-model="formData.academicYear">
        <label for="course-id">コース</label>
        <input type="text" name="course_id" id="course-id" v-model="formData.courseId">
        <router-link to="/profile">戻る</router-link>
        <button type="submit" @click="dispatch">登録</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            formData: {
                studentNumber: 0,
                academicYear: 0,
                courseId: ''
            }
        }
    },
    methods: {
        dispatch() {
            this.$store.dispatch('setSchoolInfo', this.formData);
        }
    }
}
</script>