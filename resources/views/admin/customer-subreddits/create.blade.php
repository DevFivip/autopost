<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('CustomerSubreddit')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.customer-subreddits.store')}}" method="post">
        <x-splade-select :label="__('Customer id')" :placeholder="__('Customer id')" name="customer_id" remote-url="/admin/customers/api" remote-root="data" option-label=fullname option-value="id" choices/>
          <x-splade-select :label="__('Subreddit id')" :placeholder="__('Subreddit id')" name="subreddit_id" remote-url="/admin/subreddits/api" remote-root="data" option-label=name option-value="id" choices/>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.customer-subreddits.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
