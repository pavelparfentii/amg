@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header"><button class="btn btn-outline-danger" id="reopen">Змінити статус візита на NEW</button></div>
                <div class="card-header">Додавання послуг до візиту</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 border-bottom">
                            <div><span>Відвідувач:</span><b> #{{ $visit->visitor_id }}, {{ $visit->visitor->full_name  }}</b></div>
                            <div><span>Кабінет: </span> <b>{{ $visit->cabinets->name }}</b>, приймав: <b>{{ $visit->likars->name }}</b></div>
                            <div><span>Дата: </span><b>{{ date("d.m.Y", strtotime($visit->date)) }}</b>, <span>Час:</span> <b>{{ $visit->time }}</b></div>
                            <div><span>Направив:</span> <b>{{ $visit->from_likars->name }}</b></div>
                        </div>
                        <div class="col-md-4">
                            <form method="post" id="serviceForm">
                                @csrf
                                <div class="form-group">
                                    <div class="inwrap">
                                        <label for="service" class="form-label">Послуга:</label>
                                        <select id="serviceSearch" class="select2 form-select form-select-lg" data-allow-clear="true" name="service"></select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="count" class="form-label">Кількість:</label>
                                        <input type="number" name="count" id="count" class="form-control" min="1" value="1">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="price" class="form-label">Ціна:</label>
                                        <input type="text" name="price" id="price" class="form-control bg-lighter" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="discount_percent" class="form-label">Знижка, %:</label>
                                        <input type="text" name="discount_percent" id="discount_percent" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="discount_absolute" class="form-label">Знижка, грн:</label>
                                        <input type="text" name="discount_absolute" id="discount_absolute" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="summa" class="form-label">Сума:</label>
                                        <input type="text" name="summa" id="summa" class="form-control bg-lighter">
                                    </div>
                                </div>
                                <div class="form-group" style="padding-top: 25px">
                                    <button type="submit" class="btn btn-primary">Додати</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8" id="tableResult">
                            <table class="table">
                                <thead>
                                <th>Група</th>
                                <th>Назва послуги</th>
                                <th>Кіль-сть</th>
                                <th>Ціна</th>
                                <th>Знижка</th>
                                <th>Сума</th>
                                <th></th>
                                </thead>
                                <tbody>
                                @foreach($visit->services as $service)
                                    <tr>
                                        <td>{{ $service->service->parent->name }}</td>
                                        <td>{{ $service->service->name }}</td>
                                        <td>{{ $service->count }}</td>
                                        <td>{{ $service->price }}</td>
                                        <td>{{ $service->discount }}</td>
                                        <td>{{ $service->summa }}</td>
                                        <td><i class="bx bx-trash cursor-pointer delete" data-id="{{ $service->id }}"></i></td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>

                                    <td colspan="3"></td>
                                    <td colspan="2" class="text-right">
                                        <span>Загальна вартість: </span>
                                    </td>
                                    <td>{{ $visit->cost() }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                <td colspan="7">
                                    @if($visit->pays->first())
                                    <div class="row">
                                        <div class="col-md-8 text-right">СПЛАЧЕНО:</div>
                                        <div class="col-md-4">
                                            @foreach($visit->pays as $pay)
                                                <div class="row pays_{{ $pay->pay_type }}">
                                                    <div class="col-md-6">
                                                        @switch($pay->pay_type)
                                                            @case('cash')
                                                            Готівка
                                                            @break

                                                            @case('card')
                                                            Термінал
                                                            @break

                                                            @case('invoice')
                                                            Р/р
                                                            @break

                                                            @case('balance')
                                                            Баланс
                                                            @break
                                                        @endswitch
                                                    </div>
                                                    <div class="col-md-3">{{ $pay->summa }}</div>
                                                    <div class="col-md-3">@if(Auth::user()->role_id == '1' ) <span class="delete_pay bx bx-trash cursor-pointer" data-type="{{ $pay->pay_type }}" data-visit="{{ $visit->id }}" title="Видалити оплату"></span> @endif</div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2" class="text-right">
                                        <span>До сплати: </span>
                                    </td>
                                    <td class="result_to_pay">{{ round($visit->cost() - $visit->pays->sum('summa'), 2) }}</td>
                                    <td></td>
                                </tr>
                                </tfoot>
                            </table>
                            <form method="post" action="{{ route('visits.to_pay', ['visit' => $visit->id]) }}">
                                @csrf
                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="cash" class="form-label">Готівка</label>
                                            <input type="text" class="form-control" name="cash">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="card" class="form-label">Термінал</label>
                                            <input type="text" class="form-control" name="card">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="invoice" class="form-label">Р/р</label>
                                            <input type="text" class="form-control" name="invoice">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="balance" class="form-label">Баланс відвідувача</label>
                                            <input type="text" class="form-control" name="balance">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Оплатити</button>
                                    </div>
                                </div>
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
        $(document).ready(function() {
            $('#serviceSearch').select2({
                placeholder: 'Почніть вводити назву..',
                language: "uk",
                ajax: {
                    @if($visit->cabinets->custom == 'analizy')
                        url: '{{ route('select2-analizy') }}',
                    @else
                        url: '{{ route('select2-service') }}',
                    @endif
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.id + '. ' + item.name + '(' + item.article + ')',
                                    id: item.id
                                }
                            })
                        };
                        onItemSelect: selectItem();
                    },
                    cache: true
                }
            });
            $(document).on('change',"#serviceSearch", function () {
                var service = $(this).val();
                if (service > "0") {
                    $.ajax({
                        type: "GET",
                        url: "/services/"+service+"/get-service-price",
                        data: {},
                        cache: false,
                        success: function(response){
                            $('#price').val(response);
                            $('#summa').val(response);
                        }
                    });
                    return false;
                } else {
                    $('#price').val('');
                }
            });
            $("#serviceForm").submit(function(e){
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    url: "{{ route('visits.service_add', ['visit' => $visit->id]) }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function(response){
                        $("#tableResult").html(response);
                        $("#serviceForm").trigger('reset');
                        $('#serviceSearch').html('');
                    }
                });
                return false;
            });

            $(".delete_pay").on('click', function(){
               var pay_type = $(this).data('type');
               var pays = $('.pays').attr('rowspan');

               $.ajax({
                   url: "{{ route('visits.pay_delete', ['visit' => $visit->id]) }}" ,
                   type: "POST",
                   data: {'_token': '{{ csrf_token() }}', 'pay_type': pay_type},
                   cache: false,
                   success: function(response){
                       $('.pays_' + pay_type).hide();
                       $('.pays').attr('rowspan', pays-1);
                       $('.result_to_pay').text(response);
                   }
               });
            });

            $("body").on("click", ".delete", function(){
               var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('visits.service_delete', ['visit' => $visit->id]) }}",
                    type: "POST",
                    data: {'_token': '{{ csrf_token() }}', 'id': id},
                    success: function(response){
                        $("#tableResult").html(response);
                    }
                });
            });

            $("#reopen").click(function(){
                window.open("{{ route('visits.reopen_v', ['visit' => $visit->id]) }}", "_self");
            });
        });
    </script>
@endsection
