@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('template_default/css/bootstrap-select.min.css') }}">

<style>
.grid { 
	display: grid;
	grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
	grid-gap: 20px;
	align-items: stretch;
}
.grid img {
	border: 1px solid #ccc;
	box-shadow: 2px 2px 6px 0px  rgba(0,0,0,0.3);
	max-width: 100%;
	opacity: 0.3;
}
.grid img:hover {
	cursor: pointer;
	opacity: 1;
}
</style>
@endpush

@push('js')
	
{{-- todo fixme --}}
<script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
<script src="{{asset('template_default/js/bootstrap-select.min.js')}}"></script>
<script src="{{elixir('js/vue/movie_projections.js')}}"></script>

@endpush

@section('content')

<div id="app">
	<movie-projections building_id="{{$building->id}}"></movie-projections>
</div>

@endsection
