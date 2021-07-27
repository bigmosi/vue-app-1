@props(['active'=>false])


@php

    $classes = 'block text-left px-3 text-sm leading-6 hover:bg-blue-300 focus:bg-blue-300 hover:text-white focuss:text-text'

   
   
@endphp


<a {{ $attributes (['class' => $classes ]) }}
    >{{ $slot }}</a>
