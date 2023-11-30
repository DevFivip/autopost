<x-tomato-admin-container label="{{ trans('tomato-admin::global.crud.create') }} {{ __('Post') }}">

    <x-splade-form class="" action="{{ route('admin.posts.store') }}" method="post" {{-- :default="['user_id' => auth()->user()->id, 'status' => true, 'post_type_id' => 3]"> --}}
        :default="array_merge(
            ['user_id' => auth()->user()->id, 'status' => 1, 'post_type_id' => 3, 'nsfw' => 1],
            [
                'submition_schedule' => [],
            ],
        )">

        <div class="flex justify-between">

            <div class="" style="min-width:100vh;">
                <div class="flex flex-wrap gap-6">
                    <div class="flex items-center me-4">
                        <x-splade-radio name="post_type_id" value="1" label="Post" :show-errors="true" />
                    </div>
                    <div class="flex items-center me-4">
                        <x-splade-radio name="post_type_id" value="2" label="Link" :show-errors="true" />
                    </div>
                    <div class="flex items-center me-4">
                        <x-splade-radio name="post_type_id" value="3" label="Images | Video | Gif" :show-errors="true" />
                    </div>
                </div>

                <div class="mt-6" style="max-width: 50vh">
                    <x-splade-select :label="__('Customer')" :placeholder="__('Customer')" name="customer_id"
                        remote-url="/admin/customers/api?user_id={{ auth()->user()->id }}" remote-root="data"
                        option-label=fullname option-value="id" choices required />
                </div>

                <div class="mt-3" style="max-width: 50vh">
                    <x-splade-input :label="__('Title')" name="title" type="text" :placeholder="__('Title')" class=""
                        required />
                </div>

                <div v-if="form.post_type_id == '1'">
                    <h1 class="text-2xl font-bold tracking-tight md:text-2xl filament-header-heading mt-6 mb-2">Write
                        Post</h1>
                    <div style="max-width: 75vh">
                        {{-- <x-splade-textarea  /> --}}
                        <x-tomato-admin-rich :label="__('Description')" name="description" autosize id="description"
                            name="description" label="Description" required />
                    </div>
                </div>

                <div v-if="form.post_type_id == '2'">
                    <h1 class="text-2xl font-bold tracking-tight md:text-2xl filament-header-heading mt-6 mb-2">Link
                    </h1>
                    <div style="max-width: 75vh">
                        <x-splade-input :label="__('Link')" name="link" type="text" :placeholder="__('Link')" />
                    </div>
                </div>






                {{-- BUSCADOR DE MEDIA FILES --}}
                {{-- 
                         <p>Your name is <span v-text="form.customer_id" /></p> --}}

                <div v-if="form.post_type_id == '3'">

                    <h1 class="text-2xl font-bold tracking-tight md:text-2xl filament-header-heading mt-6 mb-2">Media
                        Files</h1>

                    <x-splade-defer url="/admin/images/api" manual method="post"
                        request="{ customer_id: form.customer_id, 0:['tags','like', '%'+form.search+'%']}"
                        watch-value="form.search" watch-debounce="500">

                        <div style="max-width: 75vh">
                            <x-splade-input :label="__('Search Media Files')" name="_title" type="text" :placeholder="__('Search Media Files')"
                                class="" v-model="form.search" />
                        </div>

                        <p v-show="processing">Loading Fetchin Media Files...</p>


                        <div style="max-width: 120vh;" class="mt-6">
                            <div class="flex flex-wrap gap-2">
                                <div v-for="(item,index) in response" class="relative w-1/4 p-2">
                                    <label class="absolute top-0 left-0 cursor-pointer">
                                        <input type="radio" :id="'img_' + index" name="local_media_file[]"
                                            :value="item.id" v-model="form.local_media_file">
                                        <a target="_blank" :href="item.media[0].original_url" class="">Ver</a>
                                    </label>
                                    <label :for="'img_' + index">
                                        <img class="h-auto rounded-lg" style="max-width:15vh" :src="item.thum"
                                            alt="">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </x-splade-defer>
                </div>


            </div>

            {{-- BUSCADOR DE MEDIA FILES --}}


            <div class="" style="min-width:50vh;">
                <h1 class="text-2xl font-bold tracking-tight md:text-2xl filament-header-heading mb-2">Schedule
                    Submitions</h1>
                <div style="max-width: 75vh;" class="mt-6">
                    <x-tomato-admin-repeater name="submition_schedule" :options="['platform', 'subreddit_id','telegram_chennel_id', 'posted_at']">
                        <div class="grid gird-cols-4 gap-4">
                            <x-splade-input :label="__('Post Date and Time')" :placeholder="__('Post Date and Time ')" name="posted_at" date time
                                v-model="repeater.main[key].posted_at" />

                            <span v-if="repeater.main[key].posted_at">
                                <x-splade-select :label="__('Platform')" :placeholder="__('Platform')"
                                    remote-url="/admin/utils/get?table=platforms" remote-root="data" option-label=name
                                    option-value="id" choices v-model="repeater.main[key].platform" />
                            </span>
                            <span v-if="!repeater.main[key].posted_at">
                                <x-tomato-admin-row :label="__('Plataforms')" value="Choose Date and Time" type="text" />
                            </span>

                            <span v-if="repeater.main[key].platform == 1">
                                <x-splade-select :label="__('Subreddits')" :placeholder="__('Subreddits')"
                                    remote-url="`/admin/utils/getSubredditsAssigned?fecha=${repeater.main[key].posted_at}&customer_id=${form.customer_id}`"
                                    remote-root="data" option-label=name option-value="id" choices
                                    v-model="repeater.main[key].subreddit_id" />
                            </span>
                    
                            <span v-if="repeater.main[key].platform == 2">
                                <x-splade-select :label="__('Telegram Channels')" :placeholder="__('Telegram Channels')"
                                    remote-url="`/admin/utils/getTelegramChannelsAssigned?fecha=${repeater.main[key].posted_at}&customer_id=${form.customer_id}`"
                                    remote-root="data" option-label=name option-value="id" choices
                                    v-model="repeater.main[key].telegram_chennel_id" />
                            </span>

                            <span v-if="!repeater.main[key].platform">
                                <x-tomato-admin-row :label="__('Channel | Subreddit')" value="Choose Platform" type="text" />
                            </span>


                            {{-- <x-splade-input v-model="repeater.main[key].vat" type="number" label="{{ __('Vat') }}"
                        placeholder="{{ __('Vat') }}" /> --}}
                        </div>
                    </x-tomato-admin-repeater>
                    <div class="border-l-4 p-4 mt-2" role="alert">
                        <p class="font-bold">⚠ Be Warned</p>
                        <p>Choose Customer before to Add New Schedule</p>
                    </div>
                    <x-splade-checkbox name="nsfw" value="1" label="NSFW" />
                    <div class="flex justify-start gap-2 pt-3 mt-6">
                        <x-tomato-admin-submit label="{{ __('Save') }}" :spinner="true" />
                        <x-tomato-admin-button secondary :href="route('admin.posts.index')" label="{{ __('Cancel') }}" />
                    </div>
                </div>
            </div>
        </div>
    </x-splade-form>

</x-tomato-admin-container>
