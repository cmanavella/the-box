@extends('master')

@section('content')
    <!--Me fijo de que haya cuentas en la base de datos.-->
    @if ($accounts->count() > 0)
      <!--Recorro todas las cuentas traidas por parametro desde el controlador y las muestro en pantalla.-->
      @foreach ($accounts as $account)
      <div class="card mt-3 mb-3 shadow-sm hide">
        <div class="card-header">
          <h6 class="left">{{$account->nombre}}</h6>
          <p class="right"><strong>Tipo de cuenta:</strong> {{$account->account_type->nombre}}</p>
        </div>
        <div class="card-body">
          <div class="info-resumida">
            <h2><span class="moneda">{{$account->account_type->simbolo}}</span>{{number_format($account->total, 2, ',', '.')}}</h2>
          </div>

          <div class="botones_container">
            <span class="boton shadow" title="Retirar dinero">
              <i class="fa-sharp fa-solid fa-money-bill-1-wave"></i>
              <p>Retirar</p>
            </span>
            <span class="boton shadow" title="Ingresar dinero">
              <i class="fa-sharp fa-solid fa-wallet"></i>
              <p>Ingresar</p>
            </span>
            <span id="info_button_{{$account->id}}" class="boton shadow" title="Detalles">
              <i class="fa-solid fa-money-bill-transfer"></i>
              <p>Detalles</p>
            </span>
            <span class="boton shadow" title="Prestar dinero">
              <i class="fa-solid fa-file-invoice-dollar"></i>
              <p>Prestar</p>
            </span>
            <span class="boton shadow" title="Regresar dinero prestado">
              <i class="fa-solid fa-receipt"></i>
              <p>Regresar</p>
            </span>
          </div>

          <div id= "detalle_account_{{$account->id}}" class="detalle">
            <!--Compruebo que la cuenta tenga movimientos-->
            @if ($account->details->count() > 0)
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Fecha</th>
                  <th scope="col">Tipo</th>
                  <th scope="col">Haberes</th>
                  <th scope="col">Débitos</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($account->details as $detail )
                  <tr>
                    <td>{{ date("d/m/Y", strtotime($detail->fecha)) }}</td>
                    <td>{{ $detail->detail_account_type->nombre }}</td>

                    <!--En base a si es debito o no, imprimo el monto en la columna correspondiente
                      mientras la otra la dejo vacia.-->
                    @if ($detail->detail_account_type->is_debit)
                      <td></td>
                      <td class="debito">-{{ $account->account_type->simbolo }}{{ number_format($detail->monto, 2, ',', '.') }}</td>
                    @else
                      <td>{{ $account->account_type->simbolo }}{{ number_format($detail->monto, 2, ',', '.') }}</td>
                      <td></td>
                    @endif

                    <!--Si el detalle tiene comentario, lo cargo en un div oculto.-->

                    @if (!is_null($detail->comments))
                        <td id="detalle_{{$detail->id}}"><i class="fa-solid fa-circle-info"></i></td>

                        <tr style="display = none;"></tr>
                        <tr id="detail_comment_{{$detail->id}}">
                          <td colspan="5">{{$detail->comments}}</td>
                        </tr>
                    @else
                        <td> </td>
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>
            @else
                <p>No se registran movimientos en la cuenta.</p>
            @endif
          </div>
        </div>
      </div>
    @endforeach
    @else
        <p style="text-align: center; margin: 8px;">No se han encontrado cuentas para mostrar.</p>
        <hr/>
    @endif


@endsection
