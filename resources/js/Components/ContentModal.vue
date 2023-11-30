<script>
export default {
    mounted() {
        // console.log(this.$store.state.selectedEvent);
        this.selectedEvent = this.$store.state.selectedEvent
    },
    data() {
        return {
            selectedEvent: this.$store.state.selectedEvent
        }
    },
}


</script>

<template>
    <!-- <pre>{{ JSON.stringify(selectedEvent) }}</pre> -->
    <div class="mx-auto" style="width: 500px;">

        <div class="flex justify-between mb-6">
            <div>
                <p class="max-w-lg text-1xl font-semibold leading-normal text-gray-900 dark:text-white">Posted in "{{
                    selectedEvent.title }}" {{ selectedEvent.status }} </p>
            </div>

            <div>
                <template v-if="!selectedEvent.post_id">
                    <div>
                        <a :href="`/admin/events/${selectedEvent.event_id}/edit`"
                            class="px-3 py-2 mr-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit
                            Event ✏</a>
                        <a href="/admin/posts/create/"
                            class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Make
                            Post ✏</a>
                    </div>
                </template>
                <template v-if="!!selectedEvent.post_id">
                    <div>
                        <a :href="`/admin/posts/${selectedEvent.post_id}`"
                            class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Watch Post 👀</a>
                    </div>
                </template>
            </div>
        </div>



        <p class="mt-1">Schedule: {{ selectedEvent.start }}</p>
        <p class="mt-1">Customer: <a :href="`/admin/customers/${selectedEvent.customer_id}`"> {{ selectedEvent.customer }}
            </a></p>
        <p class="mt-1">Tags: [{{ selectedEvent.tags }}]</p>

    </div>
</template>