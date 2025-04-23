@if(auth()->check())
{{-- <li class="header">USER</li> --}}
<li>
    <a href="{{route('reservations')}}">
        <i class="material-icons">assignment_turned_in</i>
        <span>Reservations</span>
    </a>
    <a href="{{route('movie-projection-app')}}"> 
        <i class="material-icons">movie</i>
        <span>Programs</span>
    </a>
    <a href="{{route('profile.show')}}">
        <i class="material-icons">person</i>
        <span>Profile</span>
    </a>
    
    <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="material-icons">reply</i>
        <span>Logout</span>
    </a>
    <form action="/logout" class="form-horizontal" method="POST" id="logout-form">{{ csrf_field() }}</form>
</li>
{{--<li>--}}
    {{--<a href="javascript:void(0);" class="menu-toggle">--}}
        {{--<i class="material-icons">home</i>--}}
        {{--<span>{{$building->name}}</span>--}}
    {{--</a>--}}
    {{--<ul class="ml-menu">--}}
        {{--<li>--}}
            {{--<a href="{{route('building.room.index',$building->id)}}">--}}
                {{--<span>Dashboard</span>--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a href="{{route('building.room.index',$building->id)}}">--}}
                {{--<span>Rooms</span>--}}
            {{--</a>--}}
        {{--</li>--}}
    {{--</ul>--}}
{{--</li>--}}
@endif