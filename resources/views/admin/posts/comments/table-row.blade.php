<tr>
    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
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
                    {{ $comment->author()->first()->username}}
                </p>
            </div>
        </div>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $comment->created_at }}
        </p>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
        @if($comment->is_active)
            <span
                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                    <span aria-hidden
                          class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                <span class="relative">Active</span>
                </span>
        @else
            <span
                class="relative inline-block px-3 py-1 font-semibold text-white leading-tight">
                    <span aria-hidden
                          class="absolute inset-0 bg-yellow-400 rounded-full"></span>
                <span class="relative">Pending</span>
                </span>
        @endif

    </td>
    <td>
        <div class="grid grid-cols-2  auto-cols lg:grid-cols-4 w-48">
            <a href="/admin/posts/{{$comment->id}}/edit" class="text-blue-400 hover:text-gray-100 mx-2 transition ease-in-out duration-300 ">
                <i class="material-icons-outlined text-base">edit</i>
            </a>
            <a href="#" class="text-rose-400 hover:text-gray-100 mx-2  transition ease-in-out duration-300  "
               x-data="{}"
               @click.prevent="document.querySelector('#adm_delete_usr').submit()"
            >
                <i class="material-icons-round text-base">delete_outline</i>
            </a>
        </div>

    </td>
    <form id="adm_delete_usr" method="POST" action="/admin/posts/{{$comment->id}}">
        @csrf
        @method('DELETE')
    </form>

</tr>
