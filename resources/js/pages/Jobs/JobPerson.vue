<template>
    <app-layout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Job Details: {{ job.title }}
        </h2>
      </template>
  
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <!-- Job Details Card -->
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 bg-white border-b border-gray-200">
              <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-medium text-gray-900">{{ job.title }}</h3>
                <div>
                  <inertia-link
                    :href="route('jobs.edit', job.id)"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                  >
                    Edit Job
                  </inertia-link>
                </div>
              </div>
  
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <p class="text-sm text-gray-600">Department:</p>
                  <p class="font-medium">{{ job.department }}</p>
                </div>
                <div>
                  <p class="text-sm text-gray-600">Location:</p>
                  <p class="font-medium">{{ job.location }}</p>
                </div>
                <div class="col-span-1 md:col-span-2">
                  <p class="text-sm text-gray-600">Description:</p>
                  <p class="whitespace-pre-line">{{ job.description }}</p>
                </div>
              </div>
            </div>
          </div>
  
          <!-- Associated People Card -->
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
              <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-medium text-gray-900">Applicants</h3>
                
                <!-- Add Person Form -->
                <form @submit.prevent="attachPerson" class="flex space-x-2">
                  <select 
                    v-model="form.person_id" 
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    :class="{ 'border-red-500': form.errors.person_id }"
                  >
                    <option value="">Select a Person</option>
                    <option v-for="person in availablePeople" :key="person.id" :value="person.id">
                      {{ person.first_name }} {{ person.last_name }}
                    </option>
                  </select>
                  
                  <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-300 disabled:opacity-25 transition"
                    :disabled="form.processing"
                  >
                    Add Person
                  </button>
                </form>
              </div>
  
              <!-- Flash Message -->
              <div v-if="$page.props.flash.success" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ $page.props.flash.success }}
              </div>
  
              <!-- People Table -->
              <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Phone
                      </th>
                      <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-if="job.people.length === 0">
                      <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                        No people associated with this job yet.
                      </td>
                    </tr>
                    <tr v-for="person in job.people" :key="person.id" class="hover:bg-gray-50">
                      <td class="px-6 py-4 whitespace-nowrap">
                        <inertia-link :href="route('people.show', person.id)" class="text-indigo-600 hover:text-indigo-900">
                          {{ person.first_name }} {{ person.last_name }}
                        </inertia-link>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ person.email }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ person.phone }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button 
                          @click="confirmDetachPerson(person)"
                          class="text-red-600 hover:text-red-900"
                        >
                          Remove
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Confirmation Modal -->
      <modal :show="confirmingPersonDetach" @close="closeModal">
        <div class="p-6">
          <h2 class="text-lg font-medium text-gray-900">
            Remove Person from Job
          </h2>
  
          <p class="mt-1 text-sm text-gray-600">
            Are you sure you want to remove this person from the job? This action cannot be undone.
          </p>
  
          <div class="mt-6 flex justify-end">
            <button
              type="button"
              class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mr-3"
              @click="closeModal"
            >
              Cancel
            </button>
  
            <button
              type="button"
              class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
              @click="detachPerson"
              :disabled="form.processing"
            >
              Remove Person
            </button>
          </div>
        </div>
      </modal>
    </app-layout>
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  import AppLayout from '@/Layouts/AppLayout.vue';
  import Modal from '@/Components/Modal.vue';
  import { useForm } from '@inertiajs/vue3';
  
  export default defineComponent({
    components: {
      AppLayout,
      Modal,
    },
    
    props: {
      job: Object,
      availablePeople: Array,
    },
    
    data() {
      return {
        form: useForm({
          person_id: '',
        }),
        confirmingPersonDetach: false,
        personToDetach: null,
      };
    },
    
    methods: {
      attachPerson() {
        this.form.post(route('jobs.attach-person', this.job.id), {
          onSuccess: () => {
            this.form.reset();
          },
        });
      },
      
      confirmDetachPerson(person) {
        this.personToDetach = person;
        this.confirmingPersonDetach = true;
      },
      
      detachPerson() {
        if (!this.personToDetach) return;
        
        this.form.delete(route('jobs.detach-person', [this.job.id, this.personToDetach.id]), {
          preserveScroll: true,
          onSuccess: () => {
            this.closeModal();
          },
        });
      },
      
      closeModal() {
        this.confirmingPersonDetach = false;
        this.personToDetach = null;
      },
    },
  });
  </script>