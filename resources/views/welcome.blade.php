@extends('layouts.app')
@section('content')

<div id="jumbo-wrapper" class="jumbotron mb-4 bg-light rounded-3">
    <div id="jumbo-container" class="container py-5">
        <h3>
            Welcome to Fotoalbum-backend <i class="bi bi-database"></i>
        </h3>

        <p class="col-12 col-md-8">
            This is a backend management system for photography projects, built with Laravel. It supports all versions
            of Laravel from 9.x to the latest release 11.x. The system offers a range of features for photo management,
            including uploading, organizing, and editing images. Additionally, it integrates Laravel Breeze/Blade for
            easy customization of views. You can also use Bootstrap icons to enhance the user interface. This photo
            management system is the ideal solution for professional photographers and photography enthusiasts.
        </p>
        <a href="https://github.com/simonemoretti94" class="btn btn-primary btn-md" type="button">My Github profile</a>
    </div>
</div>

@endsection