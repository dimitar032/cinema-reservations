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
	
{{-- todo fixme --}}
<script src="{{elixir('js/vue/employee_projections.js')}}"></script>
<script src="{{asset('template_default/js/tooltips-popovers.js')}}"></script>

@endpush

@section('content')

<div id="app">
	<employee-projections building_name="{{$building->name}}" building_id="{{$building->id}}"></employee-projections>
</div>

@endsection
