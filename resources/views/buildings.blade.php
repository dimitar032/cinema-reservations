@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('template_default/css/data_tables.bootstrap.min.css') }}">
@endpush

@push('js')
    <script src="{{asset('template_default/js/jquery_data_tables.js')}}"></script>
    <script src="{{asset('template_default/js/data_tables.bootstrap.min.js')}}"></script>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Buildings</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Rooms</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($buildings as $building)
                                    <tr>
                                        <td>{{$building->name}}</td>
                                        <td>
                                            <a href="{{route('building.room.index',$building->id)}}">Show</a>
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
                        <h2>Create a new building</h2>
                    </div>
                    <div class="body">
                        <form action="{{route('building.store')}}" class="form-horizontal" method="POST">
                            {{ csrf_field() }}
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="name" class="form-control" required
                                                   placeholder="Building name..">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="latitude">Latitude</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" name="latitude" class="form-control" required
                                                   placeholder="Latitude..">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="longitude">Longitude</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" name="longitude" class="form-control" required
                                                   placeholder="Longitude..">
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
    </div>
@endsection