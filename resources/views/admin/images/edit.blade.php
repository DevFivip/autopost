<x-tomato-admin-container label="{{ trans('tomato-admin::global.crud.edit') }} {{ __('Image') }} #{{ $model->id }}">
    <x-splade-form class="flex flex-col space-y-4" action="{{ route('admin.images.update', $model->id) }}" method="post"
        :default="$model">

        <x-splade-select :label="__('Customer id')" :placeholder="__('Customer id')" name="customer_id" remote-url="/admin/customers/api"
            remote-root="data" option-label=fullname option-value="id" choices />
        {{-- <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" /> --}}
        <x-splade-input :label="__('Tags')" name="tags" type="text" :placeholder="__('Tags')" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit label="{{ __('Save') }}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.images.destroy', $model->id)"
                confirm="{{ trans('tomato-admin::global.crud.delete-confirm') }}"
                confirm-text="{{ trans('tomato-admin::global.crud.delete-confirm-text') }}"
                confirm-button="{{ trans('tomato-admin::global.crud.delete-confirm-button') }}"
                cancel-button="{{ trans('tomato-admin::global.crud.delete-confirm-cancel-button') }}" method="delete"
                label="{{ __('Delete') }}" />
            <x-tomato-admin-button secondary :href="route('admin.images.index')" label="{{ __('Cancel') }}" />
        </div>
    </x-splade-form>
</x-tomato-admin-container>
