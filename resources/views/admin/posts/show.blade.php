<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('posts')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        
          <x-tomato-admin-row :label="__('User')" :value="$model->User->name" type="text" />

          <x-tomato-admin-row :label="__('Customer')" :value="$model->Customer->id" type="text" />

          <x-tomato-admin-row :label="__('Subreddit')" :value="$model->Subreddit->name" type="text" />

          <x-tomato-admin-row :label="__('Telegram channel')" :value="$model->Telegram_channel->name" type="text" />

          <x-tomato-admin-row :label="__('Post type')" :value="$model->Post_type->name" type="text" />

          <x-tomato-admin-row :label="__('Title')" :value="$model->title" type="string" />

          <x-tomato-admin-row :label="__('Description')" :value="$model->description" type="string" />

          <x-tomato-admin-row :label="__('Link')" :value="$model->link" type="string" />

          <x-tomato-admin-row :label="__('Local media file')" :value="$model->local_media_file" type="string" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.posts.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.posts.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.posts.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
