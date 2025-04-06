<template>
<div>
    <h3>Add People</h3>
<!-- Add content to display availablePeople and attachedPeople -->
        <div v-if="availablePeople.length">
            <h4>Available People</h4>
            <ul>
                <li v-for="person in availablePeople" :key="person.id">
                    {{ person.first_name }} {{ person.last_name }}
                    <button @click="attachPerson(person.id)">Attach</button>
                </li>
            </ul>
        </div>
        <div v-if="attachedPeople.length">
            <h4>Attached People</h4>
            <ul>
                <li v-for="person in attachedPeople" :key="person.id">
                    {{ person.first_name }} {{ person.last_name }}
                    <button @click="detachPerson(person)">Detach</button>
                </li>
            </ul>
        </div>
    </div>  
</template>
<script>
  import { defineComponent } from 'vue';
  import { useForm } from '@inertiajs/vue3';
  
  export default defineComponent({
    
    props: {
      job: {
        type: Object,
        required: true,
      },
      availablePeople: {
        type: Array,
        default: () => [], // Default to an empty array
      },
      attachedPeople: {
        type: Array,
        default: () => [], // Default to an empty array
      },
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
      attachPerson(personId) {
        this.form.person_id = personId;
        this.form.post(route('jobs.attach-person', this.job.id), {
          onSuccess: () => {
            this.form.reset();
          },
        });
      },

    
      detachPerson(person) {
        this.form.delete(route('jobs.detach-person', [this.job.id, person.id]), {
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