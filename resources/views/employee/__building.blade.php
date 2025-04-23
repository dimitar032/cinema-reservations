@extends('layouts.app')

@push('css')
<style>
.grid { 
	display: grid;
	grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
	grid-gap: 20px;
	align-items: stretch;
}
.grid img {
	box-shadow: 2px 2px 6px 0px  rgba(0,0,0,0.5);
	border: 1px solid #ccc;
}
.grid img ,.grid span {
	max-width: 100%;
	opacity: 0.5;
}
.grid span {
	/*//remove me at the end*/
	box-shadow: 2px 2px 6px 0px  rgba(0,0,0,0.5);
	background-color: #e9e9e9;
	padding-top:102px;
	text-align: center;
	font-size: 56px; 
	color: black; 
}
.grid img:hover {
	cursor: pointer;
	opacity: 1;
}

.input-group-addon{
	padding: 0 3px 0 0;
}
.input-group-addon .material-icons{
	font-size: 28px;
}
.padding10topbot{
	padding: 10px 0;
	border-top: 2px solid white !important;

}
</style>
@endpush

@push('js')
<script src="{{asset('template_default/js/tooltips-popovers.js')}}"></script>
@endpush

@section('content')
<h1>{{$building->name}}</h1>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<h2>Find reservation..</h2>
	<div class="block-header">
		<div class="input-group">
			{{-- todo later drop down with twitter search --}}
			<button type="button" class="btn btn-primary waves-effect" style="width: 5%;">FIND</button>
			<input type="" name="" class="show-tick" style="width: 92%;">	
		</div>
	</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<h2>Direct sell</h2>
	<main class="grid">
		<span>14:00</span>
		<img src="http://local.cinema_project/storage/movie_posters/movie_1.jpg" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cinderella - 14:00">
		<img src="http://local.cinema_project/storage/movie_posters/movie_2.jpg">
		<img src="http://local.cinema_project/storage/movie_posters/movie_2.jpg">
		<img src="http://local.cinema_project/storage/movie_posters/movie_3.jpg">
		<img src="http://local.cinema_project/storage/movie_posters/movie_4.jpg">
		<img src="http://local.cinema_project/storage/movie_posters/movie_4.jpg">
		<img src="http://local.cinema_project/storage/movie_posters/movie_4.jpg">
		<img src="http://local.cinema_project/storage/movie_posters/movie_4.jpg">
		<img src="http://local.cinema_project/storage/movie_posters/movie_4.jpg">
	</main>
	<hr class="padding10topbot">
	<main class="grid">
		<span>15:00</span>
		<img src="http://local.cinema_project/storage/movie_posters/movie_1.jpg" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cinderella - 15:05">
		<img src="http://local.cinema_project/storage/movie_posters/movie_2.jpg">
		<img src="http://local.cinema_project/storage/movie_posters/movie_3.jpg">
		<img src="http://local.cinema_project/storage/movie_posters/movie_4.jpg">
	</main>
	<hr class="padding10topbot">
	<main class="grid">
		<span>16:00</span>
		<img src="http://local.cinema_project/storage/movie_posters/movie_1.jpg">
		<img src="http://local.cinema_project/storage/movie_posters/movie_2.jpg">
		<img src="http://local.cinema_project/storage/movie_posters/movie_3.jpg">
		<img src="http://local.cinema_project/storage/movie_posters/movie_4.jpg">
	</main>
</div>


@endsection