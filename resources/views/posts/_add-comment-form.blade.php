@auth
    <x-panel>
        <form method="POST" action="/posts/{{$post->slug}}/comments">
            @csrf
            <header class="flex items-center">
                <img src="https://i.pravatar.cc/?u={{ auth()->id() }}" alt="" width="60" height="60" class="rounded-full">
                <h2 class="ml-4">Want to participate</h2>
            </header>
            <div class="mt-6">
                                    <textarea
                                        name="body"
                                        class="border-gray-300 rounded-md w-full text-sm focus:outline-none focus:ring"
                                        rows="5"
                                        placeholder="Type your text here"
                                        required
                                    ></textarea>
                @error('body')
                <span class="text-xs text-red-500"> {{$message}} </span>
                @enderror
            </div>
            <div class="flex justify-end mt-6 pt-6 border-t border-gray-200 pt-2">
                <x-buttons.submit-button>Post comment</x-buttons.submit-button>
            </div>
        </form>
    </x-panel>
@else
    <p>
        <x-buttons.submit-button class="mr-1">
            <a  href="/register" class="font-thin text-white">Register</a>
        </x-buttons.submit-button>
        or
        <x-buttons.submit-button class="mx-2">
            <a  href="/login" class="font-thin text-white">log in </a>
        </x-buttons.submit-button>
        to leave a comment
    </p>
@endauth
