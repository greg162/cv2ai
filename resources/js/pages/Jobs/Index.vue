<script setup language="ts">

import { Head } from '@inertiajs/vue3'
import TextLink from '@/Components/TextLink.vue'

defineProps({ jobs: Array })

</script>
<template>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Job Listings</h1>
        <div class="mb-4">
            <TextLink 
                :href="route('jobs.create')" 
                class="ml-2 text-blue-500 hover:underline"
            >
                Create
            </TextLink>
        </div>

        <div v-if="jobs.length === 0" class="text-gray-500">
            No job listings found.
        </div>

        <div v-else class="grid gap-4">
            <div 
                v-for="job in jobs" 
                :key="job.id" 
                class="border rounded p-4 shadow-sm"
            >
                <h2 class="text-xl font-semibold">{{ job.title }}</h2>
                <p class="text-gray-600">Industry: {{ job.industry }}</p>
                <p class="mt-2">{{ job.description }}</p>
                <p class="text-sm text-gray-500">
                    Start Date: {{ new Date(job.start_date).toLocaleDateString() }}
                </p>
                
                <div class="mt-4 flex space-x-2">
                    <inertia-link 
                        :href="route('jobs.edit', job.id)" 
                        class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600"
                    >
                        Edit
                    </inertia-link>
                    <inertia-link 
                        :href="route('jobs.destroy', job.id)" 
                        method="delete" 
                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                    >
                        Delete
                    </inertia-link>
                </div>
            </div>
        </div>
    </div>
</template>