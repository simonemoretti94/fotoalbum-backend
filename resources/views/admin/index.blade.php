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
    <button
        class="btn"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#Id2"
        aria-controls="Id2"
    >
        <h6 id="offcanvas-trigger">Account actions</h6>
    </button>

    <div
        class="offcanvas offcanvas-start"
        data-bs-backdrop="static"
        tabindex="-1"
        id="Id2"
        aria-labelledby="staticBackdropLabel"
    >
        <div class="offcanvas-header">
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
            ></button>
        </div>
        <div class="offcanvas-body">
        <div id="actions">

            <h6 class="my-4">Account actions</h6>

            <p><i id="sidebar-icon" class="fa-solid fa-gear"></i><a href="{{route('profile.edit')}}">Settings</a></p>
            <p><i id="sidebar-icon" class="fa-solid fa-chart-line"></i><a href="{{route('admin.dashboard')}}">Dashboard</a></p>

            <h6 class="my-4">Photos actions</h6>

            <p><i id="sidebar-icon" class="fa-solid fa-compass-drafting"></i><a href="drafts">Drafts</a></p>
            <p><i id="sidebar-icon" class="fa-solid fa-layer-group"></i><a href="{{route('admin.categories.index')}}">Categories</a></p>

            <p id="p-show-head"><i id="sidebar-icon" class="fas fa-eye fa-xs fa-fw"></i>Show</p>
            <div id="div-js-show-head" class="d-none">
                @foreach ($photos as $key=>$photo)
                <p>{{$photo->id}}: <a href="{{route('admin.photos.show' , $photo)}}">{{$photo->title}}</a></p>
                @endforeach
            </div>

            <p id="p-edit-head"><i id="sidebar-icon" class="fa-solid fa-pen-to-square"></i>Edit</p>
            <div id="div-js-edit-head" class="d-none">
                @foreach ($photos as $key=>$photo)
                <p>{{$photo->id}}: <a href="{{route('admin.photos.edit' , $photo)}}">{{$photo->title}}</a></p>
                @endforeach
            </div>
        </div>
        </div>
    </div>


@endsection

@section('content-left')
    <div id="actions">
    <h6>Account actions</h6>
    <p><i id="sidebar-icon" class="fa-solid fa-gear"></i><a href="{{route('profile.edit')}}">Settings</a></p>
    <p><i id="sidebar-icon" class="fa-solid fa-chart-line"></i><a href="{{route('admin.dashboard')}}">Dashboard</a></p>
    </div>

    <div id="actions">
        <h6>Photos actions</h6>
        <p><i id="sidebar-icon"  class="fa-solid fa-square-plus"></i><a href="{{route('admin.photos.create')}}">Create</a></p>
        <p id="p-show"><i id="sidebar-icon" class="fas fa-eye fa-xs fa-fw"></i>Show</p>
        <div id="div-js-show" class="d-none">
            @foreach ($photos as $key=>$photo)
            <p>{{$photo->id}}: <a href="{{route('admin.photos.show' , $photo)}}">{{$photo->title}}</a></p>
            @endforeach
        </div>
        <p id="p-edit"><i id="sidebar-icon" class="fa-solid fa-pen-to-square"></i>Edit</p>
        <div id="div-js-edit" class="d-none">
            @foreach ($photos as $key=>$photo)
            <p>{{$photo->id}}: <a href="{{route('admin.photos.edit' , $photo)}}">{{$photo->title}}</a></p>
            @endforeach
        </div>
        <p><i id="sidebar-icon" class="fa-solid fa-compass-drafting"></i><a href="drafts">Drafts</a></p>
        <p><i id="sidebar-icon" class="fa-solid fa-layer-group"></i><a href="{{route('admin.categories.index')}}">Categories</a></p>
    </div>

    <div id="actions">
        <h6 class="text-danger">Danger Area</h6>
        <p id="p-delete"><i id="sidebar-icon" class="fa-regular fa-trash-can"></i>Delete</p>
        <div id="div-js-delete" class="d-none">
            @foreach ($photos as $key=>$photo)
            <p>{{$photo->id}}: <a href="{{route('admin.photos.destroy' , $photo)}}">{{$photo->title}}</a></p>
            @endforeach
        </div>
    </div>

