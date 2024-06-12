@props(['center' => true])

<span {{$attributes->merge([
    'class' => 'text-white'
    ])}} >
    {{$slot}}
</span>