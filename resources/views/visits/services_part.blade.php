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
