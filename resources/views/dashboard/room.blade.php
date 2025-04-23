@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('template_default/css/data_tables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('template_default/css/bootstrap-select.min.css') }}">

{{-- <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap/dist/css/bootstrap.min.css"/> --}}
{{-- <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/> --}}
@endpush

@push('js')
<script src="{{asset('template_default/js/jquery_data_tables.js')}}"></script>
<script src="{{asset('template_default/js/data_tables.bootstrap.min.js')}}"></script>
<script src="{{asset('template_default/js/bootstrap-select.min.js')}}"></script>

<script src="{{elixir('js/vue/manage_seats.js')}}"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>--}}
{{--<script>--}}
    {{--var config = {--}}
    {{--type: 'line',--}}
    {{--data: {--}}
    {{--labels: ["January", "February", "March", "April", "May", "June", "July"],--}}
    {{--datasets: [{--}}
    {{--label: "Used Reservations",--}}
    {{--data: [10, 25, 35, 27, 12, 14, 50],--}}
    {{--borderColor: 'rgba(0, 188, 212, 0.75)',--}}
    {{--backgroundColor: 'rgba(0, 188, 212, 0.3)',--}}
    {{--pointBorderColor: 'rgba(0, 188, 212, 0)',--}}
    {{--pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',--}}
    {{--pointBorderWidth: 1--}}
    {{--}, {--}}
    {{--label: "All Reservations",--}}
    {{--data: [28, 48, 40, 51, 35, 20, 90],--}}
    {{--borderColor: 'rgba(233, 30, 99, 0.75)',--}}
    {{--backgroundColor: 'rgba(233, 30, 99, 0.3)',--}}
    {{--pointBorderColor: 'rgba(233, 30, 99, 0)',--}}
    {{--pointBackgroundColor: 'rgba(233, 30, 99, 0.9)',--}}
    {{--pointBorderWidth: 1--}}
    {{--}]--}}
    {{--},--}}
    {{--options: {--}}
    {{--responsive: true,--}}
    {{--legend: false--}}
    {{--}--}}
    {{--}--}}
    {{--new Chart(document.getElementById("line_chart").getContext("2d"), config);--}}
{{--</script>--}}
@endpush

@section('content')

@component('components.modal')
{{--@component('components.modal',['building'=>$building])--}}
@slot('route')
{{route('building.room.projection.store',[$building,$currentRoom])}}
@endslot
@slot('title')
<h2>Add a projection to "{{$currentRoom->name}}" ({{$building->name}})</h2>
@endslot

<div class="form-group form-float">
    <div class="form-line">
        <input type="text" name="start" class="form-control" required>
        <label class="form-label">Start Time</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        <select name="movie_id" class="form-control show-tick">
            <option selected disabled>Pick a movie..</option>
            {{--todo: filter movies..--}}
            @forelse(\App\Movie::whereIn('id',$building->movies->pluck('id'))->get() as $movie)
            <option value="{{$movie->id}}">{{$movie->name}}</option>
            @empty
            <option>No movies yet.</option>
            @endforelse
        </select>
    </div>
</div>
@endcomponent

<div class="block-header">
    <h1>
        {{--todo fix that with normal breatcrumbs--}}
        <a href="{{route('building.show',$building)}}">{{$building->name}}</a>
        /
        {{$currentRoom->name}}
    </h1>
</div>

<div class="row clearfix">

    <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Projections</h2>
                <div class="header-dropdown m-r--5">
                    <button type="button" class="btn bg-cyan btn-block btn-xs waves-effect" data-toggle="modal" data-target="#modal">
                        ADD PROJECTION
                    </button>
                </div>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>Movie</th>
                                <th>Starts at</th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($currentRoom->projections as $projection)
                            <tr>
                                <td>{{$projection->movie->name}}</td>
                                <td>{{$projection->start}}</td>
                                <td>{{$projection->created_at}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td>No projections yet.</td>
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

    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
        <div class="card">
            <div class="header">
                {{--todo limit to 10 and add --}}
                <h2>Other rooms</h2>
            </div>
            <div class="body">
                <div class="list-group">
                    @foreach($building->rooms as $room)
                    @if($room->id == $currentRoom->id)
                    <a href="#" class="list-group-item active">
                        {{$room->name}}
                    </a>
                    @else
                    <a href="{{route('building.room.show',[$building,$room])}}" class="list-group-item">
                        {{$room->name}}
                    </a>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div id="app">
        <manage-seats building_id="{{$building->id}}" room_id="{{$currentRoom->id}}"></manage-seats>
    </div>
    @endsection
