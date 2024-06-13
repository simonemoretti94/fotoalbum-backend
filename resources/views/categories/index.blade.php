@extends('layouts.app')

@section('content')

<x-show-subheader>Categories section</x-show-subheader>

<div class="container">
    <div class="row g-4">
        <div class="col">
            <form action="{{route('admin.categories.store')}}" method="post">
                @csrf

                <div class="mb-3">
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
                                <form id="form-edit-first" action="{{route('admin.categories.update' , $category)}}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')

                                    <div class="mb-3">
                                        <div class="mb-3 d-flex">
                                            <input type="text" class="form-control" name="name" id="name"
                                                aria-describedby="helpId" placeholder="" value="{{$category->name}}"
                                                style="width: 80%;" />
                                            <button id="button-edit-first" type="submit"
                                                class="btn btn-sm btn-secondary bg-gradient text-sm ms-1"
                                                style="width: 20%;">Edit</button>
                                        </div>

                                    </div>

                                </form>
                            </td>
                            <td>{{$category->slug}}</td>
                            <td><span
                                    class="text-white bg-primary bg-gradient py-1 px-2 rounded-2">{{$category->photos->count()}}</span>
                            </td>
                            <td>
                                <!-- Modal trigger button -->
                                <form id="form-edit-second" action="{{route('admin.categories.update' , $category)}}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button id="button-edit-second" type="submit"
                                        class="btn btn-secondary bg-gradient mb-1" style="width: 100%;">Edit</button>
                                </form>
                                <button type="button" class="btn btn-danger bg-gradient" data-bs-toggle="modal"
                                    data-bs-target="#modal-{{$category->id}}" style="width: 100%;">
                                    Delete
                                </button>


                                <!-- Modal Body -->
                                <div class="modal fade" id="modal-{{$category->id}}" tabindex="-1"
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
<style>
    form#form-edit-first,
    button#button-edit-first {
        @media screen and (max-width: 760px) {
            display: none;
        }
    }

    form#form-edit-second,
    button#button-edit-second {
        display: none;

        @media screen and (max-width: 760px) {
            display: block;
        }
    }
</style>
@endsection