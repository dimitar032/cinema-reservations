@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            BASIC TABLES
                            <small>Basic example without any additional modification classes</small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table">
                                <tbody>
                                @for($i=0;$i<6;$i++)
                                    <tr style="border-top:0">
                                        @foreach($room->seats->where('row',$i) as $seat)
                                            @if($seat->reservable)
                                                <td>
                                                    <button style="padding-top:8px;padding-bottom:8px;"
                                                            class="btn bg-green btn-lg btn-block waves-effect"
                                                            type="button">
                                                        <div class="demo-google-material-icon"><i
                                                                    class="material-icons">event_seat</i>
                                                            <span class="icon-name"></span></div>
                                                    </button>
                                                </td>
                                            @else
                                                <td>
                                                    <button style="padding-top:8px;padding-bottom:8px;"
                                                            class="btn bg-blue-grey btn-lg btn-block waves-effect"
                                                            type="button">
                                                        <div class="demo-google-material-icon"><i
                                                                    class="material-icons">view_week</i>
                                                            <span class="icon-name"></span></div>
                                                    </button>
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <button class="btn bg-cyan btn-lg btn-block waves-effect" type="button">

                                <div class="demo-google-material-icon">
                                    <i class="material-icons">airplay</i>
                                    <span class="icon-name"></span>
                                    <span class="badge">S C R E E N</span>
                                    <i class="material-icons">airplay</i>
                                    <span class="icon-name"></span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Table -->
    </div>

@endsection
