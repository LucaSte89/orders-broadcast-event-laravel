@extends('layout.app')

@section('content')
    @auth
    <div class="row p-3">
        <div class="col-md-12 text-end">
            <a href="{{ route('logout') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Logout</a>
        </div>
    </div>
    @endauth

    <section class="row">
        <section class="col-md-8">
            <div class="bg-light p-5">
                <h2>INSERISCI ORDINE COMPLETATO</h2>
                <form method="post" action="{{ route('add-order') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="ordine" class="form-label">Numero ordine</label>
                        <input type="number" class="form-control" id="ordine" name="ordine" required>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="INSERISCI ORDINE">
                    </div>
                </form>
            </div>
        </section>

        <section class="col-md-4">
            <div class="bg-light p-5">
                <h2>ULTIMI ORDINI COMPLETATI</h2>
                <ul>
                @foreach($ordini as $ordine)
                    <li>{{ $ordine->numero }}</li>
                @endforeach
                </ul>
            </div>
        </section>
    </section>
@endsection
