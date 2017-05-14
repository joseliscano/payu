@extends('welcome') @section('title', 'Mi tienda de pruebas|Files')

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
			<ul>
			@foreach($files as $file)
				<li><a href="/public/files/{{ $file }}">{{ $file }}</a></li><br />
			@endforeach
			</ul>
		</div>
	</div>
</div>
@endsection