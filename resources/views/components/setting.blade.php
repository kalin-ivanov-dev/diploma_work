@props(['heading'])

<section class="py-8 max-w-4xl mx-auto  shadow-2xl p-5 rounded-xl">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {{$heading}}
    </h1>

    <div class="flex flex-col lg:flex-row">
        <aside class="w-48 flex-shrink-0">
            <h4 class="font-semibold mb-4">
                Links
            </h4>
            <ul class="flex flex-row space-x-4 lg:flex-col lg:space-x-0">
                <li>
                    <a href='/user/posts'
                       class="{{request()->is('user/posts') ? 'text-blue-500' : ''}}"
                    >
                        All Posts
                    </a>
                </li>
                <li>
                    <a href="/user/posts/create"
                       class="{{request()->is('user/posts/create') ? 'text-blue-500' : ''}}"
                    >
                        New Post
                    </a>
                </li>
            </ul>
        </aside>
        <main class="flex-1">
            <x-panel>
                {{$slot}}
            </x-panel>
        </main>
    </div>



</section>
