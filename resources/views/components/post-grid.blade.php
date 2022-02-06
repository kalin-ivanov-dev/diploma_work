@props(['posts'])
{{--<x-post-featured-card :post="$posts[0]"/>--}}
@if($posts->count() > 0)
    <div class="lg:grid lg:grid-cols-12 mx-2">
        @foreach($posts as $post)
            <x-post-card
                :post="$post"
                class="col-span-3"
            />
        @endforeach
    </div>
@endif
