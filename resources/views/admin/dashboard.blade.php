@extends('layout.app')

@section('content')
    @auth
    <div class="row p-3">
        <div class="col-md-12 text-end">
            <a href="{{ route('logout') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Logout</a>
        </div>
    </div>
    @endauth

    <style>
        table {
            text-align: center;
        }
        .numero {
            font-size: 28px;
        }
        tr {
            vertical-align: middle;
        }
    </style>

    <section class="row">
        <section class="col-md-4">
            <div class="bg-light p-5">
                <h2>INSERISCI ORDINE COMPLETATO</h2>
                <form method="post" action="{{ route('add-order') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="ordine" class="form-label">Numero ordine</label>
                        <input type="number" class="form-control" id="ordine" name="ordine" required>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary w-100" value="INSERISCI ORDINE">
                    </div>
                </form>

                <form method="post" action="{{ route('remove-order') }}" onsubmit="return confirm('Sei sicuro di voler annullare l\'ultimo ordine inserito?')">
                    @csrf
                    <input type="hidden" class="form-control" name="ordine" value="{{ count($ordini) > 0 ? encrypt($ordini[0]->id) : '' }}" required>
                    <input type="submit" class="btn btn-sm btn-danger" value="ANNULLA ULTIMO ORDINE">
                </form>
            </div>
        </section>

        <section class="col-md-8">
            <div class="bg-light p-5">
                <h2>ULTIMI ORDINI</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Numero ordine</th>
                            <th>Stato</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($ordini as $ordine)
                        <tr class="@if($ordine->stato == 'IN_ATTESA') table-warning
                                @elseif($ordine->stato == 'CONSEGNATO') table-success
                                @elseif($ordine->stato == 'ANNULLATO') table-danger @endif">
                            <td class="numero">{{ $ordine->numero }}</td>
                            <td>{{ $ordine->stato }}</td>
                            <td>
                                <div class="d-flex">
                                    @if($ordine->stato == 'IN_ATTESA')
                                        <form method="post" action="{{ route('delivered-order') }}">
                                            @csrf
                                            <input type="hidden" class="form-control" name="ordine" value="{{ encrypt($ordine->id) }}" required>
                                            <input type="submit" class="btn btn-sm btn-success me-3" value="ORDINE CONSEGNATO">
                                        </form>
                                        <form method="post" action="{{ route('remove-order') }}" onsubmit="return confirm('Sei sicuro di voler annullare questo ordine?')">
                                            @csrf
                                            <input type="hidden" class="form-control" name="ordine" value="{{ encrypt($ordine->id) }}" required>
                                            <input type="submit" class="btn btn-sm btn-danger" value="ANNULLA ORDINE">
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </section>
@endsection
