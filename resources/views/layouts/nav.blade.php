<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- ! Hide app brand if navbar-full -->
    <div class="app-brand demo">
        <a href="{{ route('site.index') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="{{ asset('images/dosolution-logo.png') }}">
      </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <li class="menu-item @if(request()->routeIs('site.index')) active @endif">
            <a href="{{ route('site.index') }}" class="menu-link" >
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div class="text-truncate">Календар</div>
            </a>
        </li>
        @if(Auth::user()->cabinets->first())
            <li class="menu-item @if(request()->routeIs('site.likar_calendar')) active @endif">
                <a href="{{ route('site.likar_calendar') }}" class="menu-link" >
                    <i class="menu-icon tf-icons bx bx-calendar"></i>
                    <div class="text-truncate">Календар прийому</div>
                </a>
            </li>
        @endif
        <li class="menu-item @if(request()->routeIs('visitors.index')) active @endif">
            <a href="{{ route('visitors.index') }}" class="menu-link" >
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div class="text-truncate">Пацієнти</div>
            </a>
        </li>

        <li class="menu-item @if(request()->routeIs('services.*')) open @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle" >
                <i class="menu-icon tf-icons bx bx-cart-alt"></i>
                <div class="text-truncate">Послуги</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if(request()->routeIs('services.groups')) active @endif">
                    <a href="{{ route('services.groups') }}" class="menu-link" >
                        <div>Групи послуг</div>
                    </a>
                </li>
                <li class="menu-item @if(request()->routeIs('services.index')) active @endif">
                    <a href="{{ route('services.index') }}" class="menu-link" >
                        <div>Послуги</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item @if(request()->routeIs('promo.*')) open @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle" >
                <i class="menu-icon tf-icons bx bx-star"></i>
                <div class="text-truncate">Промо-акції</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if(request()->routeIs('promo.index')) active @endif">
                    <a href="{{ route('promo.index') }}" class="menu-link" >
                        <div>Промо</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item @if(request()->routeIs('reports.*')) open @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle" >
                <i class="menu-icon tf-icons bx bx-book-open"></i>
                <div class="text-truncate">Звіти*</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if(request()->routeIs('reports.services_period')) active @endif">
                    <a href="{{ route('reports.services_period') }}" class="menu-link" >
                        <div>Звіт по послугам за період</div>
                    </a>
                </li>
                <li class="menu-item @if(request()->routeIs('reports.pay_period')) active @endif">
                    <a href="{{ route('reports.pay_period') }}" class="menu-link" >
                        <div>Звіт по оплатам за період</div>
                    </a>
                </li>
                <li class="menu-item @if(request()->routeIs('reports.doctor_period')) active @endif">
                    <a href="{{ route('reports.doctor_period') }}" class="menu-link" >
                        <div>Звіт по лікарям</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item @if(request()->routeIs('items.*')) open @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle" >
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div class="text-truncate">ТМЦ</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if(request()->routeIs('contragents.group_index')) active @endif">
                    <a href="{{ route('contragents.group_index') }}" class="menu-link" >
                        <div>Групи контрагентів</div>
                    </a>
                </li>
                <li class="menu-item @if(request()->routeIs('contragents.index')) active @endif">
                    <a href="{{ route('contragents.index') }}" class="menu-link" >
                        <div>Контрагенти</div>
                    </a>
                </li>
                <li class="menu-item @if(request()->routeIs('items.group_index')) active @endif">
                    <a href="{{ route('items.group_index') }}" class="menu-link" >
                        <div>Групи ТМЦ</div>
                    </a>
                </li>
                <li class="menu-item @if(request()->routeIs('items.index')) active @endif">
                    <a href="{{ route('items.index') }}" class="menu-link" >
                        <div>ТМЦ</div>
                    </a>
                </li>
                <li class="menu-item @if(request()->routeIs('items.orders_index')) active @endif">
                    <a href="{{ route('items.orders_index') }}" class="menu-link menu-toggle" >
                        <div>Накладні</div>
                    </a>
                </li>
                <li class="menu-item @if(request()->routeIs('items.leftovers')) active @endif">
                    <a href="{{ route('items.leftovers') }}" class="menu-link menu-toggle" >
                        <div>Залишки</div>
                    </a>
                </li>

                <li class="menu-item @if(request()->routeIs('items.pivot')) active @endif">
                    <a href="{{ route('items.pivot') }}" class="menu-link menu-toggle" >
                        <div>Зведена таблиця</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item @if(request()->routeIs('calculyations.index')) active @endif">
            <a href="{{ route('calculyations.index') }}" class="menu-link" >
                <i class="menu-icon tf-icons bx bx-window-open"></i>
                <div class="text-truncate">Калькуляції</div>
            </a>
        </li>
        <li class="menu-item @if(request()->routeIs('users*.*')) open @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle" >
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div class="text-truncate">Користувачі</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if(request()->routeIs('users_role.index')) active @endif">
                    <a href="{{ route('users_role.index') }}" class="menu-link" >
                        <div>Групи користувачів</div>
                    </a>
                </li>
                <li class="menu-item @if(request()->routeIs('users.index')) active @endif">
                    <a href="{{ route('users.index') }}" class="menu-link" >
                        <div>Користувачі</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item @if(request()->routeIs('settings.*')) open @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle" >
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div class="text-truncate">Налаштування</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if(request()->routeIs('settings.times')) active @endif">
                    <a href="{{ route('settings.times') }}" class="menu-link" >
                        <div>Часові інтервали</div>
                    </a>
                </li>
                <li class="menu-item @if(request()->routeIs('settings.pages')) active @endif">
                    <a href="{{ route('settings.pages') }}" class="menu-link" >
                        <div>Сторінки</div>
                    </a>
                </li>
                <li class="menu-item @if(request()->routeIs('settings.likars')) active @endif">
                    <a href="{{ route('settings.likars') }}" class="menu-link" >
                        <div>Лікарі</div>
                    </a>
                </li>
                <li class="menu-item @if(request()->routeIs('settings.specialists')) active @endif">
                    <a href="{{ route('settings.specialists') }}" class="menu-link" >
                        <div>Спеціальності</div>
                    </a>
                </li>
                <li class="menu-item @if(request()->routeIs('settings.cabinets')) active @endif">
                    <a href="{{ route('settings.cabinets') }}" class="menu-link" >
                        <div>Кабінети</div>
                    </a>
                </li>
                <li class="menu-item @if(request()->routeIs('settings.forms')) active @endif">
                    <a href="{{ route('settings.forms') }}" class="menu-link" >
                        <div>Друковані форми</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
<div class="layout-page">

    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar" style="margin-top: 20px; margin-bottom: 20px;">

        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0  d-xl-none ">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div style="margin-bottom: 6px;">Дата календаря: <input type="date" class="form-control" placeholder="ДД.ММ.РРРР" id="flatpickr-date" value="@if(Session::get('date')){{ Session::get('date') }}@else{{date("Y-m-d", time())}}@endif" /></div>


        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

            <!-- Search -->
            <div class="navbar-nav align-items-center">
                <div class="nav-item navbar-search-wrapper mb-0">

                </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">

                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="{{ asset('images/user_icon.jpg') }}" alt class="w-px-40 h-auto rounded-circle">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="{{ asset('images/user_icon.jpg') }}" alt class="w-px-40 h-auto rounded-circle">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-medium d-block">
                                            {{ Auth::user()->name }}
                                        </span>
                                        <small class="text-muted">{{ Auth::user()->role->name }}</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class='bx bx-log-out me-2'></i>
                                <span class="align-middle">Вийти</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>

        <!-- Search Small Screens -->
        <div class="navbar-search-wrapper search-input-wrapper  d-none">
            <input type="text" class="form-control search-input container-xxl border-0" placeholder="" aria-label="">
            <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
        </div>
    </nav>
