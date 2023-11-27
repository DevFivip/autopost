<x-tomato-admin-container label="{{ trans('tomato-admin::global.crud.create') }} {{ __('Post') }}">

    <x-splade-form class="flex flex-col space-y-4" action="{{ route('admin.posts.store') }}" method="post"
        :default="['user_id' => auth()->user()->id, 'status' => true, 'post_type_id' => 3]">

        <div class="flex flex-wrap gap-6">
            <div class="flex items-center me-4">
                <x-splade-radio name="post_type_id" value="1" label="Post" :show-errors="true" />
            </div>
            <div class="flex items-center me-4">
                <x-splade-radio name="post_type_id" value="2" label="Link" :show-errors="true" />
            </div>
            <div class="flex items-center me-4">
                <x-splade-radio name="post_type_id" value="3" label="Imagen/Video" :show-errors="true" />
            </div>
        </div>

        <div style="max-width: 50vh">
            <x-splade-select :label="__('Customer')" :placeholder="__('Customer')" name="customer_id"
                remote-url="/admin/customers/api?user_id={{ auth()->user()->id }}" remote-root="data"
                option-label=fullname option-value="id" choices />
        </div>

        <div style="max-width: 50vh">
            <x-splade-input :label="__('Title')" name="title" type="text" :placeholder="__('Title')" class="" required />
        </div>


        <div v-if="form.post_type_id == '1'">
            <div style="max-width: 75vh">
                {{-- <x-splade-textarea  /> --}}
                <x-tomato-admin-rich :label="__('Description')" name="description" autosize id="description" name="description"
                    label="Description" required />
            </div>
        </div>

        <div v-if="form.post_type_id == '2'">
            <div style="max-width: 75vh">
                <x-splade-input :label="__('Link')" name="link" type="text" :placeholder="__('Link')" />
            </div>
        </div>






        {{-- BUSCADOR DE MEDIA FILES --}}
        {{-- 
        <p>Your name is <span v-text="form.customer_id" /></p> --}}

        <div v-if="form.post_type_id == '3'">
            <x-splade-defer url="/admin/images/api" manual method="post"
                request="{ customer_id: form.customer_id, 0:['tags','like', '%'+form.search+'%']}"
                watch-value="form.search" watch-debounce="500">

                <div style="max-width: 75vh">
                    <x-splade-input :label="__('Search Media Files')" name="_title" type="text" :placeholder="__('Search Media Files')" class=""
                        v-model="form.search" />
                </div>
                {{-- <input v-model="form.search" type="text" /> --}}

                <p v-show="processing">Loading Fetchin Images...</p>
                {{-- <button @click.prevent="reload">Load quote</button> --}}

                {{-- <p v-text="response" /> --}}

                {{-- <p v-if="response.data" v-text="response.data" /> --}}
                <div style="max-width: 120vh;" class="mt-6">
                    <div class="flex flex-wrap gap-2">
                        <div v-for="(item,index) in response" class="relative w-1/4 p-2">
                            <label class="absolute top-0 left-0 cursor-pointer">
                                <input type="radio" class="form-checkbox" :id="'img_' + index" name="mediafile[]"
                                    :value="item.id">
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

        {{-- BUSCADOR DE MEDIA FILES --}}



    </x-splade-form>

</x-tomato-admin-container>
