@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="flex justify-content-between">
                <h4 class="py-3 mb-4" style="display: block">
                    <span class="text-muted fw-light">ТМЦ</span> | Зведена таблиця
                </h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header">
                            <form method="post" class="form-group">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="from" class="form-label">Дата з:</label>
                                        <input type="date" class="form-control" name="from" value="{{ $from }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="to" class="form-label">Дата по:</label>
                                        <input type="date" class="form-control" name="to" value="{{ $to }}">
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <button type="submit" class="btn btn-primary">Відібрати</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-datatable table-responsive" id="tableResult">
                    <table class="table border-top dataTable" width="100%">
                        <thead>
                        <tr>
                            <th>Назва</th>
                            <th>Залишок на початок</th>
                            <th>Приход</th>
                            <th>Витрати</th>
                            <th>Залишок на кінець</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $list[$item->id]['saldo_in'] }}</td>
                                <td>{{ $list[$item->id]['in'] }}</td>
                                <td>{{ $list[$item->id]['out'] }}</td>
                                <td>{{ $list[$item->id]['saldo_in'] + $list[$item->id]['in'] + $list[$item->id]['out'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
