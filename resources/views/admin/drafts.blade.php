@extends('layouts.app')

@section('content')

<x-show-subheader>Drafts</x-show-subheader>
<div class="container">
    <div class="row">
        @forelse ($photos as $key=>$photo )
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 my-3 p-2">
            <div class="card" height="300">
                @if(Str::startsWith($photo->cover_image , 'https://'))
                <img class="card-img-top position-relative" src="{{$photo->cover_image}}" alt="{{$photo->title}}"
                    height="200">
                @else
                <img class="card-img-top position-relative" src="{{asset('storage/' . $photo->cover_image)}}"
                    alt="{{$photo->title}}" height="200">
                @endif

                <div class="card-body" style="height: 100px; overflow-y: scroll;">
                    <p><b>Title:</b> {{$photo->title}}</p>
                    <p><b>Description:</b> {{$photo->description}}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="container mt-3">
            <div class="border">
                <h1 class="text-center">No drafts were found into database</h1>
            </div>
            <p class="text-end"><a href="{{route('admin.photos.index')}}">Back</a></p>
        </div>
        @endforelse
    </div>


</div>

@endsection