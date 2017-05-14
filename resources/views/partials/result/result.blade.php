@extends('welcome') @section('title', 'Mi tienda de pruebas|Result')

@section('content')
<div class="row">
	@include('partials.lateralbar')
	<div class="col-md-9">
		<h3>Resultado de la transacción</h3>
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
		<div class="row">
			@if($response['lapTransactionState'] == 'APPROVED')
				<div class="alert alert-success alert-important" role="alert">Felicidades! tu transacción ha sido aprobada!</div>
				<table class="table table-hover">
				@foreach($response as $key => $value)
				<tr>
					<th>{{ $key }}</th>
					<td>{{ $value }}</td>
				</tr>
				@endforeach
			</table>
			@endif
			@if($response['lapTransactionState'] == 'REJECTED')
				<div class="alert alert-danger alert-important" role="alert">Oops! algo salió mal, por favor intenta el pago nuevamente.</div>
				<a class="btn btn-warning" href="/public/showOrders">Intentar pago nuevamente</a>
			@endif
			<a class="btn btn-primary" href="/public">Volver a la página principal</a>
		</div>
	</div>
</div>
@endsection