@endsection

@section('content-right')
    <div class="container">
        @if(session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
        @endif
        <div
            class="table-responsive"
        >
            <table
                class="table table-light"
            >
                <thead>
                    <tr class="tr-data">
                        <th scope="col">Id</th>
                        <th scope="col">Cover image</th>
                        <th scope="col" class="th-title">Title</th>
                        <th scope="col" class="th-title">Infos</th>
                        <th class="th-description" scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($photos as $photo)
                        
                    <tr class="row-data">
                        <td scope="row">
                            <p class="text-center">{{$photo->id}}</p>
                            <button
                            type="button"
                            class="btn btn-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#modalId"
                        >
                            Delete
                        </button>


                        <!-- Modal Body -->
                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                        <div
                            class="modal fade"
                            id="modalId"
                            tabindex="-1"
                            data-bs-backdrop="static"
                            data-bs-keyboard="false"
                            
                            role="dialog"
                            aria-labelledby="modalTitleId"
                            aria-hidden="true"
                        >
                            <div
                                class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                role="document"
                            >
                                <div class="modal-content">
                                    <div class="modal-header d-flex">
                                        <h5 class="col-10 text-center">Project {{$photo->id}} delete</h5>
                                        <button
                                            type="button"
                                            class="btn-close col-2"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>
                                    </div>
                                    <div class="modal-body">Are you committed to delete this photo? Ater done, it won't be reversable</div>
                                    <div class="modal-footer d-flex flex-column">
                                        <button
                                            type="button"
                                            class="btn btn-secondary col-12"
                                            data-bs-dismiss="modal"
                                        >
                                            Close
                                        </button>
                                        {{-- <button type="button" class="btn btn-primary">Delete</button> --}}
                                        <form action="{{route('admin.photos.destroy', $photo)}}"  method="post" class="col-12">
                                            @csrf
                                            @method('DELETE')
                                            {{-- because it responds to static function delete into route --}}

                                            <button type="submit" class="btn btn-danger bg-gradient col-12" >Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </td>
                        
                        <td>

                        @if(Str::startsWith($photo->cover_image , 'https://'))
                            <img width="150" height="200" src="{{$photo->cover_image}}" alt="{{$photo->title}}">
                        @else
                            <img width="150" height="200" src="{{asset('storage/' . $photo->cover_image)}}" alt="{{$photo->title}}">
                        @endif

                        </td>

                        <td class="td-title" > 
                            <p>{{$photo->title}}</p>
                            <p><b>Slug:</b></p>
                            <p>{{$photo->slug}}</p>
                        </td>
                        <td>
                            <p><b>Created: </b><span>{{$photo->created_at}}</span></p>
                            <p><b>Updated: </b><span>{{$photo->updated_at}}</span></p>
                            <p><b>Size: </b><span>{{$photo->file_size}}</span> | <b>Format: </b><span>{{$photo->format}}</span></p>
                        </td>
                        <td class="td-description">{{$photo->description}}</td>
                    </tr>
                    @empty
                    <tr class="">
                        <td scope="row" colspan="4">No record to show.</td>
                    </tr>
                        
                    @endforelse
                </tbody>
            </table>
        </div>
        
    </div>

    
<style>
    tr.row-data {
        @media screen and (max-width: 600px) {
            height: 150px;
    
            & img {
                width: 100px;
                height: 150px;
            }
        }
    
        @media screen and (max-width: 600px) {
            height: 100px;
    
            & img {
                width: 70px;
                height: 100px;
            }
        }
    }
    
    td.td-description {
        overflow-y: scroll;
    }
    th.th-description,td.td-description {
        width: 30%;
        @media screen and (max-width: 750px) {
            display: none;
        }
    }
    
    th.th-title,td.td-title {
        @media screen and (max-width: 450px){
            width: 20%;
        }
    }
    
    
    </style>
@endsection