<section>
    <!-- Left Sidebar -->
    @if(auth()->check())
    <aside id="leftsidebar" class="sidebar">
    @else
    <aside id="leftsidebar" class="sidebar" style="display:none;">
    @endif
        <!-- User Info -->
        <div class="user-info">
            {{-- <div class="image">
                <img src="{{asset('template_default/images/user.png')}}" width="48" height="48" alt="User"/>
            </div> --}}
            <div style="margin:48px;"></div>
            <div class="info-container">
                @if(auth()->check())
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{auth()->user()->name}}</div>
                    <div class="email">{{auth()->user()->email}}</div>
                @endif()
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                @include('layouts.partials.manager_menu')
                @include('layouts.partials.employee_menu')
                @include('layouts.partials.normal_user_menu')
                <li class="active">
                </li>
            </ul>
        </div>
        <!-- #Menu -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>