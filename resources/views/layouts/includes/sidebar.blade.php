<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{request()->routeIs('arsip.index') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('arsip.index')}}">
            <i class="icon-star menu-icon"></i>
            <span class="menu-title">Arsip</span>
        </a>
        </li>
        <li class="nav-item {{request()->routeIs('about') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('arsip.index')}}">
            <i class="mdi mdi-alert-outline"></i>
            <span class="menu-title ml-3">About</span>
        </a>
        </li>
    </ul>
</nav>