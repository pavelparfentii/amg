@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="flex justify-content-between">
                <h4 class="py-3 mb-4" style="display: block">
                    <span class="text-muted fw-light">Користувачі</span>
                </h4>
                <div class="py-9 mb-8">
                    <a class="btn btn-outline-primary" id="add_record">Додати запис</a>
                </div>
            </div>
            <div class="card">
                <div class="card-datatable table-responsive" id="tableResult">
                    <table class="table border-top" width="100%" id="list">
                        <thead>
                        <tr>
                            <th>Користувач</th>
                            <th>Роль</th>
                            <th>Статус</th>
                            <th>Дата створення</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td></td>
                                <td></td>
                                <td><a href="{{ route('users.edit', ['id' => $user->id]) }}"><button class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button></a></td>
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
                            <label class="form-label" for="email">Email</label>
                            <input type="text" id="email" class="form-control" placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="email" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="role">Роль</label>
                            <select id="role" class="select2 form-select">
                                <option value="">Оберіть</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
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
            $("#form-add-new-record").submit(function(){
                var name = $("#name").val();
                var email = $("#email").val();
                var role = $("#role").val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('users.store') }}",
                    data: {'_token': '{{ csrf_token() }}', 'name': name, 'role': role, 'email' : email},
                    cache: false,
                    success: function(response){
                        $("#tableResult").html(response);
                        $("#name").val('');
                        $("#role").val('');
                        $("#email").val('');
                        $(".offcanvas-end").removeClass('show');
                    }
                });
            });
        });
    </script>
@endsection
