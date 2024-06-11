@extends('layouts.app-index')

@section('content-top')
    <div id="actions" class="col-6">
        <h6>Account actions</h6>
        <p><i id="sidebar-icon" class="fa-solid fa-gear"></i><a href="{{route('profile.edit')}}">Settings</a></p>
        <p><i id="sidebar-icon" class="fa-solid fa-chart-line"></i><a href="{{route('admin.dashboard')}}">Dashboard</a></p>
    </div>

    <div id="actions" class="col-6">
        <h6 class="text-center">Photos actions</h6>
        <div class="row">
            <p><i id="sidebar-icon" class="fa-solid fa-compass-drafting"></i><a href="drafts">Drafts</a></p>
            <p><i id="sidebar-icon" class="fa-solid fa-layer-group"></i><a href="{{route('admin.categories.index')}}">Categories</a></p>
            <p><i id="sidebar-icon" class="fa-solid fa-gear"></i><a href="{{route('profile.edit')}}">Settings</a></p>
            <p><i id="sidebar-icon" class="fa-solid fa-gear"></i><a href="{{route('profile.edit')}}">Settings</a></p>
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
        <p><i id="sidebar-icon" class="fa-solid fa-pen-to-square"></i><a href="{{route('admin.photos.edit' , 1)}}">Edit</a></p>
        <p><i id="sidebar-icon" class="fa-solid fa-compass-drafting"></i><a href="drafts">Drafts</a></p>
        <p><i id="sidebar-icon" class="fa-solid fa-layer-group"></i><a href="{{route('admin.categories.index')}}">Categories</a></p>
        <p id="p-show"><i id="sidebar-icon" class="fas fa-eye fa-xs fa-fw"></i><a>Test show</a></p>
        <div id="div-show" class="d-none">
            @foreach ($photos as $key=>$photo)
            <p>{{$photo->id}}: <a href="{{route('admin.photos.show' , $photo)}}">{{$photo->title}}</a></p>
            @endforeach
        </div>
    </div>

    <style>
        div#div-show {
            width: 70%;
            margin: auto;
            padding: .5rem;
            background-color: white;
            border: solid 1px #7b7b7b;
            border-radius: 5px;
            & p {
                font-size: 10px;
                padding-bottom: .25rem;
                padding-left: .5rem;
                border-bottom: .5px solid #F5F5F5;
            }

            & p:hover {
                background-color: #7b7b7b;
                color: white;
                border-bottom: .5px solid black;
            }
        }
    </style>

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
                        <th class="th-slug" scope="col">Slug</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($photos as $photo)
                        
                    <tr class="row-data">
                        <td scope="row">{{$photo->id}}</td>
                        
                        <td>

                        @if(Str::startsWith($photo->cover_image , 'https://'))
                            <img width="150" height="200" src="{{$photo->cover_image}}" alt="{{$photo->title}}">
                        @else
                            <img width="150" height="200" src="{{asset('storage/' . $photo->cover_image)}}" alt="{{$photo->title}}">
                        @endif

                        </td>

                        <td class="td-title" >{{$photo->title}}</td>
                        <td class="td-slug">{{$photo->slug}}</td>

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

                        th.th-slug,td.td-slug {
                            @media screen and (max-width: 750px) {
                                display: none;
                            }
                        }

                        th.th-title,td.td-title {
                            @media screen and (max-width: 450px){
                                width: 20%;
                            }
                        }

                        td#td-buttons
                        {
                            width: 20%;

                            @media screen and (max-width: 600px){
                                width: 10%;
                            }

                            > div {
                                width: 50%;
                                display: flex;
                                flex-direction: column;
                                margin: auto auto;

                                @media screen and (max-width: 900px) {
                                    width: 100%;
                                }

                                & button {
                                    width: 100%;
                                    margin: auto auto .2rem auto;
                                }
                            }
                        }
                        
                        </style>

                        <td id="td-buttons" >
                            <div>
                                <button class="btn btn-primary bg-gradient"><a style="text-decoration: none; color: white;" href="{{route('admin.photos.show' , $photo)}}"><i class="fas fa-eye fa-xs fa-fw"></i> View</a></button>

                                <button class="btn btn-secondary bg-gradient "><a style="text-decoration: none; color: white;" href="{{route('admin.photos.edit' , $photo)}}"><i class="fas fa-pencil fa-xs fa-fw"></i> Edit</a></button>

                                {{-- <button class="btn btn-danger bg-gradient"><a style="text-decoration: none; color: white;" href="{{route('admin.photos.destroy' , $photo)}}">Delete</a></button> --}}
                                

                                <!-- Modal trigger button -->
                                <button
                                    type="button"
                                    class="btn btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalId"
                                >
                                    <i class="fas fa-trash fa-xs fa-fw"></i> Delete
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
                                            <div class="modal-header">
                                                <h5 class="modal-title text-center" id="modalTitleId">
                                                    Project {{$photo->id}} delete
                                                </h5>
                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"
                                                ></button>
                                            </div>
                                            <div class="modal-body">Are you committed to delete this photo? Ater done, it won't be reversable</div>
                                            <div class="modal-footer d-flex flex-column">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    data-bs-dismiss="modal"
                                                >
                                                    Close
                                                </button>
                                                {{-- <button type="button" class="btn btn-primary">Delete</button> --}}
                                                <form action="{{route('admin.photos.destroy', $photo)}}"  method="post" class="col-12">
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- because it responds to static function delete into route --}}

                                                    <button type="submit" class="btn btn-danger bg-gradient col-6" >Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                            </div>
                        </td>
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
@endsection