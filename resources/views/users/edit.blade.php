@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light"><a href="{{ route('users.index') }}">Користувачі</a> / Перегляд </span>
            </h4>
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="user-avatar-section">
                                <div class=" d-flex align-items-center flex-column">
                                    <img class="img-fluid rounded my-4" src="{{ asset('images/user_icon.jpg') }}" height="110" width="110" alt="User avatar" />
                                    <div class="user-info text-center">
                                        <h4 class="mb-2">{{ $user->name }}</h4>
                                        <span class="badge bg-label-secondary">{{ $user->role->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="d-flex justify-content-around flex-wrap my-4 py-3">
                                <div class="d-flex align-items-start me-4 mt-3 gap-3">
                                    <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-check bx-sm'></i></span>
                                    <div>
                                        <h5 class="mb-0">1.23k</h5>
                                        <span>Tasks Done</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start mt-3 gap-3">
                                    <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-customize bx-sm'></i></span>
                                    <div>
                                        <h5 class="mb-0">568</h5>
                                        <span>Projects Done</span>
                                    </div>
                                </div>
                            </div>-->
                            <h5 class="pb-2 border-bottom mb-4">Деталі</h5>
                            <div class="info-container">
                                <ul class="list-unstyled">
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Ім'я:</span>
                                        <span>{{ $user->name }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Email:</span>
                                        <span>{{ $user->email }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Status:</span>
                                        <span class="badge bg-label-success">Active</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Група:</span>
                                        <span>{{ $user->role->name }}</span>
                                    </li>
                                    @if($user->role->alias == 'likar')
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Основна спеціальність</span>
                                        <span>@if($user->likarSpecialist->first()) {{ $user->likarSpecialist->first()->specialist->name }} @endif</span>
                                    </li>
                                    @endif
                                    <!--<li class="mb-3">
                                        <span class="fw-medium me-2">Contact:</span>
                                        <span>(123) 456-7890</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Languages:</span>
                                        <span>French</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Country:</span>
                                        <span>England</span>
                                    </li>-->
                                </ul>
                                <div class="d-flex justify-content-center pt-3">
                                    <a href="" class="btn btn-primary me-3" data-id="{{ $user->id }}" data-bs-target="#editUser" data-bs-toggle="modal">Редагувати</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-access" aria-controls="navs-access" aria-selected="true">Права доступу</button>
                        </li>
                        @if($user->role->alias == 'likar')
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-specialist" aria-controls="navs-specialist" aria-selected="false" tabindex="-1">Спеціальності</button>
                        </li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-access" role="tabpanel">
                            <form method="post" id="user-access-update" onsubmit="return true">
                            @csrf
                            <div class="card-header">
                                <h5 class="card-title">Права доступу</h5>
                                <span class="card-subtitle">Підлаштуйте права доступу для більш точного налаштування</span>
                            </div>
                            <div class="table-responsive">
                                <table class="table border-top table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-nowrap">Type</th>
                                        <th class="text-nowrap text-center">Читання</th>
                                        <th class="text-nowrap text-center">Редагування</th>
                                        <th class="text-nowrap text-center">Створення</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pages as $page)
                                    <tr>
                                        <td class="text-nowrap">{{ $page->name }}</td>
                                        <td>
                                            <div class="form-check d-flex justify-content-center">
                                                <input class="form-check-input" type="checkbox" id="{{ $page->alias }}Read" name="{{ $page->alias }}[]" value="read" @if(isset(json_decode($user->access, true)[$page->alias])) @if(in_array('read', json_decode($user->access, true)[$page->alias])) checked="checked" @endif @endif />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check d-flex justify-content-center">
                                                <input class="form-check-input" type="checkbox" id="{{ $page->alias }}Write" name="{{ $page->alias }}[]" value="write" @if(isset(json_decode($user->access, true)[$page->alias])) @if(in_array('write', json_decode($user->access, true)[$page->alias])) checked="checked" @endif @endif />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check d-flex justify-content-center">
                                                <input class="form-check-input" type="checkbox" id="{{ $page->alias }}Create" name="{{ $page->alias }}[]" value="create" @if(isset(json_decode($user->access, true)[$page->alias])) @if(in_array('create', json_decode($user->access, true)[$page->alias])) checked="checked" @endif @endif />
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-body">
                                <button @if(!in_array('write', json_decode(Auth::user()->access, true)['koristuvaci'])) disabled @endif type="submit" class="btn btn-primary me-2">Зберегти зміни</button>
                            </div>
                            </form>
                        </div>
                        @if($user->role->alias == 'likar')
                            <div class="tab-pane fade" id="navs-specialist" role="tabpanel">
                                <div class="card">
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label" for="role">Спеціальність</label>
                                                <select id="role" class="select2 form-select specialist_add">
                                                    <option value="">Оберіть</option>
                                                    @foreach($specialists as $specialist)
                                                        <option value="{{ $specialist->id }}">{{ $specialist->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="timing">Таймінг</label>
                                                <select id="timing" class="select2 form-select timing_add">
                                                    <option value="30">30 хвилин</option>
                                                    <option value="45">45 хвилин</option>
                                                    <option value="60">60 хвилин</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3" style="padding-top: 25px">
                                                <button class="btn btn-primary me-3 add_specialist" data-id="{{ $user->id }}">Додати</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-datatable table-responsive" id="tableResult">
                                    <table class="table border-top" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Спеціальність</th>
                                            <th>Таймінг</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user->likarSpecialist as $likar)
                                            <tr>
                                                <td>{{ $likar->specialist->name }}</td>
                                                <td>{{ $likar->timing }}хв</td>
                                                <td><span class="item-delete" data-id="{{ $likar->id }}"><i class="bx bx-trash"></i> </span> </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
            <div class="modal fade" id="editUser" tabindex="-1" aria-modal="true" role="dialog" >
                <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3>Змінити дані користувача</h3>
                            </div>
                            <form id="editUserForm" method="post" action="{{ route('users.update', ['id' => $user->id]) }}" class="row g-3 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                                @csrf
                                <div class="col-12 col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="name">Ім'я</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="" value="{{ $user->name }}">
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                <div class="col-12 col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Doe" value="{{ $user->email }}">
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="role">Група</label>
                                    <select id="role" name="role" class="form-select" aria-label="Default select example">
                                        <option>-- Група --</option>
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}" @if($user->role_id == $role->id) selected @endif>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Оновити</button>
                                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                                <input type="hidden">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#user-access-update").on('submit', function(e){
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    url: "{{ route('users.update_access', ['id' => $user->id]) }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function (response) {

                    }
                });
            });
            $(".add_specialist").click(function(){
               var specialist = $(".specialist_add").val();
               var timing = $(".timing_add").val();
               $.ajax({
                  url: "{{ route('users.add_specialist', ['id' => $user->id]) }}",
                  type: "POST",
                  data: {'_token': '{{ csrf_token() }}', 'specialist': specialist, 'timing' : timing},
                  cache: false,
                  success: function(response){
                      $("#tableResult").html(response);
                      $(".specialist_add").val('');
                      $(".timing_add").val('');
                  }
               });
            });
            $("body").on("click", ".item-delete", function(){
               var id = $(this).data('id');
               $.ajax({
                   url: "/users/" + id + "/del_specialist",
                   type: "GET",
                   data: {},
                   cache: false,
                   success: function(response){
                       $("#tableResult").html(response);
                   }
               });
            });
        });
    </script>
@endsection
