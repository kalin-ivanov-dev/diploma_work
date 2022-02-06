<x-layout>
    <div class="w-3/12 m-auto h-26 mt-12">
        <a href="/user/profile" class="px-5 py-2.5 relative rounded group overflow-hidden font-medium bg-blue-50 text-blue-600 inline-block">
            <span class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-blue-600 group-hover:h-full opacity-90"></span>
            <span class="relative group-hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
            </span>
        </a>

        <form method="POST"  class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="/user/{{$user->id}}/change-password">
            @csrf
            @method('POST')
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Current Passwrod
                </label>
                <input name="current_password" autocomplete="current-password"  class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
                <x-form.error name="current_password"/>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="newPassword">
                    New Password
                </label>
                <input name="new_password" autocomplete="current-password" class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="newPassword" type="password" placeholder="******************">
                <x-form.error name="new_password"/>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="confirmPassword">
                    Confirm Password
                </label>
                <input name="new_confirm_password" autocomplete="current-password" class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="confirmPassword" type="password" placeholder="******************">
                <x-form.error name="new_confirm_password"/>
            </div>

            <x-buttons.submit-button>Submit</x-buttons.submit-button>
        </form>
    </div>

</x-layout>
