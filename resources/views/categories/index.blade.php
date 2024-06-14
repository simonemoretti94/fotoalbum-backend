@extends('layouts.app')

@section('content')

<x-show-subheader>Categories section</x-show-subheader>

<div id="div-categories" class="container">
    <div class="row g-4">
        <div class="col">
            <form action="{{route('admin.categories.store')}}" method="post">
                @csrf

                <div class="my-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelper"
                        placeholder="example: Landscapes" />
                    <small id="nameHelper" class="form-text text-muted">Type a category name</small>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-solid fa-plus"></i></button>
            </form>
        </div>
        <div class="col-xxl-9 col-xl-9 col-lg-12">
            <div class="table-responsive" style="max-height: calc(100vh - 160px); overflow-y: scroll;">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Total Posts</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)

                        <tr>
                            <td scope="row">{{$category->id}}</td>
                            <td>
                                <form action="{{route('admin.categories.update' , $category)}}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')

                                    <div id="div-edit" class="mb-3">
                                        <input type="text" class="form-control" name="name" id="name"
                                            aria-describedby="helpId" placeholder="" value="{{$category->name}}"
                                            style="width: 80%;" />
                                        <button id="button-edit-first" type="submit"
                                            class="btn btn-secondary bg-gradient text-sm ms-1">Edit</button>
                                    </div>
                                    
                                </form>
                                <div id="div-delete">
                                    {{-- start modal --}}

                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-danger bg-gradient" data-bs-toggle="modal"
                                    data-bs-target="#modal-{{$category->id}}-hide" style="width: 100%;">
                                    Delete
                                    </button>


                                    <!-- Modal Body -->
                                    <div class="modal fade" id="modal-{{$category->id}}-hide" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalCategoryId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
                                    role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title text-center col-9" id="modalTitleId">
                                    Delete category #{{$category->id}}?
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">Are you committed to delete this category? Ater
                                    done, it
                                    won't be reversable</div>
                                    <div class="modal-footer d-flex flex-column">
                                    <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal" style="width: 100%;">
                                    Close
                                    </button>
                                    <form action="{{route('admin.categories.destroy', $category)}}"
                                    method="post" class="col-12">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                    class="btn btn-danger bg-gradient" style="width: 100%;">Delete</button>
                                    </form>
                                    </div>
                                    </div>
                                    </div>
                                    </div>

                                    {{-- end modal --}}
                                </div>
                            </td>
                            <td>{{$category->slug}}</td>
                            <td>
                                <p class="text-center mt-2">
                                    <span
                                        class="text-white bg-primary bg-gradient py-1 px-2 rounded-2">{{$category->photos->count()}}</span>
                                </p>
                            </td>
                            <td>
                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-danger bg-gradient" data-bs-toggle="modal"
                                data-bs-target="#modal-{{$category->id}}-hide-responsive" style="width: 100%;">
                                Delete
                                </button>


                                <!-- Modal Body -->
                                <div class="modal fade" id="modal-{{$category->id}}-hide-responsive" tabindex="-1"
                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                aria-labelledby="modalCategoryId" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title text-center" id="modalTitleId">
                                Delete category #{{$category->id}}?
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                                </div>
                                <div class="modal-body">Are you committed to delete this category? Ater
                                done, it
                                won't be reversable</div>
                                <div class="modal-footer d-flex flex-column">
                                <button type="button" class="btn btn-secondary col-12"
                                data-bs-dismiss="modal">
                                Close
                                </button>
                                <form action="{{route('admin.categories.destroy', $category)}}"
                                method="post" class="col-12">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                class="btn btn-danger bg-gradient col-12">Delete</button>
                                </form>
                                </div>
                                </div>
                                </div>
                                </div>
                            </td>
                           
                        </tr>
                        @empty

                        <tr class="">
                            <td scope="row" colspan="5">No records to show</td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
{{-- <style>

    form#form-edit-second,
    button#button-edit-second {
        display: none;

        @media screen and (max-width: 760px) {
            display: block;
        }
    }

   tbody td:nth-child(2) {
    display: flex;
    flex-direction: column;
       & div#div-edit {
        display: flex;
        & input {
            width: 80%;
        }
        & button {
                width: 20%;
        }
         
        @media screen and (max-width: 1044px) {
        & input {
        width: 70%;
        }
        & button {
        width: 30%;
        }
        }

        }

        @media screen and (max-width: 576px) {
        & input {
        width: 60%;
        }
        & button {
        width: 40%;
        }
        }

        @media screen and (max-width: 456px) {
        & input {
        width: 50%;
        }
        & button {
        width: 50%;
        }
        }

        & div#div-delete {
            display: none;
            background-color: #EBEBEB;

            @media screen and (max-width: 576px) {
            display: block;
            display: flex;
            justify-content: center;
            padding: .2rem 0;
            > button {
                width: 50%;
            }
            }
        }

    }

    thead th:nth-child(3) , tbody td:nth-child(3) ,  thead th:nth-child(5) , tbody td:nth-child(5) {
        @media screen and (max-width: 760px) {
            display: none;
        }
    }


</style> --}}
@endsection