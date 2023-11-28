<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('CustomerSubreddit') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button :modal="true" :href="route('admin.customer-subreddits.create')" type="link">
            {{ trans('tomato-admin::global.crud.create-new') }} {{ __('CustomerSubreddit') }}
        </x-tomato-admin-button>
    </x-slot:buttons>

    <div class="pb-12">
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell verification_status>
                    @switch($item->verification_status)
                        @case(1)
                            <span
                                class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Unkown</span>
                        @break

                        @case(2)
                            <span
                                class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Banned</span>
                        @break

                        @case(3)
                            <span
                                class="bg-yellow-100 text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Pending</span>
                        @break

                        @case(4)
                            <span
                                class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Verified</span>
                        @break

                        @default
                    @endswitch

                </x-splade-cell>

                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <x-tomato-admin-button success type="icon"
                            title="{{ trans('tomato-admin::global.crud.view') }}" modal :href="route('admin.customer-subreddits.show', $item->id)">
                            <x-heroicon-s-eye class="h-6 w-6" />
                        </x-tomato-admin-button>
                        <x-tomato-admin-button warning type="icon"
                            title="{{ trans('tomato-admin::global.crud.edit') }}" modal :href="route('admin.customer-subreddits.edit', $item->id)">
                            <x-heroicon-s-pencil class="h-6 w-6" />
                        </x-tomato-admin-button>
                        <x-tomato-admin-button danger type="icon"
                            title="{{ trans('tomato-admin::global.crud.delete') }}" :href="route('admin.customer-subreddits.destroy', $item->id)"
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
