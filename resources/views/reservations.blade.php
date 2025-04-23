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

<div class="row clearfix">

	<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>Reservations</h2>
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						<thead>
							<tr>
								<th>Movie</th>
								<th>Starts at</th>
								<th>Status</th>
								<th>Created at</th>
							</tr>
						</thead>
						<tbody>
							@forelse($reservations as $reservation)
							<tr>
								<td>{{$reservation->projection->movie->name}}</td>
								<td>{{$reservation->projection->start}}</td>
								<td>{{\App\ReservationType::find($reservation->reservation_type_id)->name}}</td>
								{{-- <td>{{$reservation->type->name}}</td> --}}
								<td>{{$reservation->created_at}}</td>
							</tr>
							@empty
							<tr>
								<td>No projections yet.</td>
								<td>-</td>
								<td>-</td>
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
