@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="flex justify-content-between">
                <h4 class="py-3 mb-4" style="display: block">
                    <span class="text-muted fw-light">Послуги</span> | @if(isset($groupBy->parent)) <a href="{{ route('services.groupsBy', ['id' => $groupBy->parent->id]) }}">Групи послуг</a> | {{ $groupBy->name }} @else Послуги @endif
                </h4>
                @if(!empty($groupBy) && !$groupBy->childrens->first())
                    <div class="py-9 mb-8">
                        <a class="btn btn-outline-primary" id="add_service">Додати послугу</a>
                    </div>
                @endif
            </div>
            <div class="card">
                <div class="card-datatable table-responsive" id="tableResult">
                    <table class="table border-top dataTable" width="100%" id="list">
                        <thead>
                        <tr>
                            <th>Назва</th>
                            <th>Батьківстка група</th>
                            <th>Ціна</th>
                            <th>Собівартість</th>
                            <th>Статус</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->parent->name }}</td>
                                <td>{{ $service->price }}</td>
                                <td>{{ $service->cost }}</td>
                                <td>@if($service->active == '1')<span class="text-success">Активна</span> @endif @if($service->active == '0')<span class="text-danger">Нективна</span> @endif </td>
                                <td>
                                    <button class="btn btn-sm btn-icon edit-service cursor-pointer" title="Редагувати" data-id="{{ $service->id }}"><i class="bx bx-edit"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddServices" aria-labelledby="offcanvasAddServicesLabel">
                <div class="offcanvas-header">
                    <h5 id="offcanvasAddServicesLabel" class="offcanvas-title">Додати послугу</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0">
                    <form class="add-new-user pt-0" id="form-add-new-service" onsubmit="return false">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Назва послуги:</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="parent" class="form-label">Батьківська група:</label>
                            <select name="parent" class="form-select">
                                @if(!empty($groupBy))
                                    @if($groupBy->parent)
                                        @foreach($groupBy->parent->childrens as $parent)
                                            <option value="{{ $parent->id }}" @if($groupBy->id == $parent->id) selected @endif>{{ $parent->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="{{ $groupBy->id }}">{{ $groupBy->name }}</option>
                                    @endif
                                @else
                                    @foreach($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Ціна для клієнтів:</label>
                            <input type="text" name="price" id="price" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="cost" class="form-label">Собівартість:</label>
                            <input type="text" name="cost" id="cost" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="doctor_price" class="form-label">Бонус лікаря:</label>
                            <input type="text" name="doctor_price" id="doctor_price" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Примітка:</label>
                            <textarea name="description" id="description" class="form-control" rows="5"></textarea>
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
            $("#add_service").click(function () {
                $("#offcanvasAddServices").addClass('show');
            });
            $(".btn-close").click(function () {
                $("#offcanvasAddServices").removeClass('show');
            });
            $('#groupSearch').select2({
                placeholder: 'Почніть вводити назву..',
                language: "uk",
                ajax: {
                    url: '{{ route('select2-groups') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.id + '. ' + item.name,
                                    id: item.id
                                }
                            })
                        };
                        onItemSelect: selectItem();
                    },
                    cache: true
                }
            });
            $("#form-add-new-record").submit(function(){
                var name = $("#name").val();
                var parent = $("#groupSearch").val();
                var active = $("#active").val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('services.groups_store') }}",
                    data: {'_token': '{{ csrf_token() }}', 'name': name, 'parent': parent, 'active' : active},
                    cache: false,
                    success: function(response){
                        $("#tableResult").html(response);
                        $("#name").val('');
                        $("#groupSearch").html('');
                    }
                });
            });
            $("#form-add-new-service").submit(function(e){
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    url: "{{ route('services.store') }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function(response){
                        $("#tableResult").html(response);
                        $("#name").val('');
                        $("#price").val('');
                        $("#cost").val('');
                        $("#doctor_price").val('');
                        $(".offcanvas-end").removeClass('show');
                    }
                });
                return false;
            });

            $("body").on("click", ".edit-service", function(){

                var service = $(this).data('id');

                $.ajax({
                    url: "/services/" + service + "/edit",
                    type: "GET",
                    data: {},
                    success: function(response){
                        $("#offcanvasAddServices").html(response);
                        $("#offcanvasAddServices").addClass('show');
                    }
                });
            });
        });
        $(".btn-close").click(function () {
            $(".offcanvas-end").removeClass('show');
        });
    </script>
@endsection
