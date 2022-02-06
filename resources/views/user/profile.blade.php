<x-layout>
    <div class="max-w-2xl mx-auto">
        <div class="px-3 py-2">
            <div class="flex flex-col gap-1 text-center">
                <div @click.away="open = false" x-data="{ open: false }" class="flex items-center justify-end mt-10">

                    <a href="#"  @click="open = !open">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                        </svg>
                    </a>
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute top-24 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48"
                    >
                        <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline  ease-in-out duration-300"
                               href="/user/{{$user->id}}/change-password">
                                Change Password
                            </a>
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline  ease-in-out duration-300"
                               href="/user/profile/{{$user->id}}/edit">
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
                <a class="block mx-auto bg-center bg-no-repeat bg-cover w-20 h-20 rounded-full border border-gray-400 shadow-lg"
                   href="" style="background-image: url('{{asset('storage/'.$user->profile_picture)}}')">
                </a>
                <p class="font-serif font-semibold">{{$user->username}}</p>
{{--                <span class="text-sm text-gray-400">New York, NY - Los Angeles, CA</span>--}}
                <span class="text-sm text-gray-400">{{$user->email}}</span>
            </div>

            <div class="flex justify-center items-center gap-2 my-3">
                <div class="font-semibold text-center mx-4">
                    <p class="text-black">{{$user->posts()->count()}}</p>
                    <span class="text-gray-400">Signals</span>
                </div>
                <div class="font-semibold text-center mx-4">
                    <p class="text-black">{{$user->comments()->count()}}</p>
                    <span class="text-gray-400">Comments</span>
                </div>
                <div class="font-semibold text-center mx-4">
                    <p class="text-black">102</p>
                    <span class="text-gray-400">Followers</span>
                </div>
            </div>


            <div class="flex justify-center gap-2 my-5">
                <a href="/user/posts/"><button class="bg-blue-500 px-10 py-2 rounded-full text-white shadow-lg hover:bg-gray-300 ease-in-out duration-300">All Signals</button></a>
                <a href="/user/profile/{{$user->id}}/edit"><button class="bg-blue-500 px-10 py-2 rounded-full text-white shadow-lg hover:bg-gray-300 ease-in-out duration-300">Edit Profile</button></a>
                <a href="/user/comments/"><button class="bg-white border border-gray-500 px-10 py-2 rounded-full shadow-lg  hover:bg-gray-300 hover:border-white ease-in-out duration-300">
                   Comments
                </button></a>
            </div>
        </div>
    </div>
    <section class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        <x-post-grid :posts="$user->posts()->get()" />
    </section>

</x-layout>
