<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Customer Assing Subreddits') }}
    </x-slot:header>
    <x-slot:buttons>
        {{-- <x-tomato-admin-button :modal="true" :href="route('admin.customers.create')" type="link">
            {{ trans('tomato-admin::global.crud.create-new') }} {{ __('Customer') }}
        </x-tomato-admin-button> --}}
        <x-tomato-admin-button  :href="route('admin.customers.index')" type="link">
        {{ __('Back') }}
        </x-tomato-admin-button>
    </x-slot:buttons>

    <div class="pb-12">
        <div class="mx-auto">
            <x-splade-form :default="['name' => 'Laravel Splade']">
                <input v-model="form.name" />
                <x-splade-group name="subreddit" label="Pick one or more interests">
                    <x-splade-checkbox name="subreddit[]" :show-errors="false" value="laravel" label="Laravel" />
                    <x-splade-checkbox name="subreddit[]" :show-errors="false" value="tailwindcss" label="Tailwind" />
                </x-splade-group>
            </x-splade-form>
            {{-- <x-splade-group name="tags" label="Pick one or more interests">
                <x-splade-checkbox name="tags[]" :show-errors="false" value="laravel" label="Laravel" />
                <x-splade-checkbox name="tags[]" :show-errors="false" value="tailwindcss" label="Tailwind" />
            </x-splade-group> --}}
            {{-- <x-splade-table :for="$table" striped>
                <x-splade-cell email>
                    <x-tomato-admin-row table type="email" :value="$item->email" />
                </x-splade-cell>
                <x-splade-cell telegram_channel>
                    <x-tomato-admin-row table type="tel" :value="$item->telegram_channel" />
                </x-splade-cell>
                <x-splade-cell status>
                    <x-tomato-admin-row table type="bool" :value="$item->status" />
                </x-splade-cell>
                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <x-tomato-admin-button success type="icon"
                            title="{{ trans('tomato-admin::global.crud.view') }}" modal :href="route('admin.customers.assingsubreddit', $item->id)">
                            <x-heroicon-s-eye class="h-6 w-6" />
                        </x-tomato-admin-button>
                        <x-tomato-admin-button success type="icon"
                            title="{{ trans('tomato-admin::global.crud.view') }}" modal :href="route('admin.customers.show', $item->id)">
                            <x-heroicon-s-eye class="h-6 w-6" />
                        </x-tomato-admin-button>
                        <x-tomato-admin-button warning type="icon"
                            title="{{ trans('tomato-admin::global.crud.edit') }}" modal :href="route('admin.customers.edit', $item->id)">
                            <x-heroicon-s-pencil class="h-6 w-6" />
                        </x-tomato-admin-button>
                        <x-tomato-admin-button danger type="icon"
                            title="{{ trans('tomato-admin::global.crud.delete') }}" :href="route('admin.customers.destroy', $item->id)"
                            confirm="{{ trans('tomato-admin::global.crud.delete-confirm') }}"
                            confirm-text="{{ trans('tomato-admin::global.crud.delete-confirm-text') }}"
                            confirm-button="{{ trans('tomato-admin::global.crud.delete-confirm-button') }}"
                            cancel-button="{{ trans('tomato-admin::global.crud.delete-confirm-cancel-button') }}"
                            method="delete">
                            <x-heroicon-s-trash class="h-6 w-6" />
                        </x-tomato-admin-button>
                    </div>
                </x-splade-cell>
            </x-splade-table> --}}
        </div>
    </div>
</x-tomato-admin-layout>
