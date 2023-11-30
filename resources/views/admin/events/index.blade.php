<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Event') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button modal :href="route('admin.events.monthlyschedules')" type="link">
            {{ __('📅 Make a Post Schedule') }}
        </x-tomato-admin-button>
        <x-tomato-admin-button :href="route('admin.events.schedules')" type="link">
            {{ __('📅 Schedules') }}
        </x-tomato-admin-button>
        <x-tomato-admin-button :modal="true" :href="route('admin.events.create')" type="link">
            {{ trans('tomato-admin::global.crud.create-new') }} {{ __('Event') }}
        </x-tomato-admin-button>
    </x-slot:buttons>

    <div class="pb-12">
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell status>
                    @switch($item->status)
                        @case(0)
                            <span
                                class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Failed</span>
                        @break

                        @case(1)
                            <span
                                class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Pending</span>
                        @break

                        @case(2)
                            <span
                                class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Completed</span>
                        @break
                        <span
                            class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Error
                            Unkown</span>

                        @default
                    @endswitch

                </x-splade-cell>

                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <x-tomato-admin-button success type="icon"
                            title="{{ trans('tomato-admin::global.crud.view') }}" modal :href="route('admin.events.show', $item->id)">
                            <x-heroicon-s-eye class="h-6 w-6" />
                        </x-tomato-admin-button>
                        <x-tomato-admin-button warning type="icon"
                            title="{{ trans('tomato-admin::global.crud.edit') }}" modal :href="route('admin.events.edit', $item->id)">
                            <x-heroicon-s-pencil class="h-6 w-6" />
                        </x-tomato-admin-button>
                        <x-tomato-admin-button danger type="icon"
                            title="{{ trans('tomato-admin::global.crud.delete') }}" :href="route('admin.events.destroy', $item->id)"
                            confirm="{{ trans('tomato-admin::global.crud.delete-confirm') }}"
                            confirm-text="{{ trans('tomato-admin::global.crud.delete-confirm-text') }}"
                            confirm-button="{{ trans('tomato-admin::global.crud.delete-confirm-button') }}"
                            cancel-button="{{ trans('tomato-admin::global.crud.delete-confirm-cancel-button') }}"
                            method="delete">
                            <x-heroicon-s-trash class="h-6 w-6" />
                        </x-tomato-admin-button>
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-tomato-admin-layout>
