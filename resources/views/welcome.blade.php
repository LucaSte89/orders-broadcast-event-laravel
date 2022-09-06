@extends('layout.app')

@section('content')
    <style>
        #s {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        #d {
            font-size: 100px;
        }
    </style>
    <section id="s">
        <h1>STIAMO SERVENDO L'ORDINE NUMERO</h1>
        <div id="d"></div>
    </section>
@endsection

@section('script')
    <script>
        
        Echo.channel('nuovo-ordine')
        .listen('NuovoOrdine', (e) => {
            $('#d').html(e.ordine.numero);
            console.log(e);
        });
    </script>
@endsection