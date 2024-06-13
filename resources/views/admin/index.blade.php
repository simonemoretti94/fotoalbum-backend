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
    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#Id2" aria-controls="Id2">
        <h6 id="offcanvas-trigger">Account actions</h6>
    </button>

    <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="Id2"
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

                <p id="p-show-head"><i id="sidebar-icon" class="fas fa-eye fa-xs fa-fw"></i>Show</p>
                <div id="div-js-show-head" class="d-none">
                    @foreach ($photos as $key=>$photo)
                    <p><a href="{{route('admin.photos.show' , $photo)}}">{{$photo->id}}: {{$photo->title}}</a></p>
                    @endforeach
                </div>

                <p id="p-edit-head"><i id="sidebar-icon" class="fa-solid fa-pen-to-square"></i>Edit</p>
                <div id="div-js-edit-head" class="d-none">
                    @foreach ($photos as $key=>$photo)
                    <p><a href="{{route('admin.photos.edit' , $photo)}}">{{$photo->id}}: {{$photo->title}}</a></p>
                    @endforeach
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
        <p><a href="{{route('admin.photos.create')}}"><i id="sidebar-icon" class="fa-solid fa-square-plus"></i>Create</a>
        </p>
        <p id="p-show"><a href="#"><i id="sidebar-icon" class="fas fa-eye fa-xs fa-fw"></i>Show</a></p>
        <div id="div-js-show" class="d-none">
            @foreach ($photos as $key=>$photo)
            <p><a href="{{route('admin.photos.show' , $photo)}}">{{$photo->id}}: {{$photo->title}}</a></p>
            @endforeach
        </div>
        <p id="p-edit"><a href="#"><i id="sidebar-icon" class="fa-solid fa-pen-to-square"></i>Edit</a></p>
        <div id="div-js-edit" class="d-none">
            @foreach ($photos as $key=>$photo)
            <p><a href="{{route('admin.photos.edit' , $photo)}}">{{$photo->id}}: {{$photo->title}}</a></p>
            @endforeach
        </div>
        <p><a href="{{route('admin.drafts.index')}}"><i id="sidebar-icon"
                    class="fa-solid fa-compass-drafting"></i>Drafts</a></p>
        <p><a href="{{route('admin.categories.index')}}"><i id="sidebar-icon"
                    class="fa-solid fa-layer-group"></i>Categories</a></p>
    </div>

    <div id="actions">
        <h6 class="text-danger">Danger Area</h6>
        <p id="p-delete"><i id="sidebar-icon" class="fa-regular fa-trash-can"></i>Delete</p>
        <div id="div-delete-js-index" class="d-none">
            @foreach ($photos as $key=>$photo)
            <x-modal :photo="$photo"></x-modal>
            @endforeach
        </div>
    </div>


    <script>
        /* show head section */
        let showHead = true;

        document.getElementById('p-show-head').addEventListener('click', function (e) {
            console.log(e.target);
            if (showHead) {
                document.getElementById('div-js-show-head').classList.remove('d-none');
                showHead = !showHead;
            }
            else {
                document.getElementById('div-js-show-head').classList.add('d-none');
                showHead = !showHead;
            }
        });

        /* show section */
        let show = true;

        document.getElementById('p-show').addEventListener('click', function (e) {
            console.log(e.target);
            if (show) {
                document.getElementById('div-js-show').classList.remove('d-none');
                show = !show;
            }
            else {
                document.getElementById('div-js-show').classList.add('d-none');
                show = !show;
            }
        });

        /* edit head section */
        let editHead = true;

        document.getElementById('p-edit-head').addEventListener('click', function (e) {
            console.log(e.target);
            if (editHead) {
                document.getElementById('div-js-edit-head').classList.remove('d-none');
                editHead = !editHead;
            }
            else {
                document.getElementById('div-js-edit-head').classList.add('d-none');
                editHead = !editHead;
            }
        });

        /* edit section */
        let edit = true;

        document.getElementById('p-edit').addEventListener('click', function (e) {
            console.log(e.target);
            if (edit) {
                document.getElementById('div-js-edit').classList.remove('d-none');
                edit = !edit;
            }
            else {
                document.getElementById('div-js-edit').classList.add('d-none');
                edit = !edit;
            }
        });


        /* delete section */
        let deletePhoto = true;

        document.getElementById('p-delete').addEventListener('click', function (e) {
            console.log(e.target);
            if (deletePhoto) {
                document.getElementById('div-delete-js-index').classList.remove('d-none');
                deletePhoto = !deletePhoto;
            }
            else {
                document.getElementById('div-delete-js-index').classList.add('d-none');
                deletePhoto = !deletePhoto;
            }
        });
    </script>
@endsection

@section('content-right')
    <div class="container">
        @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif
        <div class="table-responsive">
            <table id="table-index" class="table table-light">
                <thead>
                    <tr id="th-data">
                        <th scope="col">Id</th>
                        <th id="th-image" scope="col">Cover image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Infos</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($photos as $photo)

                    <tr id="td-data">
                        <td scope="row">
                            <p class="text-center">{{$photo->id}}</p>
                        </td>

                        <td>

                            @if(Str::startsWith($photo->cover_image , 'https://'))
                            <img src="{{$photo->cover_image}}" alt="{{$photo->title}}">
                            @else
                            <img src="{{asset('storage/' . $photo->cover_image)}}" alt="{{$photo->title}}">
                            @endif
                            <span id="publish_index"><a href="{{route('admin.drafts.unpublish' , $photo->id)}}"><i
                                        class="fa-regular fa-flag"></i>
                                    Unpublish</a></span>


                        </td>

                        <td>
                            <p>{{$photo->title}}</p>
                            <p><b>Slug:</b></p>
                            <p>{{$photo->slug}}</p>
                        </td>
                        <td>
                            <p><b>Created: </b><span>{{$photo->created_at}}</span></p>
                            <p><b>Updated: </b><span>{{$photo->updated_at}}</span></p>
                            <p><b>Size: </b><span>{{$photo->file_size}}kb</span> | <b>Format:
                                </b><span>{{$photo->format}}</span></p>
                        </td>
                        <td>
                            <p>{{$photo->description}}</p>
                        </td>
                    </tr>
                    @empty
                    <tr class="">
                        <td scope="row" colspan="5">No record to show.</td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

@endsection