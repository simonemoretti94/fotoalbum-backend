@extends('layouts.app-index')
<style>
    .debug {
        border: solid .5px dashed black;
    }
</style>

@section('content-top')
<h1>hi guyds</h1>
@endsection

@section('content-left')
<div id="actions">
    <h6>Account actions</h6>
    <p><i id="sidebar-icon" class="fa-solid fa-gear"></i>Settings</p>
    <p><i id="sidebar-icon" class="fa-solid fa-chart-line"></i>Dashboard</p>
</div>

<div id="actions">
    <h6>Photos actions</h6>
    <p><i id="sidebar-icon" class="fa-solid fa-compass-drafting"></i>Drafts</p>
    <p><i id="sidebar-icon" class="fa-solid fa-layer-group"></i>Categories</p>
    <p><i id="sidebar-icon" class="fa-solid fa-gear"></i>Settings</p>
</div>

@endsection

@section('content-right')
<div class="container">
    <h1>hello guys</h1>
</div>
@endsection