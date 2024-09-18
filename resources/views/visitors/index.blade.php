@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="flex justify-content-between">
                <h4 class="py-3 mb-4" style="display: block">
                    <span class="text-muted fw-light">Відвідувачі</span>
                </h4>
            </div>
            <div class="card">
                <div class="card-datatable table-responsive" id="tableResult">
                    <table class="table border-top" width="100%" id="list">
                        <thead>
                        <tr>
                            <th>№картки</th>
                            <th>ПІБ</th>
                            <th>Дата народження</th>
                            <th>Телефон</th>
                            <th>Ел.пошта</th>
                            <th>Дата першого візиту</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($visitors as $visitor)
                            <tr>
                                <td>{{ $visitor->id }}</td>
                                <td>{{ $visitor->full_name }}</td>
                                <td>{{ date("d.m.Y", strtotime($visitor->birthday)) }}</td>
                                <td>{{ $visitor->phone }}</td>
                                <td>{{ $visitor->email }}</td>
                                <td>{{ date("d.m.Y", strtotime($visitor->date_add)) }}</td>
                                <td><a href="{{ route('visitors.edit', ['id' => $visitor->id]) }}"><button class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
