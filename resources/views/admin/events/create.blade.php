<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Event')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.events.store')}}" method="post" :default="['user_id'=>auth()->user()->id,'status'=>1]">
        
          <x-splade-select :label="__('Customer')" :placeholder="__('Customer')" name="customer_id" remote-url="/admin/customers/api?user_id={{auth()->user()->id}}" remote-root="data" option-label=fullname option-value="id" choices/>
          <x-splade-select :label="__('Subreddit')" :placeholder="__('Subreddit ')" name="subreddit_id" remote-url="/admin/subreddits/api" remote-root="data" option-label=name option-value="id" choices/>
          <x-splade-input :label="__('Post Date and Time')" :placeholder="__('Post Date and Time ')" name="posted_at" date time />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.events.index')" label="{{__('Cancel')}}"/>
        </div>
        
    </x-splade-form>
</x-tomato-admin-container>
