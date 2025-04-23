@role('employee')

<li class="header">EMPLOYEE</li>

@if(auth()->user()->employee_buildings->count() <= 4)
    @forelse(auth()->user()->employee_buildings as $building)
    <li>
        <a href="{{route('building.employee-work.show',$building)}}">
            <i class="material-icons">home</i>
            <span>{{$building->name}}</span>
        </a>
    </li>
    @empty
    <li>
        <a href="javascript:void(0);">
            <span>No buildings yet.</span>
        </a>
    </li>
    @endforelse
@else

    <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block toggled">
        <i class="material-icons">home</i>
        <span>Buildings</span>
    </a>
    <ul class="ml-menu" style="display: block;">
        <li>
            @foreach(auth()->user()->employee_buildings as $building)
            <li><a href="{{route('building.employee-work.show',$building)}}" class="waves-effect waves-block"><span>{{$building->name}}</span></a></li>
            @endforeach
        </li>
    </ul>

@endif
<hr>
<br>
@endrole