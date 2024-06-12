@extends('layouts.app')

@section('content')
<x-show-subheader>Create a content</x-show-subheader>

<div class="container mt-2">
    @include('components.validation-error')

    <form action="{{route('admin.photos.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror " name="title" id="title"
                aria-describedby="helptitle" placeholder="Write a title" value="{{old('title')}}" required />
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
        <div class="mb-3">
            <div class="form-group">
                <label for="cover_image"></label>
                <input class="form-control" type="file" name="cover_image" id="cover_image"
                    value="{{old('cover_image')}}">
            </div>
            @error('cover_image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- copied cover image end --}}

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" name="category_id" id="category_id">
                <option selected disabled>Select a category</option>
                @foreach ($categories as $category )
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach

            </select>
        </div>


        <div class="mb-3">
            <label for="description" class="form-label"></label>
            <textarea class="form-control" name="description" id="description"
                rows="3">{{old('description')}}</textarea>
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
            <x-span-button>Save photo</x-span-button>
        </x-wrap-button>



    </form>
</div>

@endsection