<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('CustomerSubreddit')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.customer-subreddits.store')}}" method="post" :default="['user_id'=>auth()->user()->id,'verification_status'=>1]">
        <x-splade-select :label="__('Customer')" :placeholder="__('Customer')" name="customer_id" remote-url="/admin/customers/api?user_id={{auth()->user()->id}}" remote-root="data" option-label=fullname option-value="id" choices/>
        <x-splade-select :label="__('Subreddit')" :placeholder="__('Subreddit')" name="subreddit_id" remote-url="/admin/subreddits/api" remote-root="data" option-label=name option-value="id" choices />
        
        <x-splade-select :label="__('Verification Status')" name="verification_status" placeholder="Verification Status" choices>
            <option value="1">Unkown</option>
            <option value="2">Banned</option>
            <option value="3">Pending</option>
            <option value="4">Verified</option>
        </x-splade-select>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.customer-subreddits.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
