@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('site.index') }}">Головна</a>/</span> Доступ до сторінки заборонено</h4>
            <div class="app-academy">
                <div class="card p-0 mb-4">
                    <div class="card-body d-flex flex-column flex-md-row justify-content-between p-0 pt-4">
                        <div class="app-academy-md-25 card-body py-0">
                            <img src="{{ asset('images/bulb-light.png') }}" class="img-fluid app-academy-img-height scaleX-n1-rtl" alt="Bulb in hand" data-app-light-img="illustrations/bulb-light.png" data-app-dark-img="illustrations/bulb-dark.png" height="90">
                        </div>
                        <div class="app-academy-md-50 card-body d-flex align-items-md-center flex-column text-md-center">
                            <h3 class="card-title mb-4 lh-sm px-md-5 text-center">
                                Вам заоборонено доступ до цієї сторінки
                                <span class="text-primary fw-medium text-nowrap"></span>.
                            </h3>
                            <p class="mb-4">
                                Якщо Вам потрібен доступ, зверніться до свого Адміністратора системи
                            </p>
                        </div>
                        <div class="app-academy-md-25 d-flex align-items-end justify-content-end">
                            <img src="{{ asset('images/pencil-rocket.png') }}" alt="pencil rocket" height="188" class="scaleX-n1-rtl">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
