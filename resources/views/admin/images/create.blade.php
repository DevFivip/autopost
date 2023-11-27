<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Image')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.images.store')}}" method="post">
        
          <x-splade-select :label="__('Customer id')" :placeholder="__('Customer id')" name="customer_id" remote-url="/admin/customers/api?user_id={{auth()->user()->id}}" remote-root="data" option-label=fullname option-value="id" choices/>

          {{-- <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" /> --}}

          <x-splade-file name="mediafiles[]" multiple filepond preview />

          {{-- <x-splade-input :label="__('Tags')" name="tags" type="text"  :placeholder="__('Tags')" /> --}}

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.images.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
