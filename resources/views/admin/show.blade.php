@extends('layouts.app')

@section('content')

<x-show-subheader :photo="$photo"></x-show-subheader>


<div class="container d-flex my-3">
    <div id="show-left" class="col-6">
        <p class="text-center">
            @if(Str::startsWith($photo->cover_image , 'https://'))
            <img width="300" height="200" src="{{$photo->cover_image}}" alt="{{$photo->title}}">
            @else
            <img width="300" height="200" src="{{asset('storage/' . $photo->cover_image)}}" alt="{{$photo->title}}">
            @endif
        </p>
    </div>
    <div id="show-right" class=" col-6">
        <p class="border-p">
            <span>
                <b>
                    Slug:
                </b>
            </span>
            {{$photo->slug}}
        </p>

        <p class="border-p">
            <span>
                <b>
                    Category:
                </b>
            </span>
            {{$photo->category->name}}
        </p>

        <p class="border-p">
            <span>
                <b>
                    Size:
                </b>
            </span>
            {{$photo->file_size}}Kb
        </p>
    </div>  
</div>
<div class="container">
    <p class="text-center text-dark border border-1">
        {{$photo->description}}
    </p>

    <div class="metadata">
        @if($photo->category_id)
        <div style="background-color: #2c2c2c;">
            <p class="text-center text-white" style="background-color: #2c2c2c;"><b
            class="me-2">Category:</b>{{$photo->category
            ? $photo->category->name : 'Uncategorized' }}</p>
        </div>
        <br>
        @endif
    </div>
</div>

<style>
        .border-p {
                    width: 40%;
                    border-bottom: solid 1.5px black;
                    border-left: solid 1.5px black;
                    padding-bottom: .5rem;
                    padding-left: .2rem;
                    font-size: medium;
                    box-shadow: -1px 3px black;
                }
</style>

@endsection