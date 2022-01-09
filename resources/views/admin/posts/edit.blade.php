<x-layout>

    <x-setting :heading="'Edit Post:  '.  $post->title">

        <form method="POST" action="/admin/posts/{{$post->id}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="title" :value="$post->title" />
            <x-form.input name="slug" :value="old('slug',$post->slug)"/>

          <div class="flex mt-6">
              <div class="flex-1">
                  <x-form.input name="thumbnail" type="file"  value="old('thumbnail',$post->thumbnail)" />
              </div>
              <img src="{{asset('storage/'.$post->thumbnail)}}" alt="" class="rounded-xl ml-7" width="150">
          </div>


            <x-form.textarea name="excerpt" > {{old('excerpt',$post->excerpt)}}</x-form.textarea>
            <x-form.textarea name="body" > {{old('body',$post->body)}} </x-form.textarea>

            <x-form.field>
                <x-form.label name="category"/>
                <select name="category_id" id="category_id ">
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

            <x-buttons.submit-button>Publish</x-buttons.submit-button>
        </form>
    </x-setting>
    </section>
</x-layout>
