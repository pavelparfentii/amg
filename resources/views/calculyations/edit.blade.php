@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('site.index') }}">Головна</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('calculyations.index') }}">Калькуляції</a></li>
                            <li class="breadcrumb-item active">Редагування калькуляції</li>
                        </ol>
                    </nav>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('calculyations.update', ['id' => $calc->id]) }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-2">
                                <label for="date_start" class="form-label">Дата початку:</label>
                                <input type="date" class="form-control" name="date_start" required value="{{ $calc->date_start }}">
                            </div>
                            <div class="col-md-4">
                                <label for="service" class="form-label">Послуга:</label>
                                <select class="form-control" name="service" id="serviceSearch">
                                    <option value="{{ $calc->service_id }}">{{ $calc->service->name }}</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="group" class="form-label">Група:</label>
                                <input type="text" class="form-control" readonly id="group" name="group" value="{{ $calc->service->parent->name }}" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="name" class="form-label">Назва:</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $calc->name }}">
                            </div>
                            <div class="col-md-1 form-check form-check-primary mt-4" style="padding-top: 15px">
                                <label for="pf" class="form-label">НПФ:</label>
                                <input type="checkbox" class="form-check-input" name="pf" id="pf" @if($calc->is_pf=='1') checked="checked" @endif>
                            </div>
                            <div class="col-md-2" style="padding-top: 30px">
                                <button type="submit" class="btn btn-primary">Редагувати</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-group-divider"></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 order-0 order-md-1">
                            <div class="nav-align-top mb-4">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-items" aria-controls="navs-items" aria-selected="true">Медикаменти</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pfs" aria-controls="navs-pfs" aria-selected="false" tabindex="-1">НПФ</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-services" aria-controls="navs-services" aria-selected="false" tabindex="-1">Послуги</button>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="navs-items" role="tabpanel">
                                        <div class="card-body">
                                            <form method="post" id="item-form" class="form-group row">
                                                @csrf
                                                <div class="col-sm-4">
                                                    <label for="item" class="form-label">Номенклатура</label>
                                                    <select id="itemSearch" class="select2 form-control" data-allow-clear="true" name="item"></select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="count" class="form-label">Кіль-сть</label>
                                                    <input type="number" name="count" id="count" class="form-control" required step="0.001" />
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="price" class="form-label">Ціна</label>
                                                    <input type="text" name="price" id="item_price" class="form-control" required />
                                                </div>
                                                <div class="col-sm-3" style="padding-top: 30px">
                                                    <input type="hidden" name="item_type" value="item">
                                                    <button class="btn btn-outline-success" type="submit">Додати</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="table-responsive" id="items_result">
                                            <table class="table mb-0" id="i_list">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Найменування</th>
                                                    <th>Кіль-сть</th>
                                                    <th>Ціна</th>
                                                    <th>Сума</th>
                                                    <th>Дії</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($calc->items as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->item->name }}</td>
                                                        <td class="visible_count count-{{ $item->id }}" data-id="{{ $item->id }}">{{ $item->count }}</td>
                                                        <td class="price-{{ $item->id }}">{{ $item->price }}</td>
                                                        <td class="visible_summa summa-{{ $item->id }}" data-id="{{ $item->id }}">
                                                            {{ round($item->count * $item->price, 2) }}                                                        </td>
                                                        <td><span class="del_item cursor-pointer" data-item="{{ $item->id }}"><i class="bx bx-minus"></i></span></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="navs-pfs" role="tabpanel">
                                        <div class="card-body">
                                            <form method="post" id="pf-form" class="form-group row">
                                                @csrf
                                                <div class="col-sm-4">
                                                    <label for="item" class="form-label">Номенклатура</label>
                                                    <select id="pfSearch" class="select2 form-control" data-allow-clear="true" name="item"></select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="count" class="form-label">Кіль-сть</label>
                                                    <input type="number" name="count" id="pf_count" class="form-control" required value="1" />
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="price" class="form-label">Ціна</label>
                                                    <input type="text" name="price" id="pf_price" class="form-control" required />
                                                </div>
                                                <div class="col-sm-3" style="padding-top: 30px">
                                                    <input type="hidden" name="item_type" value="pf">
                                                    <button class="btn btn-outline-success" type="submit">Додати</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="table-responsive" id="pf_result">
                                            <table class="table mb-0" id="i_list">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Найменування</th>
                                                    <th>Кіль-сть</th>
                                                    <th>Ціна</th>
                                                    <th>Сума</th>
                                                    <th>Дії</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($calc->pfs as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->pf->name }}</td>
                                                        <td class="visible_count count-{{ $item->id }}" data-id="{{ $item->id }}">{{ $item->count }}</td>
                                                        <td class="price-{{ $item->id }}">{{ $item->price }}</td>
                                                        <td class="visible_summa summa-{{ $item->id }}" data-id="{{ $item->id }}">
                                                            {{ round($item->count * $item->price, 2) }}                                                        </td>
                                                        <td><span class="del_item cursor-pointer" data-item="{{ $item->id }}"><i class="bx bx-minus"></i></span></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="navs-services" role="tabpanel">
                                        <div class="card-body">
                                            <form method="post" id="service-form" class="form-group row">
                                                @csrf
                                                <div class="col-sm-4">
                                                    <label for="item" class="form-label">Номенклатура</label>
                                                    <select id="selfServiceSearch" class="select2 form-control" data-allow-clear="true" name="item"></select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="count" class="form-label">Кіль-сть</label>
                                                    <input type="number" name="count" id="service_count" class="form-control" required value="1"/>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="price" class="form-label">Ціна</label>
                                                    <input type="text" name="price" id="service_price" class="form-control" required />
                                                </div>
                                                <div class="col-sm-3" style="padding-top: 30px">
                                                    <input type="hidden" name="item_type" value="service">
                                                    <input type="hidden" name="calc" value="{{ $calc->id }}" id="calc" >
                                                    <button class="btn btn-outline-success" type="submit">Додати</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="table-responsive" id="service_result">
                                            <table class="table mb-0" id="i_list">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Найменування</th>
                                                    <th>Кіль-сть</th>
                                                    <th>Ціна</th>
                                                    <th>Сума</th>
                                                    <th>Дії</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($calc->services as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->service->name }}</td>
                                                        <td class="visible_count count-{{ $item->id }}" data-id="{{ $item->id }}">{{ $item->count }}</td>
                                                        <td class="price-{{ $item->id }}">{{ $item->price }}</td>
                                                        <td class="visible_summa summa-{{ $item->id }}" data-id="{{ $item->id }}">
                                                            {{ round($item->count * $item->price, 2) }}                                                        </td>
                                                        <td><span class="del_item cursor-pointer" data-item="{{ $item->id }}"><i class="bx bx-minus"></i></span></td>
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
                    <div class="row">
                        <div class="col-md-4 alert alert-primary alert-dismissible">
                            <div class="row">
                                <div class="col-md-6">Вартість послуги:</div>
                                <div class="col-md-6 justify-content-between" id="item_price">{{ $calc->service->price }}</div>
                            </div>
                        </div>
                        <div class="col-md-4 alert alert-danger alert-dismissible">
                            <div class="row">
                                <div class="col-md-6">Собівартість послуги:</div>
                                <div class="col-md-6 justify-content-between" id="item_cost">{{ $calc->summa() }}</div>
                            </div>
                        </div>
                        <div class="col-md-4 alert alert-success alert-dismissible">
                            <div class="row">
                                <div class="col-md-6">Прибуток:</div>
                                <div class="col-md-6 justify-content-between" id="item_profit">{{ $calc->service->price - $calc->summa() }}</div>
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
            $('#itemSearch').select2({
                placeholder: 'Почніть вводити назву..',
                language: "uk",
                ajax: {
                    url: '{{ route('itemSearch') }}',
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
        });
        $(document).on('change',"#itemSearch", function () {
            var item = $(this).val();
            if (item > "0") {
                $.ajax({
                    type: "GET",
                    url: "/items/" + item + "/lastPrice",
                    data: {},
                    cache: false,
                    success: function(response){
                        $("#item_price").val(response.price);
                    }
                });
                return false;
            }
        });
        $(document).ready(function(){
            $("#item-form").submit(function(e){
                e.preventDefault();
                var form = $(this);

                var cost = $("#item_cost").html();
                var profit = $("#item_profit").html();
                var price = $("#item_price").val();
                var count = $("#count").val();
                var item_cost = parseFloat(cost) + parseFloat(count * price);
                var item_profit = parseFloat(profit) - parseFloat(count * price);

                $.ajax({
                    url: "{{ route('calculyations.add_item', ['id' => $calc->id]) }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function(response){
                        $("#items_result").html(response);
                        $("#itemSearch").html('');
                        $("#price").val('');
                        $("#count").val('');
                        $("#item_cost").html(item_cost.toFixed(2));
                        $("#item_profit").html(item_profit.toFixed(2));
                    }
                });
                return false;
            });
        });

        $(document).ready(function(){
            $('#pfSearch').select2({
                placeholder: 'Почніть вводити назву..',
                language: "uk",
                ajax: {
                    url: '{{ route('pfSearch') }}',
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
        });
        $(document).on('change',"#pfSearch", function () {
            var item = $(this).val();
            if (item > "0") {
                $.ajax({
                    type: "GET",
                    url: "/calculyations/" + item + "/lastPrice",
                    data: {},
                    cache: false,
                    success: function(response){
                        $("#pf_price").val(response);
                    }
                });
                return false;
            }
        });
        $(document).ready(function(){
            $("#pf-form").submit(function(e){
                e.preventDefault();
                var form = $(this);

                var cost = $("#item_cost").html();
                var profit = $("#item_profit").html();
                var price = $("#pf_price").val();
                var count = $("#pf_count").val();
                var item_cost = parseFloat(cost) + parseFloat(count * price);
                var item_profit = parseFloat(profit) - parseFloat(count * price);

                $.ajax({
                    url: "{{ route('calculyations.add_item', ['id' => $calc->id]) }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function(response){
                        $("#pf_result").html(response);
                        $("#pfSearch").html('');
                        $("#pf_price").val('');
                        $("#pf_count").val('');
                        $("#item_cost").html(item_cost.toFixed(2));
                        $("#item_profit").html(item_profit.toFixed(2));

                    }
                });
                return false;
            });
        });

        $(document).ready(function(){
            $('#selfServiceSearch').select2({
                placeholder: 'Почніть вводити назву..',
                language: "uk",
                ajax: {
                    url: '{{ route('serviceSearch') }}',
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
        });
        $(document).on('change',"#selfServiceSearch", function () {
            var item = $(this).val();
            var calc = $("#calc").val();
            if (item > "0") {
                $.ajax({
                    type: "GET",
                    url: "/selfServices/" + item + "/" + calc + "/lastPrice",
                    data: {},
                    cache: false,
                    success: function(response){
                        $("#service_price").val(response);
                    }
                });
                return false;
            }
        });
        $(document).ready(function(){
            $("#service-form").submit(function(e){
                e.preventDefault();
                var form = $(this);

                var cost = $("#item_cost").html();
                var profit = $("#item_profit").html();
                var price = $("#service_price").val();
                var count = $("#service_count").val();
                var item_cost = parseFloat(cost) + parseFloat(count * price);
                var item_profit = parseFloat(profit) - parseFloat(count * price);
                $.ajax({
                    url: "{{ route('calculyations.add_item', ['id' => $calc->id]) }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function(response){
                        $("#services_result").html(response);
                        $("#selfServiceSearch").html('');
                        $("#service_price").val('');
                        $("#service_count").val('');
                        $("#item_cost").html(item_cost.toFixed(2));
                        $("#item_profit").html(item_profit.toFixed(2));

                    }
                });
                return false;
            });
        });

    </script>
@endsection

