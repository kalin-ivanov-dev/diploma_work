<x-layout>
    <div class="max-w-2xl mx-auto">

        <div class="px-3 py-2">

            <div class="flex flex-col gap-1 text-center">

                <div class="flex items-center justify-end">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                        </svg>
                    </a>
                </div>
                <a class="block mx-auto bg-center bg-no-repeat bg-cover w-20 h-20 rounded-full border border-gray-400 shadow-lg"
                   href="" style="background-image: url('{{asset('storage/'.$user->profile_picture)}}')">
                </a>
                <p class="font-serif font-semibold">{{$user->username}}</p>
                <span class="text-sm text-gray-400">New York, NY - Los Angeles, CA</span>
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
                <a href="/user/comments/"><button class="bg-white border border-gray-500 px-10 py-2 rounded-full shadow-lg  hover:bg-gray-300 hover:border-white ease-in-out duration-300">
                   Comments
                </button></a>
            </div>
        </div>
    </div>
</x-layout>
