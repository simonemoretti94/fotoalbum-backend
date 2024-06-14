@extends('layouts.app-index')

@section('content-top')
<style>
    h6#offcanvas-trigger {
        border: solid .5px rgba(186, 184, 184, 0.625);
        padding: .3rem;
        border-radius: 5px;
    }

    h6#offcanvas-trigger:hover {
        color: white;
        background-color: #EBEBEB;
    }
</style>

<button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#modalShow" aria-controls="Id2">
    <h6 id="offcanvas-trigger">Account actions</h6>
</button>

<div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="modalShow"
    aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div id="actions">

            <h6 class="my-4">Account actions</h6>

            <p><i id="sidebar-icon" class="fa-solid fa-gear"></i><a href="{{route('profile.edit')}}">Settings</a></p>
            <p><i id="sidebar-icon" class="fa-solid fa-chart-line"></i><a
                    href="{{route('admin.dashboard')}}">Dashboard</a></p>

            <h6 class="my-4">Photos actions</h6>

            <p><i id="sidebar-icon" class="fa-solid fa-compass-drafting"></i><a
                    href="{{route('admin.drafts.index')}}">Drafts</a></p>
            <p><i id="sidebar-icon" class="fa-solid fa-layer-group"></i><a
                    href="{{route('admin.categories.index')}}">Categories</a></p>

            <p id="p-show-head-single"><i id="sidebar-icon" class="fas fa-eye fa-xs fa-fw"></i>Show</p>
            <div id="div-js-show-head.single" class="d-none">
                @foreach ($photos as $key=>$newPhoto)
                <p><a href="{{route('admin.photos.show' , $newPhoto)}}">{{$newPhoto->id}}: {{$newPhoto->title}}</a></p>
                @endforeach
            </div>

            <p id="p-edit-head-single"><i id="sidebar-icon" class="fa-solid fa-pen-to-square"></i>Edit</p>
            <div id="div-js-edit-head-single" class="d-none">
                <p>{{$photo->id}}: <a href="{{route('admin.photos.edit' , $photo)}}">{{$photo->title}}</a></p>

            </div>
        </div>
    </div>
</div>
@endsection

@section('content-left')
<div id="actions">
    <h6>Account actions</h6>
    <p><a href="{{route('profile.edit')}}"><i id="sidebar-icon" class="fa-solid fa-gear"></i>Settings</a></p>
    <p><a href="{{route('admin.dashboard')}}"><i id="sidebar-icon" class="fa-solid fa-chart-line"></i>Dashboard</a></p>
</div>

<div id="actions">
    <h6>Photos actions</h6>
    <p><a href="{{route('admin.photos.edit' ,  $photo)}}"><i id="sidebar-icon"
                class="fa-solid fa-pen-to-square"></i>Edit</a></p>
    <p><a href="{{route('admin.photos.index')}}"><i id="sidebar-icon" class="fa-regular fa-images"></i>Photos</a></p>
    <p><a href="{{route('admin.drafts.index')}}"><i id="sidebar-icon"
                class="fa-solid fa-compass-drafting"></i>Drafts</a></p>
    <p><a href="{{route('admin.categories.index')}}"><i id="sidebar-icon"
                class="fa-solid fa-layer-group"></i>Categories</a></p>
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

    {{-- <div class="metadata">
        @if($photo->category)
        <div style="background-color: #2c2c2c;">
            <p class="text-center text-white" style="background-color: #2c2c2c;"><b
                    class="me-2">Category:</b>{{$photo->category
                ? $photo->category->name : 'Uncategorized' }}</p>
        </div>
        <br>
        @endif
    </div> --}}
</div>

<script>
    /* show left section */
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


    /* show top section */
        let showHead = true;

    document.getElementById('p-show-head-single').addEventListener('click', function (e) {
        console.log(e.target);
        if (showHead) {
            document.getElementById('div-js-show-head.single').classList.remove('d-none');
            showHead = !showHead;
        }
        else {
            document.getElementById('div-js-show-head.single').classList.add('d-none');
            showHead = !showHead;
        }
    });

    /* edit head section */
    let editHeadSingle = true;

    document.getElementById('p-edit-head-single').addEventListener('click', function (e) {
        console.log(e.target);
        if (editHeadSingle) {
            document.getElementById('div-js-edit-head-single').classList.remove('d-none');
            editHeadSingle = !editHeadSingle;
        }
        else {
            document.getElementById('div-js-edit-head-single').classList.add('d-none');
            editHeadSingle = !editHeadSingle;
        }
    });

</script>
@endsection