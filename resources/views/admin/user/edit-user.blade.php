<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             Edit user : {{ __($user->username)  }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="w-full md:w-6/12 mx-auto sm:px-6 lg:px-8 ">
            <x-back-button  href="/admin/dashboard" />
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                {{--                <div class="p-6 bg-white border-b border-gray-200">--}}
                {{--                    You're logged in!--}}
                {{--                </div>--}}

                <section>
                    @if($user->profile_picture)
                        <div class="flex flex-row flex-wrap bg-white  bg-opacity-60 backdrop-filter backdrop-blur-lg p-5 rounded-md shadow-lg">
                            <p class="px-2 mb-5  basis-full">Uploaded Profile Image</p>
                            <div  class=" bg-white w-full md:w-full justify-center items-center  mt-5  mx-2">
                                <img src="{{asset('storage/'.$user->profile_picture)}}"
                                     alt="img" title="img" class="rounded-md h-full w-full object-cover flex-1 " >
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="/admin/user/{{$user->id}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <x-form.input name="username" :value="$user->username"/>
                        <x-form.input name="email" :value="$user->email" />
                        <div class="form-check p-2">
                            <input name="is_admin" id="is_admin" class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="1"  checked>
                            <label class="form-check-label inline-block text-gray-800" for="is_admin">
                                Is user admin
                            </label>
                        </div>


                        @error('profile_picture')
                        <p class="text-red-500 text-xs mt-2"> {{ $message }}</p>
                        @enderror
                        <div class="flex justify-center mt-8 p-2 mb-4">
                            <div class="w-full rounded-lg shadow-md bg-gray-50">
                                <div class="m-4">
                                    <label class="inline-block mb-2 text-gray-500">Upload Profile Picture</label>
                                    <div class="flex items-center justify-center w-full">
                                        <label
                                            class="flex flex-col w-full h-32 border-4 border-blue-200 border-dashed hover:bg-gray-100 hover:border-gray-300">
                                            <div class="flex flex-col items-center justify-center pt-7">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400 group-hover:text-gray-600"
                                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                                    Attach files</p>
                                            </div>
                                            <input type="file" name="profile_picture" id="profile_picture" class="opacity-0"  />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <x-buttons.submit-button>Publish</x-buttons.submit-button>
                    </form>
                </section>


            </div>
        </div>
    </div>
</x-app-layout>


<script>
    const cb = document.getElementById('is_admin');

    cb.onclick = () => {
        console.log(cb.checked);
        if(cb.checked === true)
            cb.value = 1;
        else
            cb.value = 0;
    }

</script>


