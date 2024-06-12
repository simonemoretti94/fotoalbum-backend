@extends('layouts.app-index')

@section('content-left')
<div id="actions">
    <h6>Account actions</h6>
    <p><i id="sidebar-icon" class="fa-solid fa-gear"></i><a href="{{route('profile.edit')}}">Settings</a></p>
    <p><i id="sidebar-icon" class="fa-solid fa-chart-line"></i><a href="{{route('admin.dashboard')}}">Dashboard</a></p>
</div>

<div id="actions">
    <h6>Photos actions</h6>
    <p><i id="sidebar-icon" class="fa-solid fa-pen-to-square"></i><a
            href="{{route('admin.photos.edit' ,  $photo)}}">Edit</a></p>
    <p><i id="sidebar-icon" class="fa-regular fa-images"></i><a href="{{route('admin.photos.index')}}">Photos</a></p>
    <p><i id="sidebar-icon" class="fa-solid fa-compass-drafting"></i><a href="drafts">Drafts</a></p>
    <p><i id="sidebar-icon" class="fa-solid fa-layer-group"></i><a
            href="{{route('admin.categories.index')}}">Categories</a></p>
</div>

<div id="actions">
    <h6 class="text-danger">Danger Area</h6>
    <p id="p-delete-show"><i id="sidebar-icon" class="fa-regular fa-trash-can"></i>Delete</p>
    <div id="div-delete-js-show" class="d-none">
        <x-modal :photo="$photo"></x-modal>
    </div>
</div>

@endsection

@section('content-right')

<x-show-subheader :photo="$photo"></x-show-subheader>


<div id="container-section-right" class="container my-3">
    <div id="show-left">
        <div class="card p-2">

            @if(Str::startsWith($photo->cover_image , 'https://'))
            <img class="card-img-top" src="{{$photo->cover_image}}" alt="{{$photo->title}}">
            @else
            <img class="card-img-top" src="{{asset('storage/' . $photo->cover_image)}}" alt="{{$photo->title}}">
            @endif
        </div>
    </div>
    <div id="show-right">
        <div id="subshow-right-l">


            <p class="border-p">
                <span>
                    <b>
                        Slug:
                    </b>
                </span>
                {{$photo->slug}}
            </p>
            @if($photo->category)
            <p class="border-p">
                <span>
                    <b>
                        Category:
                    </b>
                </span>
                {{$photo->category->name}}
            </p>
            @endif

            <p class="border-p">
                <span>
                    <b>
                        Size:
                    </b>
                    {{$photo->file_size}}Kb
                </span>
                |
                <span>
                    <b>
                        Format:
                    </b>
                    {{$photo->format}}
                </span>
            </p>

            <p class="border-p">
                <span>
                    <b>
                        Created:
                    </b>
                    {{$photo->created_at}}
                </span>
                <span id="vertical-separator">|</span>
                <br id="br-break" class="d-none">
                <span>
                    <b>
                        Updated:
                    </b>
                    {{$photo->updated_at}}
                </span>
            </p>
        </div>
        <div id="subshow-right-r">
            <p class="text-center text-dark border border-1">
                {{$photo->description}}
            </p>
        </div>
    </div>
</div>
<div class="container">
    <p id="body-description" class="text-dark border border-1">
        {{$photo->description}}
    </p>

    <div class="metadata">
        @if($photo->category)
        <div style="background-color: #2c2c2c;">
            <p class="text-center text-white" style="background-color: #2c2c2c;"><b
                    class="me-2">Category:</b>{{$photo->category
                ? $photo->category->name : 'Uncategorized' }}</p>
        </div>
        <br>
        @endif
    </div>
</div>

<script>
    let deleteShow = true;

        document.getElementById('p-delete-show').addEventListener('click', function (e) {
            console.log(e.target);
            if (deleteShow) {
                document.getElementById('div-delete-js-show').classList.remove('d-none');
                deleteShow = !deleteShow;
            }
            else {
                document.getElementById('div-delete-js-show').classList.add('d-none');
                deleteShow = !deleteShow;
            }
        });

        // test br
        window.addEventListener('resize' , (e) => {

            let resizeBool = window.innerWidth < 1440 ? true : false;
            console.log(resizeBool);
            if(resizeBool){
                document.getElementById('br-break').classList.remove('d-none');
            }
            else{
                document.getElementById('br-break').classList.add('d-none');
            }
        });

</script>
@endsection