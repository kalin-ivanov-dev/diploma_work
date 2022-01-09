<x-layout>
    <x-setting heading="Manage Posts">

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
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
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/admin/posts/{{ $post->id }}/edit" class="text-blue-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form method="POST" action="/admin/posts/{{$post->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-sm text-red-400">Delete</button>
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
    </section>
</x-layout>
