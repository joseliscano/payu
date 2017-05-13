@extends('welcome') @section('title', 'Mi tienda de pruebas|home')

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
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li> @endforeach
				</ul>
			</div>
		@endif
		<div class="row">
			@foreach($products as $product)
			<div class="col-sm-4 col-lg-4 col-md-4">
				<div class="thumbnail">
					<img src="productImg/{{ $product->urlPic }}" alt="{{ $product->description }}" class="img-responsive">
					<div class="caption">
						<h4 class="pull-right">${{ $product->price }}</h4>
						<h4>
							{{ $product->description }}
						</h4>
						<form action="/public/addToCart" method="post">
							{{ csrf_field() }}
							<input type="hidden" name="product_id" value="{{ $product->id }}" />
							<input type="hidden" name="description" value="{{ $product->description }}" />
							<input type="hidden" name="price" value="{{ $product->price }}" />
							<input type="submit" class=@if($product->quantity == 0) "btn btn-primary disabled" @else "btn btn-primary" @endif value="Añadir al carrito" />
						</form>
						<div class="ratings">
							<p class="pull-right">{{ $product->quantity }} en Stock</p>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection