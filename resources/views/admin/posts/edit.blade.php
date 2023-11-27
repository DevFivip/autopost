<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Post')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.posts.update', $model->id)}}" method="post" :default="$model">
        
          <x-splade-select :label="__('User id')" :placeholder="__('User id')" name="user_id" remote-url="/admin/users/api" remote-root="model.data" option-label=name option-value="id" choices/>
          <x-splade-select :label="__('Customer id')" :placeholder="__('Customer id')" name="customer_id" remote-url="/admin/customers/api" remote-root="model.data" option-label=name option-value="id" choices/>
          <x-splade-select :label="__('Subreddit id')" :placeholder="__('Subreddit id')" name="subreddit_id" remote-url="/admin/subreddits/api" remote-root="model.data" option-label=name option-value="id" choices/>
          <x-splade-select :label="__('Telegram channel id')" :placeholder="__('Telegram channel id')" name="telegram_channel_id" remote-url="/admin/telegram_channels/api" remote-root="model.data" option-label=name option-value="id" choices/>
          <x-splade-select :label="__('Post type id')" :placeholder="__('Post type id')" name="post_type_id" remote-url="/admin/post_types/api" remote-root="model.data" option-label=name option-value="id" choices/>
          <x-splade-input :label="__('Title')" name="title" type="text"  :placeholder="__('Title')" />
          <x-splade-input :label="__('Description')" name="description" type="text"  :placeholder="__('Description')" />
          <x-splade-input :label="__('Link')" name="link" type="text"  :placeholder="__('Link')" />
          <x-splade-input :label="__('Local media file')" name="local_media_file" type="text"  :placeholder="__('Local media file')" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.posts.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('admin.posts.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
