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
            <span class="boton shadow">
              <i class="fa-sharp fa-solid fa-money-bill-1-wave" title="Retirar dinero"></i>
              <p>Retirar</p>
            </span>
            <span class="boton shadow">
              <i class="fa-sharp fa-solid fa-wallet" title="Ingresar dinero"></i>
              <p>Ingresar</p>
            </span>
            <span id="info_button_{{$account->id}}" class="boton shadow">
              <i class="fa-solid fa-money-bill-transfer" title="Detalles"></i>
              <p>Detalles</p>
            </span>
          </div>

          <div id= "detalle_account_{{$account->id}}" class="detalle">
            <table>
              <tr>
                <th>Columna1</th>
                <th>Columna2</th>
              </tr>
              <tr>
                <td>1</td>
                <td>2</td>
              </tr>
              <tr>
                <td>1</td>
                <td>2</td>
              </tr>
              <tr>
                <td>1</td>
                <td>2</td>
              </tr>
              <tr>
                <td>1</td>
                <td>2</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    @endforeach
    @else
        <p style="text-align: center; margin: 8px;">No se han encontrado cuentas para mostrar.</p>
        <hr/>
    @endif


@endsection
