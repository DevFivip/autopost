<x-tomato-admin-container
    label="{{ trans('tomato-admin::global.crud.create') }} {{ __('Make a Monthly Post Schedule') }}">
    <x-splade-form class="flex flex-col space-y-4" action="{{ route('admin.events.monthlystore') }}" method="post"
        :default="['user_id' => auth()->user()->id, 'posts_per_day' => 2]">

        <x-splade-select :label="__('Customer')" :placeholder="__('Customer')" name="customer_id"
            remote-url="/admin/customers/api?user_id={{ auth()->user()->id }}" remote-root="data" option-label=fullname
            option-value="id" choices />

        <x-splade-select :label="__('Platform')" :placeholder="__('Platform')" remote-url="/admin/utils/get?table=platforms"
            remote-root="data" option-label=name option-value="id" choices name="platform" />

        <x-splade-input name="scheduled_period" label="Choose Date Range" placeholder="Choose Date Range" date range />
        <x-splade-input name="posts_per_day" type="number" label="Posts per day " />

        <div class="border-l-4 p-4 mt-2" role="alert">
            <p class="font-bold">⚠ Be Warned</p>
            <p>When saving, the selected month's schedule will be lost</p>
        </div>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit label="{{ __('Save') }}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.events.index')" label="{{ __('Cancel') }}" />
        </div>
    </x-splade-form>
</x-tomato-admin-container>
