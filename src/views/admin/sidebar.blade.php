<div>
    <div id="side_nav" class="sidebar-dark">
        <a href="{{ url('admin/dashboard') }}" class="rm-link-styles">
        <h5 class="m-l m-t-2 text-white">Dashboard</h5>
        </a>
        <ul>
            <li class="m-t-3"><a href="{{ url('admin/profile') }}">Profile</a></li>
            <li class="m-t"><a href="{{ url('admin/users') }}">Users</a></li>
            <li class="m-t"><a href="{{ url('admin/permissions') }}">Permissions</a></li>
            <li class="m-t"><a href="{{ url('admin/fields') }}">Fields</a></li>
            <li class="m-t"><a href="{{ url('admin/section') }}">Sections</a></li>
            <li class="m-t"><a href="{{ url('admin/entry') }}">Entries</a></li>
            <li class="m-t"><a href="{{ url('admin/assets') }}">Assets</a></li>
            <li class="m-t"><a href="{{ url('admin/database') }}">Database</a></li>
            <li class="m-t">
               <form action="{{ url('logout') }} " method="POST">
                  @csrf
                  <button type="submit" class="rm-btn-styles sidebar-logout">Logout</button>
               </form>
            </li>
        </ul>
    </div>
    <div class="sidebar-fixed-dark fade-in" :style={display:styles} id="sidebar-fixed" @click.stop>
        <a href="#">
        </a>
        <h5 class="m-l m-t-2">Dashboard</h5>
        <ul>
            <li class="m-t-3"><a href="{{ url('admin/profile') }}">Profile</a></li>
            <li class="m-t"><a href="{{ url('admin/users') }}">Users</a></li>
            <li class="m-t"><a href="{{ url('admin/permissions') }}">Permissions</a></li>
            <li class="m-t"><a href="{{ url('admin/fields') }}">Fields</a></li>
            <li class="m-t"><a href="{{ url('admin/section') }}">Sections</a></li>
            <li class="m-t"><a href="{{ url('admin/entry') }}">Entries</a></li>
            <li class="m-t"><a href="{{ url('admin/assets') }}">Assets</a></li>
            <li class="m-t"><a href="{{ url('admin/database') }}">Database</a></li>
            <li class="m-t">
                <form action="{{ url('logout') }} " method="POST">
                   @csrf
                  <button type="submit" class="rm-btn-styles sidebar-logout">Logout</button>
                </form>
            </li>
        </ul>
    </div>
    <div class="search-container">
        <div @click="toggle_sidemenu" v-click-outside="away" class="sidebar-toggle hand drop-shadow br">
            <i data-feather="menu"></i>
        </div>

    </div>
</div>
