@extends('layout.app')

@section('content')
    <style>
        #content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        #ultimoOrdine {
            font-size: 100px;
        }
        #ordiniInAttesa {
            display: flex;
        }
        .ordiniInAttesa {
            display: flex;
            justify-content: center;
            align-items: center;
            border: 3px #000000 solid;
            width: 150px;
            height: 100px;
            font-size: 50px;
            margin: 0 20px;
        }
    </style>
    <section id="content">
        <h1>STIAMO SERVENDO L'ORDINE NUMERO</h1>
        <div id="ultimoOrdine"></div>

        <h2 id="titoloOrdiniInAttesa" class="mt-5 d-none">Ordini in attesa di essere ritirati</h2>
        <div id="ordiniInAttesa">

        </div>
    </section>
@endsection

@section('script')
    <script>
        var ordiniInAttesa = 0;

        Echo.channel('ordini')
            .listen('NuovoOrdine', (e) => {
                ordiniInAttesa++;
                $('#ultimoOrdine').html(e.numeroOrdine);
                $('#ordiniInAttesa').append("<div id='" + e.numeroOrdine + "' class='ordiniInAttesa " + ordiniInAttesa + "'>" + e.numeroOrdine + "</div>");
                attesa();
            })
            .listen('OrdineConsegnato', (e) => {
                ordiniInAttesa--;
                $('#'+e.numeroOrdine).remove();
                attesa();
            })
            .listen('OrdineAnnullato', (e) => {
                ordiniInAttesa--;
                $('#'+e.numeroOrdine).remove();
                if(String(e.numeroOrdine) === $('#ultimoOrdine').text()) {
                    $('#ultimoOrdine').html($('.'+ordiniInAttesa).text());
                }
                attesa();
            });

        function attesa() {
            if(ordiniInAttesa > 0) {
                $('#titoloOrdiniInAttesa').removeClass('d-none');
            } else {
                $('#titoloOrdiniInAttesa').addClass('d-none');
            }
        }
    </script>
@endsection
