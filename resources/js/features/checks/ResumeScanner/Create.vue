<script setup language="ts">
import { Head } from '@inertiajs/vue3'


let props = defineProps({ selectedChecks: Array, availableChecks: Array, person: Object, errors: Object })

console.log('selectedChecks', props.selectedChecks)

</script>
<template>

<h1 class="text-2xl font-bold mb-4">File Uploader</h1>

</template>