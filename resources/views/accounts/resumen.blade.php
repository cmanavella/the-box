@extends('master')

@section('content')
    <h1>Cuentas</h1>
    <p>En este apartado se muestran sus cuentas virtuales.</p>

    <!--Recorro todas las cuentas traidas por parametro desde el controlador y las muestro en pantalla.-->
    @foreach ($accounts as $account)
      <div class="card">
        <h5 class="card-header">{{$account->nombre}}</h5>
        <div class="card-body">
          <h4 class="card-title">{{$account->account_type->simbolo}}{{$account->total}}</h4>
          <p class="card-text"><strong>Tipo de cuenta:</strong> {{$account->account_type->nombre}}</p>
        </div>
      </div>
    @endforeach
@endsection
