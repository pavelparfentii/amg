@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light"><a href="{{ route('settings.cabinets') }}">Кабінети</a> / Перегляд </span>
            </h4>
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="user-avatar-section">
                                <div class=" d-flex align-items-center flex-column">
                                    <div class="user-info text-center">
                                        <form method="post" action="{{ route('settings.cabinet_update', ['id' => $cabinet->id]) }}">
                                            @csrf
                                            <h4 class="mb-2">
                                                <div class="form-floating">
                                                    <input type="text" name="name" class="form-control" id="floatingInput" value="{{ $cabinet->name }}">
                                                    <label for="floatingInput">Назва кабінету</label>
                                                </div>
                                            </h4>
                                            <h4 class="mb-2">
                                                <div class="form-floating">
                                                    <input type="text" name="custom" class="form-control" id="floatingInputCustom" value="{{ $cabinet->custom }}">
                                                    <label for="floatingInputCustom">Свій параметр</label>
                                                </div>
                                            </h4>
                                            <h4 class="mb-2">
                                                <div class="form-floating">
                                                    <select name="active" class="form-control" id="floatingInputActive">
                                                        <option value="1" @if($cabinet->active=='1') selected @endif>Відображати</option>
                                                        <option value="0" @if($cabinet->active=='0') selected @endif>Не відображати</option>
                                                    </select>
                                                    <label for="floatingInputActive">Відображення</label>
                                                </div>
                                            </h4>
                                            <h4 class="mb-2">
                                                <div class="form-floating">
                                                    <button type="sumbit" class="btn btn-primary">Оновити</button>
                                                </div>
                                            </h4>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-specialist" aria-controls="navs-specialist" aria-selected="false" tabindex="-1">Лікарі</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                                <div class="tab-pane fade show active" id="navs-specialist" role="tabpanel">
                                    <div class="card">
                                        <div class="card-header"></div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <label class="form-label" for="role">Лікарі</label>
                                                    <select id="role" class="select2 form-select specialist_add">
                                                        <option value="">Оберіть</option>
                                                        @foreach($likars as $likar)
                                                            <option value="{{ $likar->id }}">{{ $likar->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3" style="padding-top: 25px">
                                                    <button class="btn btn-primary me-3 add_specialist" data-id="{{ $cabinet->id }}">Додати</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-datatable table-responsive" id="tableResult">
                                        <table class="table border-top" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Спеціальність</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($cabinet_likars as $clikar)
                                                <tr>
                                                    <td>{{ $clikar->user->name }}</td>
                                                    <td><span class="item-delete cursor-pointer" data-id="{{ $clikar->id }}"><i class="bx bx-trash"></i> </span> </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
            $(".add_specialist").click(function(){
                var specialist = $(".specialist_add").val();
                $.ajax({
                    url: "{{ route('settings.cabinets_likar_add', ['id' => $cabinet->id]) }}",
                    type: "POST",
                    data: {'_token': '{{ csrf_token() }}', 'specialist': specialist},
                    cache: false,
                    success: function(response){
                        $("#tableResult").html(response);
                        $(".specialist_add").val('');
                    }
                });
            });
            $(".item-delete").on('click', function(){
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('settings.cabinets_likar_del') }}",
                    type: "POST",
                    data: {'_token': '{{ csrf_token() }}', 'id': id},
                    cache: false,
                    success: function(response){
                        $("#tableResult").html(response);
                    }
                });
            });
        });
    </script>
@endsection
