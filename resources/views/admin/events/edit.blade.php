<x-tomato-admin-container label="{{ trans('tomato-admin::global.crud.edit') }} {{ __('Event') }} #{{ $model->id }}">
    <x-splade-form class="flex flex-col space-y-4" action="{{ route('admin.events.update', $model->id) }}" method="post"
        :default="$model">

        <x-splade-select :label="__('Customer')" :placeholder="__('Customer')" name="customer_id" remote-url="/admin/customers/api"
            remote-root="data" option-label=fullname option-value="id" choices />
        <x-splade-select :label="__('Subreddit ')" :placeholder="__('Subreddit')" name="subreddit_id" remote-url="/admin/subreddits/api"
            remote-root="data" option-label=name option-value="id" choices />
        <x-splade-input :label="__('Post Date and Time')" :placeholder="__('Post Date and Time ')" name="posted_at" date time />

        <x-splade-select :label="__('Status')" :placeholder="__('Status')" name="status">
            <option value="0">Failed</option>
            <option value="1">Pending</option>
            <option value="2">Completed</option>
        </x-splade-select>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit label="{{ __('Save') }}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.events.destroy', $model->id)"
                confirm="{{ trans('tomato-admin::global.crud.delete-confirm') }}"
                confirm-text="{{ trans('tomato-admin::global.crud.delete-confirm-text') }}"
                confirm-button="{{ trans('tomato-admin::global.crud.delete-confirm-button') }}"
                cancel-button="{{ trans('tomato-admin::global.crud.delete-confirm-cancel-button') }}" method="delete"
                label="{{ __('Delete') }}" />
            <x-tomato-admin-button secondary :href="route('admin.events.index')" label="{{ __('Cancel') }}" />
        </div>
        
    </x-splade-form>
</x-tomato-admin-container>
