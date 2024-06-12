@extends('layouts.app-index')

@section('content-left')
<div id="actions">
    <h6>Account actions</h6>
    <p><i id="sidebar-icon" class="fa-solid fa-gear"></i><a href="{{route('profile.edit')}}">Settings</a></p>
    <p><i id="sidebar-icon" class="fa-solid fa-chart-line"></i><a href="{{route('admin.dashboard')}}">Dashboard</a></p>
</div>

<div id="actions">
    <h6>Photos actions</h6>
    <p id="p-edit"><i id="sidebar-icon" class="fa-solid fa-pen-to-square"></i><a
            href="{{route('admin.categories.edit' ,  $photo)}}">Edit</a></p>
    <p><i id="sidebar-icon" class="fa-solid fa-compass-drafting"></i><a href="drafts">Drafts</a></p>
    <p><i id="sidebar-icon" class="fa-solid fa-layer-group"></i><a
            href="{{route('admin.categories.index')}}">Categories</a></p>
</div>

<div id="actions">
    <h6 class="text-danger">Danger Area</h6>
    <p id="p-delete-show"><i id="sidebar-icon" class="fa-regular fa-trash-can"></i>Delete</p>
    <div id="div-js-delete-show" class="d-none">
        <x-modal :photo="$photo"></x-modal>
    </div>
</div>

@endsection

@section('content-right')

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

<script>
    let deleteShow = true;

    document.getElementById('p-delete-show').addEventListener('click', function (e) {
        console.log(e.target);
        if (deleteShow) {
            document.getElementById('div-js-delete-show').classList.remove('d-none');
            deleteShow = !deleteShow;
        }
        else {
            document.getElementById('div-js-delete-show').classList.add('d-none');
            deleteShow = !deleteShow;
        }
    });
</script>
@endsection