@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="flex justify-content-between">
                <h4 class="py-3 mb-4" style="display: block">
                    <span class="text-muted fw-light">Звіти /</span> Звіт по касі за період
                </h4>
            </div>
                <div class="row">
                    <div class="py-3 mb-6">
                        <form method="post">
                            @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="from" class="form-label"></label>
                                <input type="date" name="from" value="{{ $from }}" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="to" class="form-label"></label>
                                <input type="date" name="to" value="{{ $to }}" class="form-control">
                            </div>
                            <div class="from-group col-md-4 mt-4">
                                <button type="submit" class="btn btn-primary">Відібрати</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            <div class="card">
                <div class="card-datatable table-responsive" id="tableResult">
                    <table class="table border-top" width="100%">
                        <thead>
                        <tr>
                            <th>Дата</th>
                            <th>№ візиту</th>
                            <th>№ пацієнта</th>
                            <th>ПІБ пацієнта</th>
                            <th>Сума по візиту</th>
                            <th>Готівка</th>
                            <th>Картка</th>
                            <th>Р/р</th>
                            <th>Баланс</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $pay)
                            <tr>
                                <td>{{ $pay['date'] }}</td>
                                <td>{{ $pay['visit_id'] }}</td>
                                <td>{{ $pay['visitor_id'] }}</td>
                                <td>{{ $pay['full_name'] }}</td>
                                <td>{{ $pay['visit_cost'] }}</td>
                                <td class="cash">{{ isset($pay['cash']) ? $pay['cash'] : '' }}</td>
                                <td class="cards">{{ isset($pay['card']) ? $pay['card'] : '' }}</td>
                                <td class="invoice">{{ isset($pay['invoice']) ? $pay['invoice'] : '' }}</td>
                                <td class="balance">{{ isset($pay['balance']) ? $pay['balance'] : '' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>Всього:</td>
                            <td>Готівка:</td>
                            <td class="summa_cash text-dark">{{ $summa_cash }}</td>
                            <td>Термінал:</td>
                            <td class="summa_card text-dark">{{ $summa_card }}</td>
                            <td>Р/р:</td>
                            <td class="summa_invoice text-dark">{{ $summa_invoice }}</td>
                            <td>Баланс:</td>
                            <td class="summa_balance text-dark">{{ $summa_balance }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
