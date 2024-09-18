@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-2">Групи доступу</h4>
            <!-- Role cards -->
            <div class="row g-4" id="resultRoles">
                @foreach($roles as $role)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <h6 class="fw-normal">Всього {{ $role->list->count() }} користувачів</h6>
                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        @foreach($role->list as $item)
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="{{ $item->name }}" class="avatar avatar-sm pull-up">
                                            <img class="rounded-circle" src="{{ asset('images/user_icon.jpg') }}" alt="Avatar">
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-between align-items-end">
                                    <div class="role-heading">
                                        <h4 class="mb-1">{{ $role->name }}</h4>
                                        <a href="" data-bs-toggle="modal" class="role-edit-modal" data-id="{{ $role->id }}"><small>Редагувати роль</small></a>
                                    </div>
                                    <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card h-100">
                        <div class="row h-100">
                            <div class="col-sm-5">
                                <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                                    <img src="{{ asset('images/sitting-girl-with-laptop-light.png') }}" class="img-fluid" alt="Image" width="120" data-app-light-img="sitting-girl-with-laptop-light.png" data-app-dark-img="illustrations/sitting-girl-with-laptop-dark.png">
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="card-body text-sm-end text-center ps-sm-0">
                                    <button data-bs-target="#addRoleModal" data-bs-toggle="modal" class="btn btn-primary mb-3 text-nowrap add-new-role">Створити нову роль</button>
                                    <p class="mb-0">Додайте роль, якщо її не існує</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addRoleModal">
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $(".addRoleForm").on('submit', function(e){
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    url: "{{ route('users_role.update_access') }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function (response) {

                    }
                });
            });

            $(".role-edit-modal").click(function(){
               var id = $(this).data('id');
                $.ajax({
                    url: "/users/" + id + "/role_edit_access",
                    type: "GET",
                    data: {},
                    cache: false,
                    success: function (response) {
                        $("#addRoleModal").html(response);
                        $("#addRoleModal").css('display', 'block');
                        $("#addRoleModal").addClass('show');
                    }
                });
            });
            $(".add-new-role").click(function(){
                $.ajax({
                    url: "/users/role_create_access",
                    type: "GET",
                    data: {},
                    cache: false,
                    success: function (response) {
                        $("#addRoleModal").html(response);
                        $("#addRoleModal").css('display', 'block');
                        $("#addRoleModal").addClass('show');
                    }
                });
            });
        });
    </script>
@endsection
