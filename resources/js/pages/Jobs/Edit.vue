<script lang="ts">
import { defineComponent } from 'vue';
import JobPerson from '@/Pages/Jobs/JobPerson.vue';

export default defineComponent({
    components: {
        JobPerson, // Register the JobPerson component
    },
    props: {
        job: {
            type: Object as () => Record<string, any>,
            required: true,
        },
        attachedPeople: {
            type: Array as () => Array<Record<string, any>>,
            required: true,
        },
        availablePeople: {
            type: Array as () => Array<Record<string, any>>,
            required: true,
        },
    },
    data() {
        return {
            form: { ...this.job } as Record<string, any>,
        };
    },
    methods: {
        submit(): void {
            this.$inertia.put(this.route('jobs.update', this.job.id), this.form);
        },
    },
});
</script>
<template>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Job Listing</h1>
        
        <form @submit.prevent="submit" class="max-w-md">
            <div class="mb-4">
                <label class="block mb-2">Job Title</label>
                <input 
                    v-model="form.title" 
                    type="text" 
                    class="w-full border rounded p-2"
                    required
                />
            </div>

            <div class="mb-4">
                <label class="block mb-2">Industry</label>
                <input 
                    v-model="form.industry" 
                    type="text" 
                    class="w-full border rounded p-2"
                    required
                />
            </div>

            <div class="mb-4">
                <label class="block mb-2">Start Date</label>
                <input 
                    v-model="form.start_date" 
                    type="date" 
                    class="w-full border rounded p-2"
                    required
                />
            </div>

            <div class="mb-4">
                <label class="block mb-2">Job Description</label>
                <textarea 
                    v-model="form.description" 
                    class="w-full border rounded p-2"
                    rows="4"
                    required
                ></textarea>
            </div>

            <div>
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                >
                    Update Job
                </button>
            </div>
        </form>

        <JobPerson
            :job="job"
            :attached-people="attachedPeople"
            :available-people="availablePeople"
        ></JobPerson>
    </div>
</template>