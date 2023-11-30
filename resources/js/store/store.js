import { createStore } from 'vuex'
const store = createStore({
    state: {
        events: [],
        selectedEvent: {}
    },
    getters: {
        EVENTS: state => state.events
    },
    mutations: {
        ADD_EVENT: (state, event) => {
            state.events.push(event)
        },
        UPDATE_EVENT: (state, { id, title, start, end }) => {
            let index = state.events.findIndex(_event => _event.id == id)
            state.events[index].title = title;
            state.events[index].start = start;
            state.events[index].end = end;
        },
        SELECT_EVENT: (state, { id, title, start, customer, event_id, post_id, tags, color,customer_id ,status}) => {
            state.selectedEvent.id = id;
            state.selectedEvent.title = title;
            state.selectedEvent.start = start;

            state.selectedEvent.customer = customer;
            state.selectedEvent.customer_id = customer_id;
            state.selectedEvent.event_id = event_id;
            state.selectedEvent.post_id = post_id;
            state.selectedEvent.tags = tags;
            state.selectedEvent.color = color;
            state.selectedEvent.status = status;

            // state.selectedEvent.end = end;
        },
    },
    actions: {}
})

export default store;