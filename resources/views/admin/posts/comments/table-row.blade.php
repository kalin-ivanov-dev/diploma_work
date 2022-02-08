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
                 class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight hover:cursor-pointer"
                 onclick="triggerChangeStatus()"
                 id="baseStatusNode"
             >
                <span aria-hidden
                      class="absolute inset-0 bg-green-200 opacity-50 rounded-full"
                      id="statusBg"
                >
                </span>
            <span class="relative" id="statusText">Active</span>
            </span>

            <input type="hidden" id="is_approved" value="{{$comment->is_active}}" >
        @else
            <span
                class="relative inline-block px-3 py-1 font-semibold text-white leading-tight hover:cursor-pointer" onclick="triggerChangeStatus()"
                id="baseStatusNode"
            >
                    <span aria-hidden
                          class="absolute inset-0 bg-yellow-400 rounded-full"
                          id="statusBg"
                    ></span>
                 <span class="relative" id="statusText">Pending</span>
                </span>
            <input type="hidden" id="is_approved" value="{{$comment->is_active}}" >
        @endif

    </td>
    <td>
        <div class="grid grid-cols-2  auto-cols lg:grid-cols-4 w-48">
            <a href="/admin/comments/{{$comment->id}}/edit" class="text-blue-400 hover:text-gray-100 mx-2 transition ease-in-out duration-300 ">
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

<script>
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


    // Example POST method implementation:
    async function postData(url = '', data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'same-origin', // include, *same-origin, omit
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-TOKEN": token
                // 'Content-Type': 'application/x-www-form-urlencoded',
            },
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            body: JSON.stringify(data) // body data type must match "Content-Type" header
        });
        return response.json(); // parses JSON response into native JavaScript objects
    }

    function triggerChangeStatus()
    {
        let is_approved = document.getElementById('is_approved').value

        if(is_approved == 1){
            is_approved = 0;
        } else{
            is_approved = 1;
        }

        postData('/admin/dashboard', { is_approved: is_approved,id_comment : {{$comment->id}} })
            .then(data => {

                let statusText = document.getElementById('statusText');
                let statusBg = document.getElementById('statusBg');


                if(data.status == 1)
                {
                    statusBg.classList.remove('bg-yellow-400');
                    statusBg.classList.add('bg-green-200');
                    document.getElementById('baseStatusNode').classList.add('text-green-900');
                    document.getElementById('baseStatusNode').classList.remove('text-white');

                    statusText.innerHTML = 'Active';
                    let status = document.getElementById('is_approved');
                    status.value = data.status;
                }else {
                    statusBg.classList.remove('bg-green-200');
                    statusBg.classList.add('bg-yellow-400');
                    document.getElementById('baseStatusNode').classList.add('text-white');
                    document.getElementById('baseStatusNode').classList.remove('text-green-900');

                    statusText.innerHTML = 'Pending';

                    let status = document.getElementById('is_approved');
                    status.value = data.status;
                }




            });
    }


</script>
