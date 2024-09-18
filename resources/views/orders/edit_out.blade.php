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
                            <li class="breadcrumb-item"><a href="{{ route('items.orders_index') }}">Накладні</a></li>
                            <li class="breadcrumb-item active">Редагування видаткової накладної</li>
                        </ol>
                    </nav>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('orders.update', ['id' => $order->id]) }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-2">
                                <label for="date" class="form-label">Дата:</label>
                                <input type="date" class="form-control" name="date" required value="{{ $order->date }}">
                            </div>
                            <div class="col-md-1">
                                <input type="hidden" name="order_type" value="out">
                            </div>
                            <div class="col-md-2" style="padding-top: 30px">
                                <button type="submit" class="btn btn-primary">Оновити</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-group-divider"></div>
                <div class="card-body row">
                    <div class="col-sm-4">
                        <label for="item" class="form-label">Номенклатура</label>
                        <select id="itemSearch" class="select2 form-control" data-allow-clear="true" name="item"></select>
                    </div>
                    <div class="col-sm-2">
                        <label for="count" class="form-label">Кіль-сть <span id="item_count"></span></label>
                        <input type="number" name="count" id="count" class="form-control" />
                    </div>
                    <div class="col-sm-2">
                        <label for="price" class="form-label">Ціна</label>
                        <input type="text" name="price" id="price" class="form-control" />
                    </div>
                    <div class="col-sm-2" style="padding-top: 30px">
                        <button class="btn btn-outline-success" id="add_item">Додати</button>
                    </div>
                </div>
                <div class="table-responsive" id="result">
                    <table class="table mb-0" id="list">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Найменування</th>
                            <th>Кіль-сть</th>
                            <th>Ціна</th>
                            <th>Сума</th>
                            <th>EXP</th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody id="order-result">
                        @foreach($order->items as $itemm)
                            <tr>
                                <td>{{ $itemm->id }}</td>
                                <td>{{ $itemm->item->name }}</td>
                                <td class="visible_count count-{{ $itemm->id }}" data-id="{{ $itemm->id }}">{{ $itemm->count }}</td>
                                <td class="price-{{ $itemm->id }}">{{ $itemm->price }}</td>
                                <td class="visible_summa summa-{{ $itemm->id }}" data-id="{{ $itemm->id }}">
                                    {{ round($itemm->count * $itemm->price, 2) }}
                                </td>
                                <td>{{ $itemm->exp }}</td>
                                <td><span class="del_item cursor-pointer" data-item="{{ $itemm->id }}" data-order="{{ $itemm->order_id }}"><i class="bx bx-minus"></i></span></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5">Всього:</td>
                            <td colspan="2" style="font-weight: bold" id="itogo"></td>
                        </tr>
                        </tfoot>
                    </table>
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

            $('#itemSearch').on('change', function(){
                var item = $(this).val();
                $.ajax({
                    url: "{{ route('orders.item_count') }}",
                    type: "POST",
                    data: {'_token' : '{{ csrf_token() }}', 'item' : item},
                    cache: false,
                    success: function(response){
                        $("#item_count").html("<span class='text-danger'>(" + response.count + " ДОС-НО)*</span>");
                        $("#count").prop('attr', 'max');
                        $("#count").attr('max', response.count);
                        $("#price").val(response.price);
                    }
                });
            });

            $('#add_item').click(function(){
                var item = $("#itemSearch").val();
                var count = $("#count").val();
                var price = $("#price").val();

                $.ajax({
                    url: "{{ route('orders.add_item_out', ['id' => $order->id]) }}",
                    type: "POST",
                    data: {'_token': '{{ csrf_token() }}', 'item': item, 'count' : count, 'price' : price},
                    cache: false,
                    success: function(response){
                        $("#result").html(response);
                        $("#itemSearch").text('');
                        $("#count").val('');
                        $("#price").val('');

                        var cash = 0;
                        $("#order-result tr").each(function() {
                            var ca = $(this).find("td").eq(4).text();
                            if (ca != "") {
                                ca = parseFloat(ca);
                                cash += ca;
                            }
                            $("#itogo").text(cash);
                        });

                    }
                });
            });

            $(".del_item").click(function(){

                var item = $(this).data('item');
                var order = $(this).data('order');

                $.ajax({
                    url: "{{ route('orders.del_item_out') }}",
                    type: "POST",
                    data: {'_token': '{{ csrf_token() }}', 'item' : item, 'order' : order},
                    cache: false,
                    success: function(response){
                        $("#result").html(response);
                        var cash = 0;
                        $("#order-result tr").each(function() {
                            var ca = $(this).find("td").eq(4).text();
                            if (ca != "") {
                                ca = parseFloat(ca);
                                cash += ca;
                            }
                            $("#itogo").text(cash);
                        });
                    }
                });
            });
        });
    </script>
@endsection

