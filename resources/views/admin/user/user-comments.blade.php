
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($user->username.'\'s comments') }}
        </h2>
    </x-slot>

    <div class="py-12 w-2/4 m-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-back-button  href="/admin/dashboard/"/>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{--                <div class="p-6 bg-white border-b border-gray-200">--}}
                {{--                    You're logged in!--}}
                {{--                </div>--}}
                @include('admin.user.user-comments-table')
            </div>
        </div>
    </div>

</x-app-layout>
