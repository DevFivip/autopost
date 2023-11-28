<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('events')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        
          <x-tomato-admin-row :label="__('User')" :value="$model->User->name" type="text" />

          <x-tomato-admin-row :label="__('Customer')" :value="$model->Customer->fullname" type="text" />

          <x-tomato-admin-row :label="__('Subreddit')" :value="$model->Subreddit->name" type="text" />

          <x-tomato-admin-row :label="__('Status')" :value="$model->status" type="number" />

          <x-tomato-admin-row :label="__('Posted Date and Time')" :value="$model->posted_at" type="datetime" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.events.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.events.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.events.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
