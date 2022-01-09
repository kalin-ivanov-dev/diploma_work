<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg-auto mx-auto mt-10 ">
            <x-panel>
                <h1 class="text-center font-bold text-xl">Log in</h1>
                <form method="POST" accept-charset="/login" class="mt-10">
                    @csrf

                    <x-form.input name="email" type="email" autocomplete="username"/>
                    <x-form.input name="password"  type="password" autocomplete="new-password"/>

                    <div class="mb-6">

                        <button type="submit"
                                class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
                        >
                            Log In
                        </button>
                    </div>

                    {{--                @if($errors->any())--}}
                    {{--                    <ul>--}}
                    {{--                        @foreach($errors->all() as $error)--}}
                    {{--                            <li class="text-red-500 text-xs">{{$error}}</li>--}}
                    {{--                        @endforeach--}}
                    {{--                    </ul>--}}
                    {{--                @endif--}}
                </form>
            </x-panel>

        </main>
    </section>
</x-layout>
