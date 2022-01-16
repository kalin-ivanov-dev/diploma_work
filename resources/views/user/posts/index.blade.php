<x-layout>
    <x-setting heading="Manage Posts">

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">

                            @include('user.posts.error')

                            @if($posts->count() == 0)
                                <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                    <p>You have no posts yet.Create your first one <a href="/user/posts/create" class="text-font-black text-sky-900 hover:text-white ease-in-out duration-300">here</a></p>
                                </div>
                            @endif

                            @foreach($posts as $post)
                                <tr >
                                    <td class="px-6 py-4 mt-5 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                   <a href="/posts/{{$post->slug}}">
                                                       {{$post->title}}
                                                   </a>

                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{$post->author->email}}
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
                                        <a href="/user/posts/{{ $post->id }}/edit" class="bg-blue-500 rounded-md  px-4 text-white p-2 hover:text-indigo-900 hover:bg-gray-200 ease-in-out duration-300">Edit</a>
                                    </td>
                                    <td class="px-2 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form method="POST" action="/user/posts/{{$post->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-500 p-2 px-4 rounded-md text-sm text-white hover:text-gray-900 hover:bg-gray-200 ease-in-out duration-300">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            <!-- More people... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-setting>
    {{$posts->links()}}
    </section>
</x-layout>
