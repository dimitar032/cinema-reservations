@role('manager')
<li class="header">MANAGER</li>

@if(auth()->user()->buildings->count() <= 4)
@forelse(auth()->user()->buildings as $building)
<li>
    <a href="{{route('building.show',$building)}}">
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
        @foreach(auth()->user()->buildings as $building)
        <li><a href="{{route('building.show',$building)}}" class="waves-effect waves-block"><span>{{$building->name}}</span></a></li>
        @endforeach
    </li>
</ul>

@endif
<li>
    <a href="{{route('movie.index')}}" class="waves-effect waves-block">
        <i class="material-icons">theaters</i>
        <span>Movies</span>
    </a>
</li>
<hr>
<br>
@endrole