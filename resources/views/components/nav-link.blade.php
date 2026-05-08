@props(['active' => false])

<a  class="{{ $active ? ' text-yellow-400' : ''}}
    rounded-md px-3 py-2 text-sm font-medium hover:bg-black/4"
    aria-current="{{ $active ? 'page' : false}}" {{ $attributes }}>{{$slot}}</a>
