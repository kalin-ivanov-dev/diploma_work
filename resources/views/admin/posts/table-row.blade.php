<tr>
    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
        <div class="flex items-center">
            <div class="flex-shrink-0 w-10 h-10">

                @if($post->author()->get()->first()->profile_picture)
                    <img class="w-full h-full rounded-full object-cover"
                         src="{{asset('storage/'.$post->author()->get()->first()->profile_picture)}}"
                         alt="" />
                @else
                    <img class="w-full h-full rounded-full object-cover"
                         src="{{asset('storage/images/default_user_profile.png')}}"
                         alt="" />
                @endif

            </div>
            <div class="ml-3">
                <p class="text-gray-900 whitespace-no-wrap">
                    {{ $post->author()->get()->first()->username}}
                </p>
            </div>
        </div>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $post->title }}
        </p>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $post->created_at }}
        </p>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $post->comments()->count() }}
        </p>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<span
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                              class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
									<span class="relative">Active</span>
									</span>
    </td>
    <td>
        <div class="grid grid-cols-2  auto-cols lg:grid-cols-4 w-48">
            <a href="/admin/posts/{{$post->id}}/edit" class="text-blue-400 hover:text-gray-100 mx-2 transition ease-in-out duration-300 ">
                <i class="material-icons-outlined text-base">edit</i>
            </a>
            <a href="#" class="text-rose-400 hover:text-gray-100 mx-2  transition ease-in-out duration-300  "
               x-data="{}"
               @click.prevent="document.querySelector('#adm_delete_usr').submit()"
            >
                <i class="material-icons-round text-base">delete_outline</i>
            </a>
            @if( $post->comments()->count() > 0)
                <a href="/admin/posts/{{$post->id}}/comments" class="text-gray-400 hover:text-gray-100 transition ease-in-out duration-300 mx-2">
                    <i class="material-icons-round text-base">message_outline</i>
                </a>
            @endif
        </div>

    </td>
    <form id="adm_delete_usr" method="POST" action="/admin/posts/{{$post->id}}">
        @csrf
        @method('DELETE')
    </form>

</tr>
