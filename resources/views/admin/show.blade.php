@extends('layouts.app')

@section('content')

<h1>welcome to show area</h1>
{{dd(Auth::id())}}
{{dd($photo)}}

@endsection