@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="flex justify-content-between">
                <h4 class="py-3 mb-4" style="display: block">
                    <span class="text-muted fw-light">Лікарі</span>
                </h4>
                <div class="py-9 mb-8">
                    <a class="btn btn-outline-primary" id="add_record">Додати запис</a>
                </div>
            </div>
            <div class="card">
                <div class="card-datatable table-responsive" id="tableResult">
                    <table class="table border-top" width="100%">
                        <thead>
                        <tr>
                            <th>ПІБ</th>
                            <th>Місто</th>
                            <th>Внутрішній лікар</th>
                            <th>Статус</th>
                            <th>Дата створення</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($likars as $likar)
                            <tr>
                                <td>{{ $likar->name }}</td>
                                <td>{{ $likar->address }}</td>
                                <td>@if($likar->user_id) {{ $likar->user->name }} @endif</td>
                                <td>@if($likar->active=='1') <span class="badge bg-label-success">ACTIVE</span> @else <span class="badge bg-label-warning">INACTIVE</span> @endif</td>
                                <td>{{ date("d.m.Y", strtotime($likar->date_add)) }}</td>
                                <td><a href="{{ route('settings.likars.edit', ['id' => $likar->id]) }}"><button class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
                <div class="offcanvas-header">
                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Створити користувача</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0">
                    <form class="add-new-user pt-0" id="form-add-new-record" onsubmit="return false">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Ім'я</label>
                            <input type="text" class="form-control" id="name" placeholder="John Doe" name="name" aria-label="John Doe" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="address">Місто</label>
                            <input type="text" id="address" class="form-control" placeholder="м.Харків" aria-label="м.Харків" name="address" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="user">Внутрішній лікар</label>
                            <select id="user" class="select2 form-select">
                                <option value="">Оберіть</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="active">Статус</label>
                            <select class="select2 form-select" name="active">
                                <option value="1">Активний</option>
                                <option value="0">Нективний</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Примітка</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Створити</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#add_record").click(function(){
                $(".offcanvas-end").addClass('show');
            });
            $(".btn-close").click(function(){
                $(".offcanvas-end").removeClass('show');
            });
            $("#form-add-new-record").submit(function(e){
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('settings.likars.store') }}",
                    data: form.serialize(),
                    cache: false,
                    success: function(response){
                        $("#tableResult").html(response);
                        $("#form-add-new-record").trigger('reset');
                    }
                });
            });
        });
    </script>
@endsection
