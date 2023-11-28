<x-tomato-admin-container
    label="{{ trans('tomato-admin::global.crud.view') }} {{ __('customer-subreddits') }} #{{ $model->id }}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <x-tomato-admin-row :label="__('Customer')" :value="$model->Customer->id" type="text" />
        <x-tomato-admin-row :label="__('Subreddit')" :value="$model->Subreddit->name" type="text" />
        @switch($model->verification_status)
            @case(1)
                <x-tomato-admin-row :label="__('Verification Status')" value="Unkown" type="text" />
            @break

            @case(2)
                <x-tomato-admin-row :label="__('Verification Status')" value="Banned" type="text" />
            @break

            @case(3)
                <x-tomato-admin-row :label="__('Verification Status')" value="Pending" type="text" />
            @break

            @case(4)
                <x-tomato-admin-row :label="__('Verification Status')" value="Verified" type="text" />
            @break

            <x-tomato-admin-row :label="__('Verification Status')" value="Error Status 404" type="text" />

            @default
        @endswitch

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{ __('Edit') }}" :href="route('admin.customer-subreddits.edit', $model->id)" />
        <x-tomato-admin-button danger :href="route('admin.customer-subreddits.destroy', $model->id)"
            confirm="{{ trans('tomato-admin::global.crud.delete-confirm') }}"
            confirm-text="{{ trans('tomato-admin::global.crud.delete-confirm-text') }}"
            confirm-button="{{ trans('tomato-admin::global.crud.delete-confirm-button') }}"
            cancel-button="{{ trans('tomato-admin::global.crud.delete-confirm-cancel-button') }}" method="delete"
            label="{{ __('Delete') }}" />
        <x-tomato-admin-button secondary :href="route('admin.customer-subreddits.index')" label="{{ __('Cancel') }}" />
    </div>
</x-tomato-admin-container>
