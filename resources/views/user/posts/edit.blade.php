<x-layout>

    <x-setting :heading="'Edit Post:  '.  $post->title" >

        <form method="POST" action="/user/posts/{{$post->id}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="title" :value="$post->title" />
{{--            <x-form.input name="slug" :value="old('slug',$post->slug)"/>--}}

            <div class="flex flex-row flex-wrap bg-white  bg-opacity-60 backdrop-filter backdrop-blur-lg p-5 rounded-md shadow-lg">
                <p class="px-2 mb-5  basis-full">Uploaded Images</p>
                @foreach($post->images as $post_image)
                    <div  class=" bg-white w-full md:w-40 justify-center items-center  mt-5  mx-2">
                        <img src="{{asset('storage/'.$post_image->image->path)}}"
                             alt="img" title="img" class="rounded-md h-40 w-40 object-cover flex-1 " >
                    </div>
                @endforeach
            </div>


          <div class="flex mt-6">
{{--              <img src="{{asset('storage/'.$post->thumbnail)}}" alt="" class="rounded-xl ml-7" width="150">--}}
              <div class="flex-1">
                  <x-form.file_upload/>
{{--                  <x-form.input name="images[]" type="file" multiple  value="old('thumbnail',$post->thumbnail)" />--}}
              </div>

          </div>


            <x-form.textarea name="excerpt" > {{old('excerpt',$post->excerpt)}}</x-form.textarea>
            <x-form.textarea name="body" > {{old('body',$post->body)}} </x-form.textarea>

            <x-form.field>
                <x-form.label name="category"/>
                <select name="category_id" id="category_id "  class="border-none rounded-md">
                    @foreach(\App\Models\Category::all() as $category)
                        <option
                            value="{{$category->id}}"
                            {{old('category_id',$post->category->id) == $category->id ? "selected" : ""}}
                        >
                            {{ucwords($category->name)}}
                        </option>
                    @endforeach
                </select>
                <x-form.error name="categry"/>
            </x-form.field>

            <p class="block -mb-4 upercase font-bold text-xs text-gray-700" style="">Pick a location of the signal</p>
            @if(session()->has('error.gmap'))
                <div class="text-red-500 text-s mt-6">
                    {{ session()->get('error.gmap') }}
                </div>
            @endif
            {{--  GOOGLE MAPS COORDINATES FIELDS     --}}
            <input id="longitude"
                   type="hidden"
                   name="longitude"
                   placeholder="longitude of map"
                   class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none"
                   value="{{old('longitude',$post->longitude)}}"
            >
            <input id="latitude"
                   type="hidden"
                   name="latitude"
                   placeholder="latitude of map"
                   class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none"
                   value="{{old('latitude',$post->latitude)}}"
            >

{{--            <x-googlemap.map/>--}}
            <x-buttons.default-button type="button" id="delete-markers"  class="mt-5 -mb-12 bg-red-500">Delete Markers</x-buttons.default-button>

            <x-buttons.submit-button>Publish</x-buttons.submit-button>
        </form>
    </x-setting>
</x-layout>

