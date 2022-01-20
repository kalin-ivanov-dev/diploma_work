<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0  bg-gradient-to-br from-blue-400 to-indigo-600 ">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg  bg-white bg-opacity-60 backdrop-filter backdrop-blur-lg">
        {{ $slot }}
    </div>
</div>
