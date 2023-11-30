<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Event') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button modal :href="route('admin.events.monthlyschedules')" type="link">
            {{ __('📅 Make a Post Schedule') }}
        </x-tomato-admin-button>
        <x-tomato-admin-button :modal="true" :href="route('admin.events.create')" type="link">
            {{ trans('tomato-admin::global.crud.create-new') }} {{ __('Event') }}
        </x-tomato-admin-button>
    </x-slot:buttons>

    <div class="pb-12">
        <div class="mx-auto">

            <ScheduleEvents :userId="{{ auth()->user()->id }}" />

        </div>
    </div>
</x-tomato-admin-layout>
