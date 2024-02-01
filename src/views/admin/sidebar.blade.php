<div>
    <div id="side_nav" class="sidebar-dark">
        <a href="{{ url('admin/dashboard') }}" class="rm-link-styles">
        <h5 class="ml mt-2">Dashboard</h5>
        </a>
        <ul>
         @if (sidebarGuard(6))
            <li class="mt-3"><a href="{{ url('admin/profile') }}">Profile</a></li>
         @endif
         @if (sidebarGuard(9))
            <li class="mt"><a href="{{ url('admin/users') }}">Users</a></li>
         @endif
         @if (sidebarGuard(5))
            <li class="mt"><a href="{{ url('admin/permissions') }}">Permissions</a></li>
         @endif
         @if (sidebarGuard(13))
            <li class="mt"><a href="{{ url('admin/fields') }}">Fields</a></li>
         @endif
         @if (sidebarGuard(14))
            <li class="mt"><a href="{{ url('admin/section') }}">Sections</a></li>
         @endif
         @if (sidebarGuard(15))
            <li class="mt"><a href="{{ url('admin/entry') }}">Entries</a></li>
         @endif
         @if (sidebarGuard(17))
            <li class="mt"><a href="{{ url('admin/assets') }}">Assets</a></li>
         @endif
         @if (sidebarGuard(10))
            <li class="mt"><a href="{{ url('admin/database') }}">Database</a></li>
         @endif
         @if (sidebarGuard(3))
            <li class="mt"><a href="{{ url('admin/email') }}">Email</a></li>
         @endif
         @if (sidebarGuard(18))
            <li class="mt"><a href="{{ url('admin/settings') }}">Site settings</a></li>
         @endif
            <li class="mt inline">
               <form action="{{ url('logout') }} " method="POST">
                  @csrf
                  <button type="submit" class="rm-btn-styles ">Logout</button>
               </form>
            </li>
        </ul>
    </div>
    
    
</div>
