@extends('layouts.app')

@push('css')
<style>
.mouse-pointer:hover {
    cursor: pointer;
}
</style>
@endpush

@push('js')
<script src="{{asset('template_default/js/chart.js')}}"></script>
<script>
   $.ajax({
    url: "/api/building/" + {{$building->id}} + "/latest-reservations-count"
}).done(function (data) {
   var labelz = new Array();
   var count_of_all_reservations_per_day = new Array();
   var count_of_all_used_reservations_per_day = new Array();
   $.each(data, function (key, obj) {
    labelz.push(obj.selected_date);
    count_of_all_reservations_per_day.push(obj.count_of_all_reservations_per_day);
    count_of_all_used_reservations_per_day.push(obj.count_of_all_used_reservations_per_day);
});
   var config = {
    type: 'line',
    data: {
        labels: labelz,
        datasets: [{
            label: "Used Reservations",
            data: count_of_all_used_reservations_per_day,
            borderColor: 'rgba(0, 188, 212, 0.75)',
            backgroundColor: 'rgba(0, 188, 212, 0.3)',
            pointBorderColor: 'rgba(0, 188, 212, 0)',
            pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
            pointBorderWidth: 1
        }, {
            label: "All Reservations",
            data: count_of_all_reservations_per_day,
            borderColor: 'rgba(233, 30, 99, 0.75)',
            backgroundColor: 'rgba(233, 30, 99, 0.3)',
            pointBorderColor: 'rgba(233, 30, 99, 0)',
            pointBackgroundColor: 'rgba(233, 30, 99, 0.9)',
            pointBorderWidth: 1
        }]
    },
    options: {
        responsive: true,
        legend: false
    }
}
new Chart(document.getElementById("line_chart").getContext("2d"), config);
});

</script>
@endpush

@section('content')

@component('components.modal',['building'=>$building])
@slot('route')
{{route('building.room.store',$building)}}
@endslot
@slot('title')
<h2>Create a new room to <strong>{{$building->name}}</strong></h2>
@endslot

<div class="form-group form-float">
    <div class="form-line">
        <input type="text" name="name" class="form-control" required>
        <label class="form-label">Name</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        <input type="number" name="row" class="form-control" required>
        <label class="form-label">Rows count</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        <input type="number" name="col" class="form-control" required>
        <label class="form-label">Cols count</label>
    </div>
</div>
@endcomponent

<div class="block-header">
    <h1>{{$building->name}}</h1>
</div>

<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="#">
            <div class="info-box-3 bg-pink hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">movie</i>
                </div>
                <div class="content">
                    <div class="text">MOVIES</div>
                    <div class="number">{{$building->movies->count()}}</div>
                </div>
            </div>
        </a>

    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-3 bg-blue hover-zoom-effect">
            <div class="icon">
                <i class="material-icons">assignment_turned_in</i>
            </div>
            <div class="content">
                <div class="text">RESERVATIONS</div>
                <div class="number">{{$building->reservations()->count()}}</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="{{route('building.employee.index',$building)}}">
            <div class="info-box-3 bg-light-blue hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">people</i>
                </div>
                <div class="content">
                    <div class="text">EMPLOYEES</div>
                    <div class="number">{{$building->employees()->count()}}</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-3 bg-cyan hover-zoom-effect">
            <div class="icon">
                <i class="material-icons">room</i>
            </div>
            <div class="content">
                <div class="text">ROOMS</div>
                <div class="number">{{$building->rooms->count()}}</div>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Reservations last 30 days</h2>
            </div>
            <div class="body">
                <canvas id="line_chart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="body bg-blue-grey">
                <div class="font-bold m-b--35">Top movies last 30 days</div>
                <ul class="dashboard-stat-list">
                    {{--todo fix this and orderBy views--}}
                    @forelse($building->getBuildingMovieReservations() as $movie)
                    <li>
                        {{$movie->movie_name}}
                        <span class="pull-right"><b>{{$movie->reservation_per_movie}}</b> reservations</span>
                    </li>
                    @empty
                    NO moives yet add?
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="block-header">
    <h2>ROOMS</h2>
</div>
<div class="row clearfix">
    @foreach($building->rooms as $room)
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
        <div class="card">
            {{--todo fix css styling here hovering remove underline etc..--}}
            <a href="{{route('building.room.show',[$building,$room])}}">
                <div class="body text-center">
                    <h4>Room {{$room->name}}</h4>
                </div>
            </a>
        </div>
    </div>
    @endforeach

    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
        <div class="card bg-cyan mouse-pointer" data-toggle="modal" data-target="#modal">
            <div class="body text-center">
                <h4 style="color:white;">Add room..</h4>
            </div>
        </div>
    </div>
</div>
@endsection
