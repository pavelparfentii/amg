@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header">Перегляд візиту</div>
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
                                        <select id="serviceSearch" class="select2 form-select form-select-lg" data-allow-clear="true" name="service" disabled></select>
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
                                        <input type="text" name="suma" id="suma" class="form-control bg-lighter">
                                    </div>
                                </div>
                                <div class="form-group" style="padding-top: 25px">
                                    <button type="submit" class="btn btn-primary" disabled>Додати</button>
                                </div>
                                @if(Auth::user()->role->alias == 'superadmin')
                                <div class="form-group mb-3" style="padding-top: 25px">
                                    <a href="{{ route('visits.reopen', ['visit' => $visit->id]) }}" class="btn btn-danger">Перевідкрити</a>
                                </div>
                                @endif
                            </form>
                            @if($visit->cabinets->custom == 'analizy')
                                <div class="form-group mb-3">
                                    <a href="{{ route('visits.print-analize', ['visit' => $visit->id]) }}" class="btn btn-outline-info" target="_blank">Друк форми аналізів</a>
                                </div>
                                <div class="form-group">
                                    <form method="post" action="{{ route('visits.upload_analize', ['visit' => $visit->id]) }}" enctype="multipart/form-data" id="uploadFile">
                                        @csrf
                                        <div class="input-group">
                                            <button class="btn btn-outline-primary" type="submit" id="file">Завантажити</button>
                                            <input type="file" class="form-control" name="file[]" id="file" aria-describedby="inputGroupFileAddon03" aria-label="Upload" multiple="multiple">
                                        </div>
                                    </form>
                                </div>
                                <div class="mt-3">
                                    @if($files)
                                    <table class="table table-responsive">
                                        <thead>
                                        <th>
                                            Файл
                                        </th>
                                        <th>
                                            Дії
                                        </th>
                                        </thead>
                                        <tbody>
                                        @foreach($files as $file)
                                            <tr>
                                                <td>{{ $file->title }}</td>
                                                <td><a href="{{ "/upload/analize/".$visit->id."/".$file->file }}"><i class="bx bx-file"></i></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                        @endif
                                </div>
                            @endif

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
                                        <span>ЗАГАЛЬНА ВАРТІСТЬ: </span>
                                    </td>
                                    <td>{{ $visit->cost() }}</td>
                                    <td></td>
                                </tr>
                                @if($visit->pays->first())
                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="4">СПЛАЧЕНО:</td>
                                    </tr>
                                    @if($visit->cash_pay())
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2">Готівка:</td>
                                            <td colspan="2">{{ $visit->cash_pay() }}</td>
                                        </tr>
                                    @endif
                                    @if($visit->card_pay())
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2">Термінал:</td>
                                            <td colspan="2">{{ $visit->card_pay() }}</td>
                                        </tr>
                                    @endif
                                    @if($visit->invoice_pay())
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2">Р/р:</td>
                                            <td colspan="2">{{ $visit->invoice_pay() }}</td>
                                        </tr>
                                    @endif
                                    @if($visit->balance_pay())
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2">З балансу:</td>
                                            <td colspan="2">{{ $visit->balance_pay() }}</td>
                                        </tr>
                                    @endif
                                @endif
                                @if($visit->cost() > $visit->pays->sum('summa'))
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2" class="text-right">
                                        <span>ДО СПЛАТИ </span>
                                    </td>
                                    <td>{{ round($visit->cost() - $visit->pays->sum('summa'), 2) }}</td>
                                    <td></td>
                                </tr>
                                @endif
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
