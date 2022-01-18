@props(['trigger'])
<div x-data="{ show :  false}"  @click.away="show = false" class="relative">

    {{--   Trigger--}}
    <div @click="show = ! show">
        {{$trigger}}
    </div>
    {{--   Links --}}
    <div x-show="show"
         x-transition:enter="transition ease-out origin-top-left duration-200"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition origin-top-left ease-in duration-100"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-90"
         class="py-2 absolute bg-gray-100 mt w-full mt-2 rounded-xl z-50 overflow-auto max-h-52"
         style="display: none"
    >
        {{$slot}}
    </div>
</div>
