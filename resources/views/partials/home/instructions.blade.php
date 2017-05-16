@extends('welcome') @section('title', 'Mi tienda de pruebas|Instrucciones')

@section('content')
<div class="row">
	@include('partials.lateralbar')
	<div class="col-md-9">
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
		@if($flash = session('notAvailable'))
			<div class="alert alert-danger alert-dismissible fade in"
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
		<div class="row">
			<div class="col-sm-4 col-lg-4 col-md-4">
				<h4>Instrucciones</h4>
				<ol>
					<li>En la página home, añadir cuantos productos queramos al carrito.</li>
					<li>En la página, mostrar carrito debemos generar la orden.</li>
					<li>En la página Listar ordenes, podemos cancelar la orden, y los productos serán reembolsados.</li>
					<li>Si le damos en pagar con PayU, nos redirigirá a la página de pagos de PayU.</li>
					<li>Cuando se rediriga a la tienda luego del pago, muestra el resultado de la operación.</li>
					<li>Cuando llegue la confirmación se actualiza el estado.</li>
					<li>Si el estado es diferente a pending, success o rejected, los productos serán reembolsados a la lista del home.</li>
					<li>Al llegar la confirmación, se genera un archivo que se puede consultar en el link Archivos de confirmación.</li>
				</ol>
			</div>
		</div>
	</div>
</div>
@endsection