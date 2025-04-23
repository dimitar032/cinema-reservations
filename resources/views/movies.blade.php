@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('template_default/css/data_tables.bootstrap.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('template_default/css/bootstrap-select.min.css') }}"> --}}

{{-- <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap/dist/css/bootstrap.min.css"/> --}}
{{-- <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/> --}}
@endpush

@push('js')
<script src="{{asset('template_default/js/jquery_data_tables.js')}}"></script>
<script src="{{asset('template_default/js/data_tables.bootstrap.min.js')}}"></script>
{{-- <script src="{{asset('template_default/js/bootstrap-select.min.js')}}"></script> --}}
@endpush

@section('content')

@component('components.modal')
{{--@component('components.modal',['building'=>$building])--}}
	@slot('route')
		{{route('movie.store')}}
	@endslot
	@slot('title')
		<h2>Add a new movie</h2>
	@endslot

	<div class="form-group form-float">
	    <div class="form-line">
	        <input type="text" name="name" class="form-control" required>
	        <label class="form-label">Name</label>
	    </div>
	</div>

	<div class="form-group form-float">
	    <div class="form-line">
	        <input type="text" name="description" class="form-control" required>
	        <label class="form-label">Description</label>
	    </div>
	</div>


	<div class="form-group form-float">
	    <div class="form-line">
	        <input type="text" name="premiere_date" class="form-control" required>
	        <label class="form-label">Premiere date</label>
	    </div>
	</div>

	<div class="form-group form-float">
	    <div class="form-line">
	        <input type="number" name="duration_in_minutes" class="form-control" required>
	        <label class="form-label">Duration (minutes)</label>
	    </div>
	</div>
	poster?
@endcomponent


<div class="row clearfix">

	<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>Movies management</h2>
				    <div class="header-dropdown m-r--5">
                    <button type="button" class="btn bg-cyan btn-block btn-xs waves-effect" data-toggle="modal" data-target="#modal">
                        ADD MOVIE
                    </button>
                </div>
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						<thead>
							<tr>
								<th>Name</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							@forelse($movies as $movie)
								<tr>
									<td>{{$movie->name}}</td>
									<td>
										<form action="{{route('movie.destroy', $movie)}}" method="POST">
										    <input type="hidden" name="_method" value="DELETE">
                    						{{ csrf_field() }}
											<input type="submit" value="Remove">
										</form>
									</td>
								</tr>
							@empty
								<tr>
									<td>No movies yet.</td>
									<td>-</td>
								</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	@endsection
