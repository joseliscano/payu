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
		@if (isset($errors) && count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li> @endforeach
				</ul>
			</div>
		@endif
		<div>
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
			  <input name="displayShippingInformation" type="hidden" value="NO"/>
			  <input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
			  <input name="buttonType" value="SIMPLE" type="hidden"/>
			  <input name="signature" value="{{ $signature }}" type="hidden"/>
			  <input name="test" type="hidden"  value="1" >
			</form>
			
		</div>
	</div>
</div>
@endsection