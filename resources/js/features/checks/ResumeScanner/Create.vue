<script setup language="ts">
import { useForm } from '@inertiajs/vue3'
import { Head } from '@inertiajs/vue3'
import { ResumeScanner } from '@/features/checks/ResumeScanner/ResumeScanner'


let props = defineProps({
    selectedChecks: Array,
    availableChecks: Array,
    person: Object,
    errors: Object
})

const form = useForm({
    resume: null,
})

const check = new ResumeScanner()


</script>
<template>

<h1 class="text-2xl font-bold mb-4">{{ check.name }}</h1>

<form @submit.prevent="submit">
    <input type="file" @input="resume.avatar = $event.target.files[0]" />
    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
      {{ form.progress.percentage }}%
    </progress>
    <button type="submit">Submit</button>
</form>

</template>