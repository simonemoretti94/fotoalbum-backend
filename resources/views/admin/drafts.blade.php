@extends('layouts.app')

@section('content')

<x-show-subheader>Drafts</x-show-subheader>
<div class="container">
    <div class="row">
        @forelse ($photos as $key=>$photo )
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 col-xxl-3">
            <div class="card">
                @if(Str::startsWith($photo->cover_image , 'https://'))
                <img class="card-img-top" src="{{$photo->cover_image}}" alt="{{$photo->title}}">
                @else
                <img class="card-img-top" src="{{asset('storage/' . $photo->cover_image)}}" alt="{{$photo->title}}">
                @endif
                <div class="card-body">
                    <p>test</p>
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