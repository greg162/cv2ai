<script setup language="ts">

import { Head } from '@inertiajs/vue3'
import TextLink from '@/Components/TextLink.vue'

defineProps({ people: Array })

</script>
<template>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">People</h1>
        <div class="mb-4">
            <TextLink 
                :href="route('people.create')" 
                class="ml-2 text-blue-500 hover:underline"
            >
                Create
            </TextLink>
        </div>

        <div v-if="people.length === 0" class="text-gray-500">
            No job listings found.
        </div>

        <div v-else class="grid gap-4">
            <div 
                v-for="person in people" 
                :key="person.id" 
                class="border rounded p-4 shadow-sm"
            >
                <h2 class="text-xl font-semibold">{{ person.first_name }} {{ person.last_name }}</h2>
                <p class="text-gray-600">Email: {{ person.email }}</p>
                <p class="text-gray-600">Phone {{ person.phone }}</p>

                <div class="mt-4 flex space-x-2">
                    <TextLink 
                        :href="route('people.edit', person.id)" 
                        class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600"
                    >
                        Edit
                    </TextLink>
                    <TextLink 
                        :href="route('people.destroy', person.id)" 
                        method="delete" 
                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                    >
                        Delete
                    </TextLink>
                </div>
            </div>
        </div>
    </div>
</template>