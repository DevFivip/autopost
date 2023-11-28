<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('TelegramChannel')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.telegram-channels.store')}}" method="post"  :default="['user_id'=>auth()->user()->id,'status'=>true]">
        
          <x-splade-select :label="__('Customer')" :placeholder="__('Customer')" name="customer_id" remote-url="/admin/customers/api?user_id={{auth()->user()->id}}" remote-root="data" option-label=fullname option-value="id" choices/>
          <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />
          <x-splade-input :label="__('Tags')" name="tags" type="text"  :placeholder="__('Tags')" />
          <x-splade-checkbox :label="__('Status')" name="status" label="Status" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.telegram-channels.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
