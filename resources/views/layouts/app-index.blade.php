@extends('layouts.app')

@section('content')
<section id="section-top">
@yield('content-top' , 'section top')
</section>

<section class="d-flex my-1">
        
    <section id="section-left">
        @yield('content-left' , 'section left')
    </section>
    <section id="section-right">
        @yield('content-right' , 'section right')
    </section>

</section>
<style>
    section#section-top {
            min-height: 40px;
            display: none;
    }
    section#section-left {
            width: 20%;
            padding-top: 1rem;
            min-height: calc(100vh - 100px);
    }
    section#section-right {
            width: 80%;
            padding-top: 1rem;
            min-height: calc(100vh - 100px);
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
            display: flex;
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