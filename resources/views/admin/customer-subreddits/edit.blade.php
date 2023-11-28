<x-tomato-admin-container
    label="{{ trans('tomato-admin::global.crud.edit') }} {{ __('CustomerSubreddit') }} #{{ $model->id }}">
    <x-splade-form class="flex flex-col space-y-4" action="{{ route('admin.customer-subreddits.update', $model->id) }}"
        method="post" :default="$model">
        <x-splade-select :label="__('Customer id')" :placeholder="__('Customer id')" name="customer_id" remote-url="/admin/customers/api"
            remote-root="data" option-label=fullname option-value="id" choices />
        <x-splade-select :label="__('Subreddit id')" :placeholder="__('Subreddit id')" name="subreddit_id" remote-url="/admin/subreddits/api"
            remote-root="data" option-label=name option-value="id" choices />

        <x-splade-select :label="__('Verification Status')" name="verification_status" placeholder="Verification Status" choices>
            <option value="1">Unkown</option>
            <option value="2">Banned</option>
            <option value="3">Pending</option>
            <option value="4">Verified</option>
        </x-splade-select>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit label="{{ __('Save') }}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.customer-subreddits.destroy', $model->id)"
                confirm="{{ trans('tomato-admin::global.crud.delete-confirm') }}"
                confirm-text="{{ trans('tomato-admin::global.crud.delete-confirm-text') }}"
                confirm-button="{{ trans('tomato-admin::global.crud.delete-confirm-button') }}"
                cancel-button="{{ trans('tomato-admin::global.crud.delete-confirm-cancel-button') }}" method="delete"
                label="{{ __('Delete') }}" />
            <x-tomato-admin-button secondary :href="route('admin.customer-subreddits.index')" label="{{ __('Cancel') }}" />
        </div>
    </x-splade-form>
</x-tomato-admin-container>
