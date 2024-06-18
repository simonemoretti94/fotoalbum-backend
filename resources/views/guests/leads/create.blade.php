@extends('layouts.lead-app')

@section('content')

<div class="p-t mb-4 bg-light rounded-3">
    <div class="container py-t">
        <p class="col-md-8 fs-4">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellendus, ex quidem, autem magnam et, nobis
            assumenda optio consequatur ullam nam veniam earum harum incidunt culpa nemo aliquid doloremque laborum
            voluptatum?
        </p>
        <a href="#contact-form" class="btn btn-primary btn-md">Contact me</a>
    </div>
</div>

<div class="container">

    <form action="{{route('contacts.store')}}" id="contact-form" method="post">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <div class="mb-3">
                <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelper"
                    placeholder="abc@mail.com" />
                <small id="helpId" class="form-text text-muted">Type a valid e-mail</small>
            </div>

        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <div class="mb-3">
                <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelper"
                    placeholder="John Doe" />
                <small id="helpId" class="form-text text-muted">Type your name and surname</small>
            </div>

        </div>

        <div class="mb-3">
            <label for="" class="form-label">Message</label>
            <textarea class="form-control" name="message" id="message" rows="6"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">
            Submit
        </button>

    </form>
</div>

@endsection