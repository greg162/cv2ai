<script>

import ResumeScannerCreate from '@/features/checks/ResumeScanner/Create.vue';

export default {
    components: {
        resumeScannerCreate: ResumeScannerCreate,
    },
    props: {
        person: Object,
        errors: Object,
        availableChecks: Array,
    },
    data() {
        return {
            form: { ...this.person },
            selectedChecks: {}, // Initialize selectedChecks as an empty object
        }

    },
    methods: {
        submit() {

            this.$inertia.put(this.route('people.update', this.person.id), this.form)
        },
        chechkSelected(checkId) {
            return this.selectedChecks[checkId] || false;
        },
        attachCheck() {
            console.log(this.selectedChecks);
        },
    },
    beforeMount() {

        for (const checkKey in this.availableChecks) {
            const check = this.availableChecks[checkKey];
            console.log(check.id);
            if (typeof this.selectedChecks[check.id] == 'undefined') {
                this.selectedChecks[check.id] = false; // Direct assignment for reactivity in Vue 3
            }
        }
    },
}
</script>
<template>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Person</h1>
        
        <form @submit.prevent="submit" class="max-w-md">
            <div class="mb-4">
                <label class="block mb-2">First Name</label>
                <input 
                    v-model="form.first_name" 
                    type="text" 
                    class="w-full border rounded p-2"
                    required
                />
                <div v-if="$page.props.errors.first_name" class="text-red-500 text-sm mt-1">
                    {{ $page.props.errors.first_name }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-2">Last Name</label>
                <input 
                    v-model="form.last_name" 
                    type="text" 
                    class="w-full border rounded p-2"
                    required
                />
                <div v-if="$page.props.errors.last_name" class="text-red-500 text-sm mt-1">
                    {{ $page.props.errors.last_name }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-2">Email</label>
                <input 
                    v-model="form.email" 
                    type="email" 
                    class="w-full border rounded p-2"
                    required
                />
                <div v-if="$page.props.errors.email" class="text-red-500 text-sm mt-1">
                    {{ $page.props.errors.email }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-2">Phone</label>
                <input 
                    v-model="form.phone" 
                    type="text" 
                    class="w-full border rounded p-2"
                    required
                />
                <div v-if="$page.props.errors.phone" class="text-red-500 text-sm mt-1">
                    {{ $page.props.errors.phone }}
                </div>  
            </div>

            <div class="mb-4">
                <label class="block mb-2">Address Line 1</label>
                <input 
                    v-model="form.address_line_1" 
                    type="text" 
                    class="w-full border rounded p-2"
                    required
                />
                <div v-if="$page.props.errors.address_line_1" class="text-red-500 text-sm mt-1">
                    {{ $page.props.errors.address_line_1 }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-2">Address Line 2</label>
                <input 
                    v-model="form.address_line_2" 
                    type="text" 
                    class="w-full border rounded p-2"
                />
                <div v-if="$page.props.errors.address_line_2" class="text-red-500 text-sm mt-1">
                    {{ $page.props.errors.address_line_2 }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-2">City</label>
                <input 
                    v-model="form.city" 
                    type="text" 
                    class="w-full border rounded p-2"
                    required
                />
                <div v-if="$page.props.errors.city" class="text-red-500 text-sm mt-1">
                    {{ $page.props.errors.city }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-2">State</label>
                <input 
                    v-model="form.state" 
                    type="text" 
                    class="w-full border rounded p-2"
                    required
                />
                <div v-if="$page.props.errors.state" class="text-red-500 text-sm mt-1">
                    {{ $page.props.errors.state }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-2">Zip</label>
                <input 
                    v-model="form.zip" 
                    type="text" 
                    class="w-full border rounded p-2"
                    required
                />
                <div v-if="$page.props.errors.zip" class="text-red-500 text-sm mt-1">
                    {{ $page.props.errors.zip }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-2">Country</label>
                <input 
                    v-model="form.country" 
                    type="text" 
                    class="w-full border rounded p-2"
                    required
                />
                <div v-if="$page.props.errors.country" class="text-red-500 text-sm mt-1">
                    {{ $page.props.errors.country }}
                </div>
            </div>

            <div>
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                >
                    Update
                </button>
            </div>
        </form>
    </div>
    <div class="container" >
        <h3>Available Checks</h3>
        <ul class="list-disc pl-5">
            <li v-for="check in availableChecks" :key="check.id" class="mb-2">
                <input type="checkbox" :value="check.id" v-model="selectedChecks[check.id]" /> {{ check.name }}
            </li>
        </ul>


        <resume-scanner-create 
            v-if="selectedChecks['resume_scanner']"
            :available-checks="availableChecks"
            :selected-checks="selectedChecks"
            :person="person"
            :errors="errors"
            ></resume-scanner-create>


    </div>
</template>