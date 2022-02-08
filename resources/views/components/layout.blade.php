<!doctype html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title> Civitatem </title>
{{--<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">--}}
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/embla.css') }}" rel="stylesheet">

<script defer src="{{asset('js/app.js')}}"></script>
<script defer src="{{asset('js/embla_carousel.js')}}"></script>

<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
{{--<script defer src="https://unpkg.com/alpinejs@3.7.1/dist/cdn.min.js"></script>--}}
{{--<script defer src="{{asset('js/map.js')}}"></script>--}}
<style>
    html{
        scroll-behavior: smooth;
    }
</style>


<body style="font-family: Open Sans, sans-serif">
 @include('layouts/front-navbar')
<section class=" py-8">
{{--    <nav class="md:flex md:justify-between md:items-center">--}}
{{--        <div>--}}
{{--            <a href="/">--}}
{{--                <img src="{{asset('storage/images/citizen-2.svg')}}" alt="Laracasts Logo" width="120" height="16">--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="mt-8 md:mt-0 flex items-center">--}}
{{--            @unless(auth()->check())--}}
{{--             <a href="/register" class="text-xs font-bold uppercase">Register</a>--}}
{{--             <a href="/login" class="ml-3 text-xs font-bold uppercase">Login</a>--}}
{{--            @else--}}
{{--                <x-dropdown>--}}
{{--                    <x-slot name="trigger">--}}
{{--                        <a class="text-xs font-bold uppercase">Welcome , {{ auth()->user()->username }}</a>--}}
{{--                    </x-slot>--}}

{{--                    @can('user')--}}
{{--                         <x-dropdown-item href="/admin/dashboard/">Dashboard</x-dropdown-item>--}}
{{--                        <x-dropdown-item href="/user/posts/">All Posts</x-dropdown-item>--}}
{{--                        <x-dropdown-item href="/user/posts/create">--}}
{{--                            New Post--}}
{{--                        </x-dropdown-item>--}}
{{--                    @endcan--}}

{{--                    <x-dropdown-item href="#"--}}
{{--                                     x-data="{}"--}}
{{--                                     @click.prevent="document.querySelector('#logout-form').submit()"--}}
{{--                    >--}}
{{--                        Log out--}}
{{--                    </x-dropdown-item>--}}
{{--                    <form method="POST" id="logout-form" action="/logout" class="text-xs font-semibold text-blue-500 ml-6 hidden">--}}
{{--                        @csrf--}}
{{--                    </form>--}}
{{--                </x-dropdown>--}}


{{--            @endunless--}}

{{--            <a href="#newsletter" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">--}}
{{--                Subscribe for Updates--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </nav>--}}


    {{$slot}}


    <footer id="newsletter" class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16 mb-4">
        <img src="{{asset('storage/images/city.svg')}}" alt="" class="mx-auto -mb-6" style="width: 145px;">
        <h5 class="text-3xl mt-7">Stay in touch with the latest posts</h5>
        <p class="text-sm mt-3">Promise to keep the inbox clean. No bugs.</p>

        <div class="mt-10">
            <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

                <form method="POST" action="/newsletter" class="lg:flex text-sm">
                    @csrf
                    <div class="lg:py-3 lg:px-5 flex items-center">
                        <label for="email" class="hidden lg:inline-block">
                            <img src="{{asset('storage/images/mailbox-icon.svg')}}" alt="mailbox letter">
                        </label>

                       <div>
                           <input id="email"
                                  type="email"
                                  name="email"
                                  placeholder="Your email address"
                                  class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none border-none rounded-full"
                           >

                           @error('email')
                           <span class="text-xs text-red-500"> {{ $message }}</span>
                           @enderror
                       </div>
                    </div>

                    <button type="submit"
                            class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8"
                    >
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </footer>
</section>

<x-flashMessages.flash />
<x-flashMessages.flash-error />
</body>


