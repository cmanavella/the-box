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
            <span class="d-inline small-gray">{{$account->account_type->simbolo}}</span>
            <h2 class="d-inline">{{number_format($account->total, 2, ',', '.')}}</h2>
          </div>

          <div class="botones_container">
            <span class="boton shadow" title="Ingresar dinero"
            data-toggle="modal" data-target="#ingresarDineroModal"
            data-backdrop="static" data-account-id = "{{ $account->id }}">
                <i class="fa-sharp fa-solid fa-wallet"></i>
                <p>Ingresar</p>
              </span>
            <span class="boton shadow" title="Retirar dinero">
              <i class="fa-sharp fa-solid fa-money-bill-1-wave"></i>
              <p>Retirar</p>
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

          <div id= "detail_account_{{$account->id}}" class="detalle">
            <!--Compruebo que la cuenta tenga movimientos-->
            @if ($account->details->count() > 0)

            <!--Filtro-->
            <div class="filtro">
                <h6>Filtro</h6>
                <form onsubmit="return false;">
                    <div class="form-row">
                        <div class="input-group mb-2">
                            <div class="input-group-text input_icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                            <input type="text" class="form-control no-outline"
                                id="account_input_filter_{{$account->id}}"
                                placeholder="Buscar. Por ej: 'Ingresos' o '12/2022'" />
                            <button id="clear_account_filter_button_{{$account->id}}" class="btn btn-primary clear_input_button">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!--Tabla de detalles-->
            <table id="account_table_{{$account->id}}" class="table table-striped table-responsive">
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
                  <tr class="tr_visible">
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

                        <tr class="tr_hidden"></tr>
                        <tr id="detail_comment_{{$detail->id}}" class="hidden">
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

    <!-- Modal -->
    <div class="modal fade" id="ingresarDineroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">Ingresar Dinero</h6>
                </div>
                <input type="hidden" name="id-account" id="id-account">
                <div class="modal-body">
                    <div class="text-center" style="margin-bottom: 16px;">
                        <span id="money-symbol" class="d-inline small-gray"></span>
                        <h3 id="account-total" class="d-inline"></h3>
                    </div>
                    <div class="input-group mb-2 row">
                        <span style="font-weight: bold;" class="col-sm-5">Nombre de la cuenta:</span>
                        <span id="account-name" class="col-sm-5"></span>
                    </div>
                    <div class="input-group mb-2 row">
                        <span style="font-weight: bold;" class="col-sm-5">Tipo de cuenta:</span>
                        <span id="account-type" class="col-sm-5"></span>
                    </div>
                    <hr />
                    <form onsubmit="return false;">
                        <div id="error-panel" class="errores">
                            <ul id="error-list">

                            </ul>
                        </div>
                        <div class="form-row">
                            <div class="input-group mb-2">
                                <div class="input-group-text input_icon">
                                    <i class="fa-regular fa-calendar"></i>
                                </div>
                                <div class="col-sm-4" style="margin-right: 8px;">
                                    <input type="date" class="form-control no-outline"
                                        id="account-date" name = "account-date"
                                        placeholder="dd/mm/aaaa" />

                                </div>
                                <div class="input-group-text input_icon">
                                    <span id="account-money-symbol"></span>
                                </div>
                                <div class="col-auto">
                                    <input type="number" class="form-control no-outline"
                                        id="monto" name = "monto"
                                        placeholder="1.000,00" min="0" step="any"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control no-outline"
                                        id="observaciones" name = "observaciones"
                                        placeholder="Observaciones (opcional)" />
                            </div>
                        </div>

                        <a id="add-movimiento" class="flat-button" title="Agregar otro..." onclick="agregar_movimiento()">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </form>

                    <table id="tabla-movimientos" class="table table-sm table-fixed">
                        <thead>
                            <tr>
                                <th scope="col" class="th-fecha">Fecha</th>
                                <th scope="col" class="th-monto">Monto</th>
                                <th scope="col" class="th-observaciones">Observaciones</th>
                                <th scope="col" class="th-icon"></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="close_modal()">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
