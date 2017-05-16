@extends('welcome') @section('title', 'Mi tienda de pruebas|Cart')

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
		<div class="row">
			<div class="table-responsive col-md-9">
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
			@if($items->count() > 0)
			<form action="/public/order" method="post">
			{{ csrf_field() }}
				
				<input type="submit" class="btn btn-primary" value="Generar orden" />
			</form>
			@endif
		</div>
	</div>
</div>
@endsection