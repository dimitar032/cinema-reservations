@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('template_default/css/data_tables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_default/css/bootstrap-select.min.css') }}">
@endpush

@push('js')
    <script src="{{asset('template_default/js/jquery_data_tables.js')}}"></script>
    <script src="{{asset('template_default/js/data_tables.bootstrap.min.js')}}"></script>
    <script src="{{asset('template_default/js/bootstrap-select.min.js')}}"></script>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Rooms in <strong>{{$building->name}}</strong></h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Seats</th>
                                    <th>Projections</th>
                                    {{-- <th>Created at</th> --}}
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($rooms as $room)
                                    <tr>
                                        <td>{{$room->name}}</td>
                                        <td>
                                            <a href="{{route('building.room.seat.index',[$building,$room])}}">Show</a>
                                        </td>
                                        <td>
                                            <a href="{{route('building.room.projection.index',[$building,$room])}}">Show</a>
                                        </td>
                                        {{-- <td>{{$room->created_at->diffForHumans()}}</td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No results yet.</td>
                                        <td>-</td>
                                        <td>-</td>
                                        {{-- <td>-</td> --}}
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Create a new room to <strong>{{$building->name}}</strong></h2>
                    </div>
                    <div class="body">
                        <form action="{{route('building.room.store',$building)}}" class="form-horizontal" method="POST">
                            {{ csrf_field() }}
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="name" class="form-control" required
                                                   placeholder="Room name..">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="row">Rows count</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="row" class="form-control" required
                                                   placeholder="Row count..">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="col">Cols count</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="col" class="form-control" required
                                                   placeholder="Col count..">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                    <button type="submit" class="btn btn-success m-t-15 waves-effect">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Movies in <strong>{{$building->name}}</strong></h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($building->movies as $movie)
                                    <tr>
                                        <td>{{$movie->name}}</td>
                                        <td>
                                            <form action="{{route('building.movie.destroy',[$building,$movie])}}"
                                                  class="form-inline" method="POST"
                                                  onsubmit="return confirm('Are you sure?')">
                                                <input type="hidden" name="_method" value="DELETE"/>
                                                {{ csrf_field() }}

                                                <button type="submit" class="btn btn-danger btn-sm m-t-15 waves-effect">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No results yet.</td>
                                        <td>-</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Add movie to <strong>{{$building->name}}</strong></h2>
                    </div>
                    <div class="body">
                        <form action="{{route('building.movie.store',$building)}}" class="form-horizontal" method="POST">
                            {{ csrf_field() }}
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select name="movie_id" class="form-control show-tick">
                                                {{--todo: filter movies..--}}
                                                @forelse(\App\Movie::whereNotIn('id',$building->movies->pluck('id'))->get() as $movie)
                                                    <option value="{{$movie->id}}">{{$movie->name}}</option>
                                                @empty
                                                    <option>No movies yet.</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                    <button type="submit" class="btn btn-success m-t-15 waves-effect">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection