<tr>
    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
        <div class="flex items-center">
            <div class="flex-shrink-0 w-10 h-10">

                @if($user->profile_picture)
                    <img class="w-full h-full rounded-full object-cover"
                         src="{{asset('storage/'.$user->profile_picture)}}"
                         alt="" />

                @else
                    <img class="w-full h-full rounded-full object-cover"
                         src="{{asset('storage/images/default_user_profile.png')}}"
                         alt="" />
                @endif

            </div>
            <div class="ml-3">
                <p class="text-gray-900 whitespace-no-wrap">
                    {{ $user->username }}
                </p>
            </div>
        </div>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
        @if($user->is_admin)
            <p class="text-white whitespace-no-wrap bg-green-400 p-1 rounded-md text-center font-bold">Admin</p>
        @else
            <a href="/admin/user/{{$user->id}}" class="text-yellow-400 hover:text-gray-100  mr-2  transition ease-in-out duration-300">
                <p class="text-white whitespace-no-wrap bg-yellow-400 p-1 rounded-md text-center font-bold ">User</p>
            </a>
        @endif

    </td>
    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $user->created_at }}
        </p>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $user->posts()->count() }}
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
        <a href="/admin/user/{{$user->id}}/posts" class="text-yellow-400 hover:text-gray-100  mr-2  transition ease-in-out duration-300">
            <i class="material-icons-outlined text-base">visibility</i>
        </a>
        <a href="/admin/user/{{$user->id}}/edit" class="text-blue-400 hover:text-gray-100 mx-2 transition ease-in-out duration-300">
            <i class="material-icons-outlined text-base">edit</i>
        </a>
        <a href="#" class="text-rose-400 hover:text-gray-100 ml-2  transition ease-in-out duration-300"
           x-data="{}"
           @click.prevent="document.querySelector('#adm_delete_usr').submit()"
        >
                <i class="material-icons-round text-base">delete_outline</i>
        </a>
    </td>
    <form id="adm_delete_usr" method="POST" action="/admin/user/{{$user->id}}">
        @csrf
        @method('DELETE')
    </form>

</tr>
