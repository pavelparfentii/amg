<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal  menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        <ul class="menu-inner">
            <li class="menu-item @if(request()->routeIs('admin.index')) active @endif">
                <a href="{{ route('admin.index') }}" class="menu-link" >
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div>{{ __('main.main_page') }}</div>
                </a>
            </li>
            <li class="menu-item {{ (Request::routeIs('admin.goods*')) ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle" >
                    <i class="menu-icon tf-icons bx bx-layout"></i>
                    <div>{{ __('main.goods') }}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item ">
                        <a href="{{ route('admin.goodsGroup.index') }}" class="menu-link" >
                            <i class="menu-icon tf-icons bx bx-menu"></i>
                            <div>{{ __('main.goods_group') }}</div>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="{{ route('admin.goods.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-vertical-center"></i>
                            <div>{{ __('main.goods') }}</div>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="{{ route('admin.units.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-vertical-center"></i>
                            <div>{{ __('main.units') }}</div>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="{{ route('admin.goods.income') }}" class="menu-link" >
                            <i class="menu-icon tf-icons bx bx-fullscreen"></i>
                            <div>{{ __('main.income') }}</div>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="{{ route('admin.goods.consumption') }}" class="menu-link" >
                            <i class="menu-icon tf-icons bx bx-exit-fullscreen"></i>
                            <div>{{ __('main.consumption') }}</div>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="{{ route('admin.goods.moving') }}" class="menu-link" >
                            <i class="menu-icon tf-icons bx bx-chevrons-right"></i>
                            <div>{{ __('main.moving') }}</div>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="{{ route('admin.goods.leftovers') }}" class="menu-link" >
                            <i class="menu-icon tf-icons bx bx-square-rounded"></i>
                            <div>{{ __('main.leftovers') }}</div>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="{{ route('admin.goods.calculyations') }}" class="menu-link" >
                            <i class="menu-icon tf-icons bx bx-square-rounded"></i>
                            <div>{{ __('main.calculyations') }}</div>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="{{ route('admin.goods.complectations') }}" class="menu-link" >
                            <i class="menu-icon tf-icons bx bx-square-rounded"></i>
                            <div>{{ __('main.complectations') }}</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item  {{ (Request::routeIs('admin.contragents*')) ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle" >
                    <i class="menu-icon tf-icons bx bx-customize"></i>
                    <div>{{ __('main.contragents') }}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item ">
                        <a href="{{ route('admin.providers.index') }}" class="menu-link" >
                            <i class="menu-icon tf-icons bx bx-calendar"></i>
                            <div>{{ __('main.providers') }}</div>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="{{ route('admin.receivers.index') }}" class="menu-link" >
                            <i class="menu-icon tf-icons bx bx-food-menu"></i>
                            <div>{{ __('main.receivers') }}</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item ">
                <a href="javascript:void(0);" class="menu-link menu-toggle" >
                    <i class="menu-icon tf-icons bx bxs-report"></i>
                    <div>{{ __('main.reports') }}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item ">
                        <a href="javascript:void(0)" class="menu-link" >
                            <i class="menu-icon tf-icons bx bxs-report"></i>
                            <div>{{ __('main.x_report') }}</div>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="javascript:void(0)" class="menu-link" >
                            <i class="menu-icon tf-icons bx bxs-report"></i>
                            <div>{{ __('main.z_report') }}</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item @if(request()->routeIs('admin.users.index')) active @endif">
                <a href="javascript:void(0)" class="menu-link menu-toggle" >
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div>{{ __('main.users') }}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('admin.users.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div>{{ __('main.users') }}</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.roles.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-accessibility"></i>
                            <div>{{ __('main.roles') }}</div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
