<x-layout>
    <x-setting heading="Manage Comments">

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">

                            @include('user.posts.error')

                            @if($comments->count() == 0)
                                <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                    <p>You have no comments yet</p>
                                </div>
                            @endif

                            @foreach($comments as $comment)
                                <tr >
                                    <td class="px-6 py-4 mt-5 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($user->profile_picture)
                                                    <img class="h-10 w-10 rounded-full" src="{{asset('storage/'.auth()->user()->profile_picture)}}" alt="">
                                                @else
                                                    <img class="h-10 w-10 rounded-full" src="{{asset('storage/images/default_user_profile.png')}}" alt="">
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <a href="/posts/{{ $comment->post()->get()->first()->slug}}">
                                                        {{ Str::limit($comment->post()->get()->first()->title, 20) }}
                                                    </a>
                                                    <p class="text-xs text-gray-500">
                                                        Published <time>{{$comment->created_at->diffForHumans()}}</time>
                                                    </p>
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{$comment->body }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    {{--                                    <td class="px-6 py-4 whitespace-nowrap">--}}
                                    {{--                                        <div class="text-sm text-gray-900">Regional Paradigm Technician</div>--}}
                                    {{--                                        <div class="text-sm text-gray-500">Optimization</div>--}}
                                    {{--                                    </td>--}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                  Active
                                </span>
                                    </td>
                                    {{--                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">--}}
                                    {{--                                    Admin--}}
                                    {{--                                </td>--}}
                                    <td class="px-2 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/user/comments/{{ $comment->id }}/edit" class="bg-blue-500 rounded-md  px-4 text-white p-2 hover:text-indigo-900 hover:bg-gray-200 ease-in-out duration-300">Edit</a>
                                    </td>
                                    <td class="px-2 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div x-data="{ initial: true, deleting: false }" class="text-sm flex items-center">
                                            <button
                                                x-on:click.prevent="deleting = true; initial = false"
                                                x-show="initial"
                                                x-on:deleting.window="$el.disabled = true"
                                                x-transition:enter="transition ease-out duration-150"
                                                x-transition:enter-start="opacity-0 transform scale-90"
                                                x-transition:enter-end="opacity-100 transform scale-100"
                                                class="text-white p-2 rounded bg-red-600 hover:bg-gray-200 hover:text-black  disabled:opacity-50  ease-in-out duration-300"
                                            >
                                                Delete
                                            </button>

                                            <div
                                                x-show="deleting"
                                                x-transition:enter="transition ease-out duration-150"
                                                x-transition:enter-start="opacity-0 transform scale-90"
                                                x-transition:enter-end="opacity-100 transform scale-100"
                                                x-transition:leave="transition ease-in duration-150"
                                                x-transition:leave-start="opacity-100 transform scale-100"
                                                x-transition:leave-end="opacity-0 transform scale-90"
                                                class="flex items-center space-x-3"
                                            >
                                                <span class="dark:text-black">@lang('Are you sure?')</span>
                                                <form x-on:submit="$dispatch('deleting')" method="post" action="/user/comments/{{$comment->id}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        x-on:click="$el.form.submit()"
                                                        x-on:deleting.window="$el.disabled = true"
                                                        type="submit"
                                                        class="text-white p-2 rounded bg-red-600 hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 disabled:opacity-50 ease-in-out duration-300"
                                                    >
                                                        @lang('Yes')
                                                    </button>

                                                    <button
                                                        x-on:click.prevent="deleting = false; setTimeout(() => { initial = true }, 150)"
                                                        x-on:deleting.window="$el.disabled = true"
                                                        class="text-white p-2 rounded bg-gray-600 hover:bg-gray-700 dark:bg-gray-500 dark:hover:bg-gray-600 disabled:opacity-50 ease-in-out duration-300"
                                                    >
                                                        @lang('No')
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-setting>

{{--    {{$posts->links()}}--}}
    </section>
</x-layout>


