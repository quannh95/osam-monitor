@if($flash = session('message'))
	<div id="flash-message" class="alert alert-danger" role="alert">
	    {{ $flash }}
	</div>
@endif

@if($flash = session('success'))
	<div id="flash-message" class="alert alert-success" role="alert">
	    {{ $flash }}
	</div>
@endif