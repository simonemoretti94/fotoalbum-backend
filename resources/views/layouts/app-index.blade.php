@extends('layouts.app')

@section('content')

<section id="section-top" class="debug">
@yield('content-top' , 'section top')
</section>

<section class="d-flex my-1">
        
    <section id="section-left" class="debug " >
        @yield('content-left' , 'section left')
    </section>
    <section id="section-right">
        @yield('content-right' , 'section right')
    </section>

</section>
<style>
    .debug {
        border-right: solid 1px black;
        border-bottom: solid 1px dashed;
    }
    section#section-top {
            min-height: 40px;
            display: none;
    }
    section#section-left {
            width: 20%;
    }
    section#section-right {
            width: 80%;
    }

    @media screen and (max-width: 1044px) {
        section#section-left {
            width: 15%;
        }

        section#section-right {
            width: 85%;
        }
    }

    @media screen and (max-width: 796px) {
        section#section-left {
            width: 25%;
        }

        section#section-right {
            width: 75%;
        }
    }
    @media screen and (max-width: 576px) {
        section#section-top {
            min-height: 40px;
            display: block;
    }
        section#section-left {
            display: none;
        }

        section#section-right {
            width: 100%;
        }
    }
</style>

@endsection