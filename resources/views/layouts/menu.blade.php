<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <img style="width: 50px;" src="{{ asset('images/menu.png') }}" alt="">
            <span class="demo menu-text fw-bolder ms-2" style="font-size: 20px;">HR Panel</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('admin') ? 'active' : '' }}">
            <a href="/" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-dashboard'></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        {{-- Company Setting  --}}
        @can('company_access')
            <li class="menu-item {{ request()->is('admin/company-settings/*') ? 'active' : '' }}">
                <a href="{{ route('admin.company-settings.show', 1) }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bxs-buildings'></i>
                    <div data-i18n="Analytics">{{ __('messages.company_setting.title') }}</div>
                </a>
            </li>
        @endcan

        <!-- Layouts -->
        @can('user_management_access')
            <li
                class="menu-item {{ request()->is('admin/users') || request()->is('admin/users/*') || request()->is('admin/roles') || request()->is('admin/roles/*') || request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon tf-icons bx bxs-user-circle'></i>
                    <div data-i18n="Layouts">User Management</div>
                </a>

                <ul class="menu-sub">
                    @can('permission_access')
                        <li
                            class="menu-item {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active open' : '' }}">
                            <a href="{{ route('admin.permissions.index') }}" class="menu-link">
                                <div data-i18n="Without menu">Permission</div>
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li
                            class="menu-item {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active open' : '' }}">
                            <a href="{{ route('admin.roles.index') }}" class="menu-link">
                                <div data-i18n="Without menu">Roles</div>
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li
                            class="menu-item {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active open' : '' }}">
                            <a href="{{ route('admin.users.index') }}" class="menu-link">
                                <div data-i18n="Without menu">{{ __('messages.employee.title') }}</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Office</span>
        </li>

        {{-- Office  --}}
        @can('office_management')
            <li
                class="menu-item {{ request()->is('admin/departments') || request()->is('admin/departments/*') || request()->is('admin/positions') || request()->is('admin/positions/*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon tf-icons bx bxl-codepen'></i>
                    <div data-i18n="Account Settings">Office Management</div>
                </a>
                <ul class="menu-sub">
                    @can('position_access')
                        <li
                            class="menu-item {{ request()->is('admin/positions') || request()->is('admin/positions/*') ? 'active open' : '' }}">
                            <a href="{{ route('admin.positions.index') }}" class="menu-link">
                                <div data-i18n="Notifications">{{ __('messages.position.title') }}</div>
                            </a>
                        </li>
                    @endcan
                    @can('department_access')
                        <li
                            class="menu-item {{ request()->is('admin/departments') || request()->is('admin/departments/*') ? 'active open' : '' }}">
                            <a href="{{ route('admin.departments.index') }}" class="menu-link">
                                <div data-i18n="Account">{{ __('messages.department.title') }}</div>
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>
        @endcan

    </ul>
</aside>
