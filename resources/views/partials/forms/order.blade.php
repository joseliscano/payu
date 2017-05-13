@extends('welcome') @section('title', 'Mi tienda de pruebas|Order')

@section('content')
<div class="row">
	@include('partials.lateralbar')
	<div class="col-md-9">
		<h3>Carrito de compras</h3>
		@if($flash = session('message'))
			<div class="alert alert-success alert-dismissible fade in"
				role="alert">
				<button type="button" class="close" data-dismiss="alert"
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<strong>{{ $flash }}</strong>
			</div>
		@endif
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li> @endforeach
				</ul>
			</div>
		@endif
		<div class="row">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Producto</th>
						<th>Cantidad</th>
						<th>Precio unitario</th>
						<th>Precio total</th>
					</tr>
				</thead>
				<tbody>
					@foreach($items as $item)
						<tr>
							<td>{{ $item->description }}</td>
							<td>{{ $item->quantity }}</td>
							<td>${{ $item->price }}</td>
							<td>${{ $item->price * $item->quantity }}</td>
						</tr>
					@endforeach
					<tr>
						<td></td>
						<td></td>
						<th>Total a pagar</th>
						<th>${{ $totalPrice }}</th>
					</tr>
				</tbody>
			</table>
		</div>
		<div>
		<!--	 <form method="post" action="https://sandbox.gateway.payulatam.com/ppp-web-gateway">
				  <input name="merchantId"    type="hidden"  value="{{ $merchantId }}"   >
				  <input name="accountId"     type="hidden"  value="{{ $accountId }}" >
				  <input name="description"   type="hidden"  value="Test PAYU"  >
				  <input name="referenceCode" type="hidden"  value="{{ $referenceCode }}" >
				  <input name="amount"        type="hidden"  value="{{ $totalPrice }}"   >
				  <input name="tax"           type="hidden"  value="0"  >
				  <input name="taxReturnBase" type="hidden"  value="0" >
				  <input name="currency"      type="hidden"  value="{{ $currency }}" >
				  <input name="signature"     type="hidden"  value="{{ $signature }}"  >
				  <input name="test"          type="hidden"  value="1" >
				  <input name="buyerEmail"    type="hidden"  value="{{ $buyerEmail }}" >
				  <input name="responseUrl"    type="hidden"  value="http://notify.pe.hu/public/api/response" >
				  <input name="confirmationUrl" type="hidden" value="http://notify.pe.hu/public/api/confirmation" >
				  <input name="Submit" class="btn btn-primary" type="submit"  value="Realizar pago" >
			</form>  -->
			
			<form method="post" action="https://sandbox.gateway.payulatam.com/ppp-web-gateway" accept-charset="UTF-8">
			  <input type="image" border="0" alt="" src="http://www.payulatam.com/img-secure-2015/boton_pagar_mediano.png" onClick="this.form.urlOrigen.value = window.location.href;"/>
			  <input name="buttonId" type="hidden" value="vO4KL61DB8UuCcnigX5SPyZo/Vh4SumspKf7pzDMmDgrlDKMt9TJBA=="/>
			  <input name="merchantId" type="hidden" value="{{ $merchantId }}"/>
			  <input name="accountId" type="hidden" value="{{ $accountId }}"/>
			  <input name="description" type="hidden" value="salestest"/>
			  <input name="referenceCode" type="hidden" value="{{ $referenceCode }}"/>
			  <input name="amount" type="hidden" value="{{ $totalPrice }}"/>
			  <input name="tax" type="hidden" value="0"/>
			  <input name="taxReturnBase" type="hidden" value="0"/>
			  <input name="shipmentValue" value="0" type="hidden"/>
			  <input name="currency" type="hidden" value="COP"/>
			  <input name="lng" type="hidden" value="es"/>
			<input name="responseUrl"    type="hidden"  value="http://notify.pe.hu/public/api/response" >
			 <!--  <input name="approvedResponseUrl" type="hidden" value="http://notify.pe.hu/public/api/response"/>
			  <input name="declinedResponseUrl" type="hidden" value="http://notify.pe.hu/public/api/response"/>
			  <input name="pendingResponseUrl" type="hidden" value="http://notify.pe.hu/public/api/response"/> -->
			  <input name="displayShippingInformation" type="hidden" value="NO"/>
			  <input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
			  <input name="buttonType" value="SIMPLE" type="hidden"/>
			  <input name="signature" value="{{ $signature }}" type="hidden"/>
			<input name="buyerEmail"    type="hidden"  value="{{ $buyerEmail }}" >
			  <input name="test"          type="hidden"  value="1" >
			</form>
			
		</div>
	</div>
</div>
@endsection