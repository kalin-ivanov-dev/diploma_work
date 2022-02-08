<<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit comment of : ') }} <span class="text-orange-400 hover:text-gray-300 hover:p-2 ease-in-out duration-300">{{ $comment->author()->first()->username }}</span>
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <x-back-button  href="/admin/posts/{{ $comment->post_id }}/comments/"/>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="/admin/comments/{{$comment->id}}" enctype="multipart/form-data" class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-10 h-10">
                            @if($comment->author()->first()->profile_picture)
                                <img class="w-full h-full rounded-full object-cover"
                                     src="{{asset('storage/'.$comment->author()->first()->profile_picture)}}"
                                     alt="" />
                            @else
                                <img class="w-full h-full rounded-full object-cover"
                                     src="{{asset('storage/images/default_user_profile.png')}}"
                                     alt="" />
                            @endif

                        </div>
                        <div class="ml-3">
                            <p class="text-gray-900 whitespace-no-wrap">
                                Editing comment from : {{ $comment->author()->first()->username}}
                            </p>
                            <p class="text-xs text-gray-700">
                                Added on : {{ $comment->created_at }}
                            </p>
                        </div>
                    </div>
                    @csrf
                    @method('PATCH')

                    <x-form.textarea name="body" > {{old('body',$comment->body)}}</x-form.textarea>
                    <div class="form-check p-2 mb-5">
                        <input name="is_approved"
                               id="is_approved"
                               class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                               type="checkbox"
                               value="{{$comment->is_active}}"
                               @if($comment->is_active)
                               checked
                               @endif
                               >
                        <label class="form-check-label inline-block text-gray-800" for="is_approved">
                            Approve comment
                        </label>
                    </div>


                    <x-buttons.submit-button>Publish</x-buttons.submit-button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const cb = document.getElementById('is_approved');

    cb.onclick = () => {
        console.log(cb.checked);
        if(cb.checked === true)
            cb.value = 1;
        else
            cb.value = 0;
    }

</script>
