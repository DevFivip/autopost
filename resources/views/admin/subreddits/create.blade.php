<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Subreddit')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.subreddits.store')}}" method="post">
        
          <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />
          <x-splade-input :label="__('Tags')" name="tags" type="text"  :placeholder="__('Tags')" />
          <x-splade-checkbox :label="__('Verification')" name="verification" label="Verification" />
          <x-splade-checkbox :label="__('Status')" name="status" label="Status" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.subreddits.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
