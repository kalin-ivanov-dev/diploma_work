@props(['post'])
<article
    {{ $attributes->merge(['class' => 'transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl'])}}>
    <div class="py-6 px-5">
        <div class="">

            @if($post->images->count() == 0)
                <img src="{{asset('storage/images/no-image.png')}}" alt="Blog Post illustration" class="rounded-xl h-60 w-full">
            @else

                <img src="{{asset('storage/'.$post->images->first()->image->path)}}" alt="Blog Post illustration" class="rounded-xl h-60 w-full">
            @endif
        </div>

        <div class="mt-8 flex flex-col justify-between">
            <header>
                <div class="space-x-2">
                    <x-category-button :category="$post->category"/>
                </div>

                <div class="mt-4">
                    <h1 class="text-3xl">
                        <a href="/posts/{{$post->slug}}">
                            {{ Str::limit($post->title, 10)}}
                        </a>
                    </h1>

                    <span class="mt-2 block text-gray-400 text-xs">
                         Published <time>{{$post->created_at->diffForHumans()}}</time>
                    </span>
                </div>
            </header>

            <div class="text-sm mt-4 space-y-4">
                <p>
                    {!! Str::limit($post->excerpt,30) !!}
                </p>
            </div>

            <footer class="flex justify-between items-center mt-8 flex-col">
                <div class="flex items-center text-sm">
                    @if($post->author()->get()->first()->profile_picture)
                        <img class="h-10 w-10 rounded-full object-cover" src="{{asset('storage/'.$post->author()->get()->first()->profile_picture)}}" alt="">
                    @else
                        <img class="h-10 w-10 rounded-full object-cover" src="{{asset('storage/images/default_user_profile.png')}}" alt="">
                    @endif

{{--                    <img src="{{asset('storage/images/lary-avatar.svg')}}" alt="Lary avatar" class="inline-block h-16 w-16 rounded-full ring-2 ring-white">--}}
                    <div class="ml-3">
                        <h5><a  href="/?author={{$post->author->username}}" class="font-bold">{{$post->author->name}}</a></h5>
                        <h6>Mascot at Laracasts</h6>
                    </div>
                </div>

                <div class="mt-5">
                    <a href="/posts/{{$post->slug}}"
                       class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                    >Read More</a>
                </div>
            </footer>
        </div>
    </div>
</article>
