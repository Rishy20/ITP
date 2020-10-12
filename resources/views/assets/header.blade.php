@livewireStyles
<header>
    <div class="header">
            <div class="header-content">
                <div class="header-store">Leatherline</div>
                <div class="header-time"><livewire:time/></div>
                <div class="header-user" data-toggle="dropdown">
                    <i class="fas fa-user-circle header-icon"></i> {{Auth::user()->display_name}}

                        <ul class="dropdown-menu header-logout">
                        <li onclick="window.location='{{route("admin.logout")}}';">Logout</li></a>
                        </ul>


                </div>

            </div>
    </div>
</header>
@livewireScripts
@stack('scripts')
