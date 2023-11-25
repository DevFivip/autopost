<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Customer')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.customers.update', $model->id)}}" method="post" :default="$model">
        
          {{-- <x-splade-select :label="__('User id')" :placeholder="__('User id')" name="user_id" remote-url="/admin/users/api" remote-root="model.data" option-label=name option-value="id" choices/> --}}
          <x-splade-input :label="__('Fullname')" name="fullname" type="text"  :placeholder="__('Fullname')" />
          <x-splade-input :label="__('Email')" name="email" type="email"  :placeholder="__('Email')" />
          <x-splade-input :label="__('Reddit username')" name="reddit_username" type="text"  :placeholder="__('Reddit username')" />
          
          <x-splade-input :label="__('Reddit clientId')" name="reddit_clientId" type="text"  :placeholder="__('Reddit clientId')" />
          <x-splade-input :label="__('Reddit clientSecret')" name="reddit_clientSecret" type="text"  :placeholder="__('Reddit clientSecret')" />
          <x-splade-input :label="__('Imgur username')" name="imgur_username" type="text"  :placeholder="__('Imgur username')" />
          
          <x-splade-input :label="__('Imgur clientId')" name="imgur_clientId" type="text"  :placeholder="__('Imgur clientId')" />
          <x-splade-input :label="__('Imgur clientSecret')" name="imgur_clientSecret" type="text"  :placeholder="__('Imgur clientSecret')" />
          <x-tomato-admin-tel :label="__('Telegram channel')" :placeholder="__('Telegram channel')" type='tel' name="telegram_channel" />
          <x-splade-input :label="__('Tags')" name="tags" type="text"  :placeholder="__('Tags')" />
          <x-splade-checkbox :label="__('Status')" name="status" label="Status" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.customers.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('admin.customers.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
