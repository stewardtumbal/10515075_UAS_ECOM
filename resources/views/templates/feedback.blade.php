@if(session('success'))
	<div class="alert alert-success fade in">
		<button type="button" class="close pull-right" data-dismiss="alert" aria-label="close">
			<span aria-hidden="true">&times;</span>
		</button>
		{!! session('success') !!}
	</div>
@endif

@if(session('error'))
	<div class="alert alert-danger fade in">
		<button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		{!! session('error') !!}
	</div>
@endif

@if (count($errors) > 0)
	<div class="alert alert-danger fade in">
		<button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<p>Perhatian.</p>
		<ul>
			@foreach ($errors->all () as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif