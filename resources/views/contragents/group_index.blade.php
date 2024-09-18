@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="flex justify-content-between">
                <h4 class="py-3 mb-4" style="display: block">
                    <span class="text-muted fw-light">ТМЦ</span> | Контрагенти
                </h4>
                <div class="py-9 mb-8">
                    <a class="btn btn-outline-primary" id="add_record">Додати контрагента</a>
                </div>
            </div>
            <div class="card">
                <div class="card-datatable table-responsive" id="tableResult">
                    <table class="table border-top dataTable" width="100%">
                        <thead>
                        <tr>
                            <th>Назва</th>
                            <th>Статус</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>@if($item->active == '1')<span class="text-success">Активна</span> @endif @if($item->active == '0')<span class="text-danger">Нективна</span> @endif </td>
                                <td>
                                    <button class="btn btn-sm btn-icon edit-group cursor-pointer" title="Редагувати" data-id="{{ $item->id }}"><i class="bx bx-edit"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddGroups" aria-labelledby="offcanvasAddGroupsLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasAddGroupsLabel" class="offcanvas-title">Додати групу контрагентів</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <form class="add-new-user pt-0" id="form-add-new-record" onsubmit="return false">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Назва групи контрагентів:</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="active">Статус</label>
                        <select id="active" class="select2 form-select">
                            <option value="1">Активна</option>
                            <option value="0">Неактивна</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Створити</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $("#add_record").click(function () {
                $(".offcanvas-end").addClass('show');
            });
            $(".btn-close").click(function () {
                $(".offcanvas-end").removeClass('show');
            });
            $("#add_service").click(function () {
                $("#offcanvasAddServices").addClass('show');
            });
            $(".btn-close").click(function () {
                $("#offcanvasAddServices").removeClass('show');
            });
            $("#form-add-new-record").submit(function(){
                var name = $("#name").val();
                var active = $("#active").val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('contragents.group_store') }}",
                    data: {'_token': '{{ csrf_token() }}', 'name': name, 'active' : active},
                    cache: false,
                    success: function(response){
                        $("#tableResult").html(response);
                        $("#name").val('');
                        $("#groupSearch").html('');
                    }
                });
            });

            $("body").on("click", ".edit-group", function(){

                var id = $(this).data('id');

                $.ajax({
                    url: "/contragents_group/" + id + "/edit",
                    type: "GET",
                    data: {},
                    success: function(response){
                        $("#offcanvasAddGroups").html(response);
                        $("#offcanvasAddGroups").addClass('show');
                    }
                });

            });

        });
    </script>
@endsection
