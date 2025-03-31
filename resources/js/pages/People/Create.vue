<script setup lang="ts">

import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const form = reactive({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    address_line_1: '',
    address_line_2: '',
    city: '',
    state: '',
    zip: '',
    country: '',
});

function submit() {
    router.post(route('people.store'), form)
}


</script>
<template>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Create a person</h1>
        
        <form @submit.prevent="submit" class="max-w-md">
            <div class="mb-4">
                <label class="block mb-2">First Name</label>
                <input 
                    v-model="form.first_name" 
                    type="text" 
                    class="w-full border rounded p-2"
                    required
                />
            </div>

            <div class="mb-4">
                <label class="block mb-2">Last Name</label>
                <input 
                    v-model="form.last_name" 
                    type="text" 
                    class="w-full border rounded p-2"
                    required
                />
            </div>

            <div class="mb-4">
                <label class="block mb-2">Email</label>
                <input 
                    v-model="form.email" 
                    type="email" 
                    class="w-full border rounded p-2"
                    required
                />
            </div>

            <div class="mb-4">
                <label class="block mb-2">Phone</label>
                <input 
                    v-model="form.phone" 
                    type="text" 
                    class="w-full border rounded p-2"
                    required
                />
            </div>

            <div class="mb-4">
                <label class="block mb-2">Address Line 1</label>
                <input 
                    v-model="form.address_line_1" 
                    type="text" 
                    class="w-full border rounded p-2"
                    required
                />
            </div>

            <div class="mb-4">
                <label class="block mb-2">Address Line 2</label>
                <input 
                    v-model="form.address_line_2" 
                    type="text" 
                    class="w-full border rounded p-2"
                />
            </div>

            <div class="mb-4">
                <label class="block mb-2">City</label>
                <input 
                    v-model="form.city" 
                    type="text" 
                    class="w-full border rounded p-2"
                    required
                />
            </div>

            <div class="mb-4">
                <label class="block mb-2">State</label>
                <input 
                    v-model="form.state" 
                    type="text" 
                    class="w-full border rounded p-2"
                    required
                />
            </div>

            <div class="mb-4">
                <label class="block mb-2">Zip</label>
                <input 
                    v-model="form.zip" 
                    type="text" 
                    class="w-full border rounded p-2"
                    required
                />
            </div>

            <div class="mb-4">
                <label class="block mb-2">Country</label>
                <input 
                    v-model="form.country" 
                    type="text" 
                    class="w-full border rounded p-2"
                    required
                />
            </div>
            <div>
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                >
                    Create Person
                </button>
            </div>
        </form>
    </div>
</template>