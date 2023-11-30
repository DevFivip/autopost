<script>
import FullCalendar from '@fullcalendar/vue3'
import DayGridPlugin from '@fullcalendar/daygrid'
import TimeGridPlugin from '@fullcalendar/timegrid'
import InteractionPlugin from '@fullcalendar/interaction'
import ListPlugin from '@fullcalendar/list'


// import EventModal from './EventModal.vue'
import { ModalsContainer, useModal } from 'vue-final-modal'
import ModalEvents from './ModalEvents.vue'

import ModalConfirm from './ModalConfirm.vue'
import ContentModal from './ContentModal.vue'

const { open, close } = useModal({
  component: ModalConfirm,
  attrs: {
    title: 'Schedule Post',
    onConfirm() {
      close()
    },
    onOpened() {

    },
  },
  slots: {
    default: ContentModal,
  },
})

export default {
  components: {
    FullCalendar, // make the <FullCalendar> tag available
    ModalEvents
  },
  data() {
    return {
      calendarOptions: {
        plugins: [
          DayGridPlugin,
          TimeGridPlugin,
          InteractionPlugin,
          ListPlugin
        ],
        headerToolbar: {
          left: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
          center: 'prev today next'
        },
        initialView: 'dayGridMonth',
        events: {
          url: `/admin/events/api?user_id=${this.userId}`,
          cache: true
        },
        editable: true,
        selectable: true,
        selectMirror: true,
        dayMaxEvents: true,
        weekends: true,
        select: this.handleDateSelect,
        eventClick: this.handleEventClick,
        eventsSet: this.handleEvents
      },
    }
  },
  methods: {
    handleWeekendsToggle() {
      this.calendarOptions.weekends = !this.calendarOptions.weekends // update a property
    },
    handleDateSelect(selectInfo) {
      // let title = prompt('Please enter a new title for your event')
      // let calendarApi = selectInfo.view.calendar

      // calendarApi.unselect() // clear date selection

      // if (title) {
      //   calendarApi.addEvent({
      //     id: createEventId(),
      //     title,
      //     start: selectInfo.startStr,
      //     end: selectInfo.endStr,
      //     allDay: selectInfo.allDay
      //   })
      // }
    },
    handleEventClick(clickInfo) {
      // console.log(clickInfo.event.extendedProps)
      this.$store.commit("SELECT_EVENT", {
        id: clickInfo.event.post_id,
        title: clickInfo.event.title,
        start: clickInfo.event.start,
        customer: clickInfo.event.extendedProps?.customer,
        customer_id: clickInfo.event.extendedProps?.customer_id,
        event_id: clickInfo.event.extendedProps?.event_id,
        post_id: clickInfo.event.extendedProps?.post_id,
        tags: clickInfo.event.extendedProps?.tags,
        status: clickInfo.event.extendedProps?.status,
        color: clickInfo.event?.color,
        allDay: false
      })

      console.log(this.$store)
      open()
    },
    handleEvents(events) {
      this.currentEvents = events
    },
    handleModal(event) { }
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
  <button @click="handleWeekendsToggle">toggle weekends</button>

  <ModalEvents />

  <FullCalendar :options="calendarOptions">
    <template v-slot:eventContent='arg'>
        <!-- {{ JSON.stringify(arg) }} -->
        <div>
  
          <b>{{ arg.timeText }} {{ arg.event.extendedProps.status }}</b>
          <i>{{ arg.event.title }}</i> <br>
          {{ arg.event.extendedProps.customer }}

  
        </div>
    </template>
  </FullCalendar>
  <ModalsContainer />
</template>