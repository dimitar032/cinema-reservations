<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{route('movie-projection-app')}}"><strong>LARA</strong>CINEMA</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">

            <ul class="nav navbar-nav navbar-right">
                @if(!auth()->check())
                <li>
                    <a href="{{route('login')}}" class="js-search" data-close="true">LOGIN</a>
                </li>
                @endif
            </ul>   
        </div>
    </div>
</nav>      