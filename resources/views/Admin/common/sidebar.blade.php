@php
    $header = DB::table('setting')->first();
@endphp

<style>
/* Temple Theme Colors - Only Color Changes, No Layout Changes */
.sidebar-wrapper {
    background: linear-gradient(135deg, #df4900 0%, #6B3A1F 100%) !important;
}

/* Menu Items Background */
.sidebar-menu li {
    transition: all 0.3s ease;
}

/* Menu Links */
.sidebar-menu li a {
    color: #FFF8F0;
    transition: all 0.3s ease;
}

/* Menu Icons Color */
.sidebar-menu li a i {
    color: #D4AF37;
    transition: all 0.3s ease;
}

/* Hover Effect - Only color change */
.sidebar-menu li a:hover {
    background: rgba(212, 175, 55, 0.15);
    color: #FFD700;
}

.sidebar-menu li a:hover i {
    color: #FFD700;
}

/* Active Menu Item */
.sidebar-menu li.active {
    background: linear-gradient(45deg, #D4AF37, #B8860B);
}

.sidebar-menu li.active a {
    color: #fff;
}

.sidebar-menu li.active a i {
    color: #fff;
}

/* Dropdown Arrow Color */
.sidebar-dropdown > a::after {
    color: #D4AF37;
}

.sidebar-dropdown > a:hover::after {
    color: #FFD700;
}

/* Submenu Background */
.sidebar-dropdown .sidebar-submenu {
    background: rgba(0, 0, 0, 0.2);
}

/* Scrollbar Color */
.sidebarMenuScroll::-webkit-scrollbar-thumb {
    background: #D4AF37;
}

.sidebarMenuScroll::-webkit-scrollbar-thumb:hover {
    background: #B8860B;
}

/* App Brand Border */
.app-brand {
    border-bottom: 2px solid #D4AF37;
}
</style>

<nav id="sidebar" class="sidebar-wrapper">

    <!-- App brand -->
    <div class="app-brand p-4">
        <a href="#">
            <img src="{{ asset($header->logo)}}" class="logo" alt="Logo" />
        </a>
    </div>

   <div class="sidebarMenuScroll">
    <ul class="sidebar-menu">

        <!-- Dashboard -->
        <li>
            <a href="{{route('Dashboard')}}">
                <i class="bi bi-speedometer2"></i>
                <span class="menu-text">Dashboard</span>
            </a>
        </li>

        

        <!-- Gallery -->
        <li>
            <a href="{{route('Gallerylist')}}">
                <i class="bi bi-image-fill"></i>
                <span class="menu-text">Gallery</span>
            </a>
        </li>

        <!-- Objective -->
        <li>
            <a href="{{route('objectives.list')}}">
                <i class="bi bi-bullseye"></i>
                <span class="menu-text">Objective</span>
            </a>
        </li>

        <!-- Banner -->
        <li>
            <a href="{{route('Banner_list')}}">
                <i class="bi bi-card-image"></i>
                <span class="menu-text">Banner</span>
            </a>
        </li>
         <li>
            <a href="{{route('Topbanner')}}">
                <i class="bi bi-card-image"></i>
                <span class="menu-text">Top banner</span>
            </a>
        </li>

        <!-- Content Management -->
        <li>
            <a href="{{route('website-content')}}">
                <i class="bi bi-file-earmark-richtext"></i>
                <span class="menu-text">Content Management</span>
            </a>
        </li>

        <!-- Events -->
        <li>
            <a href="{{route('events_list')}}">
                <i class="bi bi-calendar-event-fill"></i>
                <span class="menu-text">Events</span>
            </a>
        </li>

        <!-- Volunteers -->
        <li>
            <a href="{{route('volunteersList')}}">
                <i class="bi bi-people-fill"></i>
                <span class="menu-text">Volunteers</span>
            </a>
        </li>

        <!-- Rooms -->
        <li>
            <a href="{{route('Hotel_list')}}">
                <i class="bi bi-building-fill"></i>
                <span class="menu-text">Rooms</span>
            </a>
        </li>

        <!-- Settings -->
        <li>
            <a href="{{route('FrontEnd')}}">
                <i class="bi bi-gear-fill"></i>
                <span class="menu-text">Setting</span>
            </a>
        </li>

    </ul>
</div>

</nav>

<script>
// Simple active state detection (if needed)
document.addEventListener('DOMContentLoaded', function() {
    const currentUrl = window.location.pathname;
    const menuItems = document.querySelectorAll('.sidebar-menu li');
    
    menuItems.forEach(item => {
        const link = item.querySelector('a');
        if(link && link.getAttribute('href') !== '#' && currentUrl.includes(link.getAttribute('href'))) {
            item.classList.add('active');
        }
    });
});
</script>