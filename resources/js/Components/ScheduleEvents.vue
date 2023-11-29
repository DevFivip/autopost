<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'

export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    return {
      calendarOptions: {
        plugins: [
          dayGridPlugin,
          timeGridPlugin,
          interactionPlugin // needed for dateClick
        ],
        headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialView: 'dayGridMonth',
        weekends: true, // initial value
        selectable: true,
        editable: true,
        events: {
          url: `/admin/events/api?user_id=${this.userId}`,
          cache: true
        },
        select: this.handleDateSelect,
        eventClick: this.handleEventClick,
        eventsSet: this.handleEvents
      }
    }
  },
  methods: {
    toggleWeekends: function () {
      this.calendarOptions.weekends = !this.calendarOptions.weekends // toggle the boolean!
    },
    handleDateSelect(selectInfo) {
      let title = prompt('Please enter a new title for your event')
    },
    handleEventClick(clickInfo) {
      if (confirm(`Are you sure you want to delete the event '${clickInfo.event.title}'`)) {
        clickInfo.event.remove()
      }
    },
    handleEvents(events) {
      this.currentEvents = events
    },
  },
  props: {
    userId: {
      type: String,
      required: true,
    },
  },
}
</script>
<template>
  <button @click="toggleWeekends">toggle weekends</button>
  <FullCalendar :options="calendarOptions">
    <template v-slot:eventContent='arg'>
      <!-- <pre>{{ JSON.stringify(arg) }}</pre> -->
      <!-- <b>{{ arg.timeText }}</b>
      <i>{{ arg.event.title }}</i> -->
    </template>
  </FullCalendar>
</template>