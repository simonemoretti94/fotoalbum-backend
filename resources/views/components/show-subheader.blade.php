<div class="bg-dark bg-gradient py-2 position-relative">
    <p class="text-white" style="position: absolute; top: 0; left: 1%;"><b>Title:</b></p>
    <div class="container">
        <h1 {{$attributes->merge([
            'class' => 'text-white pt-1'
            ])}}
            >{{$photo->title}}</h1>
    </div>
</div>