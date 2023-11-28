
<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Event') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button :href="route('admin.events.create')" type="link">
            {{ __('📅 Calendar') }}
        </x-tomato-admin-button>
        <x-tomato-admin-button :modal="true" :href="route('admin.events.create')" type="link">
            {{ trans('tomato-admin::global.crud.create-new') }} {{ __('Event') }}
        </x-tomato-admin-button>
    </x-slot:buttons>
    
    <div class="pb-12">
        <div class="mx-auto">
            <div id='calendar'></div>
        </div>
    </div>

   <x-splade-script>
    
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

   </x-splade-script>

</x-tomato-admin-layout>
