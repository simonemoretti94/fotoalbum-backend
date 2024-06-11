@extends('layouts.app-index')
<style>
    .debug {
        border: solid .5px dashed black;
    }
</style>

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
    <p><i id="sidebar-icon" class="fa-solid fa-compass-drafting"></i><a href="drafts">Drafts</a></p>
    <p><i id="sidebar-icon" class="fa-solid fa-layer-group"></i><a href="{{route('admin.categories.index')}}">Categories</a></p>
    <p><i id="sidebar-icon" class="fa-solid fa-gear"></i><a href="{{route('profile.edit')}}">Settings</a></p>
    <p><i id="sidebar-icon" class="fa-solid fa-gear"></i><a href="{{route('profile.edit')}}">Settings</a></p>
</div>

@endsection

@section('content-right')
<div class="container">
    <h1>hello guys</h1>
    {{dd($photos)}}
</div>
@endsection