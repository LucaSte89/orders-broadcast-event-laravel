@extends('layout.app')

@section('content')
<section class="row d-flex justify-content-center">
    <div class="col-md-6 col-md-6 bg-light p-5">
    @foreach ($errors->all() as $message)
        <p>{{ $message }}</p>
    @endforeach
        <h1 class="text-center">REGISTRATI</h1>
        <form method="post" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-primary" value="REGISTRA UTENTE">
            </div>
        </form>
    </div>
</section>
@endsection
