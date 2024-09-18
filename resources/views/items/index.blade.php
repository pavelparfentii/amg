@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="flex justify-content-between">
                <h4 class="py-3 mb-4" style="display: block">
                    <span class="text-muted fw-light">ТМЦ</span> | @if(isset($groupBy->parent)) <a href="{{ route('items.groupsBy', ['id' => $groupBy->parent->id]) }}">Групи ТМЦ</a> | {{ $groupBy->name }} @else ТМЦ @endif
                </h4>
                @if(!empty($groupBy))
                    <div class="py-9 mb-8">
                        <a class="btn btn-outline-primary" id="add_service">Додати ТМЦ</a>
                    </div>
                @endif
            </div>
            <div class="card">
                <div class="card-datatable table-responsive" id="tableResult">
                    <table class="table border-top dataTable" width="100%">
                        <thead>
                        <tr>
                            <th>Назва</th>
                            <th>Батьківстка група</th>
                            <th>Ціна</th>
                            <th>Статус</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->parent->name }}</td>
                                <td>{{ $item->price() }}</td>
                                <td>@if($item->active == '1')<span class="text-success">Активна</span> @endif @if($item->active == '0')<span class="text-danger">Нективна</span> @endif </td>
                                <td>
                                    <button class="btn btn-sm btn-icon edit-item cursor-pointer" title="Редагувати" data-id="{{ $item->id }}"><i class="bx bx-edit"></i></button>
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
                <h5 id="offcanvasAddServicesLabel" class="offcanvas-title">Додати ТМЦ</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <form class="add-new-user pt-0" id="form-add-new-record" onsubmit="return false">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Назва ТМЦ:</label>
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
                        <label class="form-label" for="active">Статус</label>
                        <select id="active" class="select2 form-select" name="active">
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
            $("#form-add-new-record").submit(function(e){
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('items.store') }}",
                    data: form.serialize(),
                    cache: false,
                    success: function(response){
                        $("#tableResult").html(response);
                        $("#name").val('');
                        $("#groupSearch").html('');
                        $("#cost").val('');
                    }
                });
            });

            $("body").on("click", ".edit-item", function(){

                var item = $(this).data('id');

                $.ajax({
                    url: "/items/" + item + "/edit",
                    type: "GET",
                    data: {},
                    success: function(response){
                        $("#offcanvasAddServices").html(response);
                        $("#offcanvasAddServices").addClass('show');
                    }
                });
            });
        });
    </script>
@endsection
