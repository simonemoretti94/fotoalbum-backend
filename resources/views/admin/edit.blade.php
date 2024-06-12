@extends('layouts.app')

@section('content')

<x-show-subheader :photo="$photo"></x-show-subheader>

<div class="container mt-2">
    @include('components.validation-error')

    <form action="{{route('admin.photos.update' , $photo)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror " name="title" id="title"
                aria-describedby="helptitle" placeholder="Write a title" value="{{$photo->title}}" required />
            <small id="helpId" class="form-text text-muted @error('title')
            d-none
        @enderror ">Write above a title</small>

            @error('title')
            <div class="alert alert-danger">
                {{$message}}
            </div>
            @enderror
        </div>

        {{-- copied cover image start --}}
        <div class="wrapper d-flex  mb-3 align-items-center">
            <div class="col-3">
                @if(Str::startsWith($photo->cover_image , 'https://'))
                <img id="section-img" class="w-100 d-block" src="{{$photo->cover_image}}" alt="{{$photo->title}}"
                    height="auto">
                @else
                <img id="section-img" class="w-100 d-block" src="{{asset('storage/' . $photo->cover_image)}}"
                    alt="{{$photo->title}}" height="auto">
                @endif
            </div>
            <div class="col-9 px-1">
                <div class="form-group">
                    <label for="cover_image"></label>
                    <input class="form-control" type="file" name="cover_image" id="cover_image">
                </div>
                @error('cover_image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- copied cover image end --}}

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" name="category_id" id="category_id">
                <option selected disabled>Select a category</option>
                @foreach ($categories as $category )
                <option value="{{$category->id}}" {{$category->id == old('category_id', $photo->category_id) ?
                    'selected'
                    : '' }}>{{$category->name}}</option>
                @endforeach

            </select>
        </div>


        <div class="mb-3">
            <label for="description" class="form-label"></label>
            <textarea class="form-control" name="description" id="description"
                rows="3">{{old('description' , $photo->description)}}</textarea>
            <small id="helpId" class="form-text text-muted @error('description')
            d-none
        @enderror ">Write above a description</small>
            @error('description')
            <div class="alert alert-danger">
                {{$message}}
            </div>
            @enderror
        </div>

        <x-wrap-button class="border rounded-1">
            <x-span-button>Edit photo {{ $photo->id }}</x-span-button>
        </x-wrap-button>



    </form>
</div>

@endsection