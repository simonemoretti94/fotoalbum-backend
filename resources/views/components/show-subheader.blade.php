<div class="bg-dark bg-gradient py-2">
    <div class="container">
        <h1 {{$attributes->merge([
            'class' => 'text-white pt-1'
            ])}}
            >
            @if(isset($photo))
            {{$photo->title}}
            @else
            {{$slot}}
            @endif
        </h1>
    </div>
</div>