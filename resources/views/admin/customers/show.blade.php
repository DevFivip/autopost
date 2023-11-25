<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('customers')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        
          <x-tomato-admin-row :label="__('User')" :value="$model->User->name" type="text" />

          <x-tomato-admin-row :label="__('Fullname')" :value="$model->fullname" type="string" />

          <x-tomato-admin-row :label="__('Email')" :value="$model->email" type="email" />

          <x-tomato-admin-row :label="__('Reddit username')" :value="$model->reddit_username" type="string" />

          
          <x-tomato-admin-row :label="__('Reddit clientId')" :value="$model->reddit_clientId" type="string" />

          <x-tomato-admin-row :label="__('Reddit clientSecret')" :value="$model->reddit_clientSecret" type="string" />

          <x-tomato-admin-row :label="__('Imgur username')" :value="$model->imgur_username" type="string" />

          
          <x-tomato-admin-row :label="__('Imgur clientId')" :value="$model->imgur_clientId" type="string" />

          <x-tomato-admin-row :label="__('Imgur clientSecret')" :value="$model->imgur_clientSecret" type="string" />

          <x-tomato-admin-row :label="__('Telegram channel')" :value="$model->telegram_channel" type="tel" />

          <x-tomato-admin-row :label="__('Tags')" :value="$model->tags" type="string" />

          <x-tomato-admin-row :label="__('Status')" :value="$model->status" type="bool" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.customers.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.customers.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.customers.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
