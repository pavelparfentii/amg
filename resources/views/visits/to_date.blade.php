@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light"><a href="{{ route('visitors.index') }}">Візит</a> / Перенос візиту </span>
            </h4>
            <div class="card">
                <div class="card-body">
                <form method="post" id="changeVisit" class="form" action="{{ route('visits.to_date_store', ['visit' => $visit->id]) }}">
                    @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="mb-3">
                            <label for="date" class="form-label">Дата</label>
                            <input type="date" name="date" id="date" value="{{ $visit->date }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="cabinet" class="form-label">Кабінет</label>
                            <select name="cabinet" class="form-select" required id="cabinet">
                                @foreach($cabinets as $cabinet)
                                    <option value="{{ $cabinet->id }}" @if($cabinet->id == $visit->cabinet )selected @endif>{{ $cabinet->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="likar" class="form-label">Лікар</label>
                            <select name="likar" class="form-select" required id="likar">
                                @foreach($likars as $likar)
                                    <option value="{{ $likar->id }}" @if($likar->id == $visit->likar )selected @endif>{{ $likar->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="time" class="form-label">Час</label>
                            <select name="time" class="form-select" required id="time">
                                @foreach($timeGrid as $time)
                                    <option value="{{ $time }}" @if($time == $visit->time )selected @endif>{{ $time }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Перенести</button>
                        </div>
                    </div>
                    <div class="col-md-6" id="resultTable">
                        <table class="table table-bordered">
                            <thead>
                            <th>Час/Кабінет</th>
                            <th>{{ $visit->cabinets->name }}</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Нотатки</td>
                                @if(isset($visitData['00:00']))
                                    @if($visitData['00:00']->status == 'block')
                                        <td data-time="00:00" class="block">
                                            @if($visitData['00:00']->block + 600 < time() && $visitData['00:00']->creater_id != Auth::user()->id)
                                                <div class="content-block block-{{ $visitData['00:00']->timing }}x {{ $visitData['00:00']->status }}">
                                                    Заблоковано {{ $visitData['00:00']->creator->name }}
                                                </div>
                                            @elseif($visitData['00:00']->block + 600 < time() && $visitData['00:00']->creater_id == Auth::user()->id)
                                                <div class="content-block block-{{ $visitData['00:00']->timing }}x {{ $visitData['00:00']->status }}">
                                                    Заблоковано {{ $visitData['00:00']->creator->name }}
                                                </div>
                                            @else
                                                Заблоковано {{ $visitData['00:00']->creator->name }}
                                            @endif
                                        </td>
                                    @endif
                                    @if($visitData['00:00']->status =='new')
                                        <td class="block">
                                            <div class="content-block block-{{ $visitData['00:00']->timing }}x {{ $visitData['00:00']->status }}" data-id="{{ $visitData['00:00']->id }}">
                                                <div class="promo-marker">
                                                    @if($visitData['00:00']->visitor)
                                                        @if($visitData['00:00']->visitor->promo->first())
                                                            @foreach($visitData['00:00']->promo as $promo)
                                                                <span class="promo">{{ $promo->slug }}</span>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="visit-info">
                                                    @if($visitData['00:00']->visitor_id)

                                                        <b>№{{ $visitData['00:00']->visitor_id }}, {{ $visitData['00:00']->visitor->full_name }}, {{ $visitData['00:00']->visitor->phone }},</b>
                                                    @else
                                                        <b>NEW, {{ json_decode($visitData['00:00']->notes->value, true)['full_name'] }}, {{ json_decode($visitData['00:00']->notes->value, true)['phone'] }}</b>
                                                    @endif
                                                    @if($visitData['00:00']->services->first())
                                                        {{ $visitData['00:00']->services->first()->service_name }}, <b>{{ $visitData['00:00']->cost() }}грн.</b>
                                                    @endif
                                                    {{ $visitData['00:00']->description }}
                                                </div>
                                                <div class="action-block">Записав: <b>{{ $visitData['00:00']->creator->name }}</b></div>
                                            </div>
                                        </td>
                                    @endif
                                @else
                                    <td data-time="00:00" class="write"></td>
                                @endif
                            </tr>
                                @foreach($timeGrid as $time)
                                    <tr>
                                        <td>{{ $time }}</td>
                                            @if(isset($visitData[$time]))
                                                @if($visitData[$time]->status == 'block')
                                                    <td data-time="{{ $time }}" class="block">
                                                        @if($visitData[$time]->block + 600 < time() && $visitData[$time]->creater_id != Auth::user()->id)
                                                            <div class="content-block block-{{ $visitData[$time]->timing }}x {{ $visitData[$time]->status }}">
                                                                Заблоковано {{ $visitData[$time]->creator->name }}
                                                            </div>
                                                        @elseif($visitData[$time]->block + 600 < time() && $visitData[$time]->creater_id == Auth::user()->id)
                                                            <div class="content-block block-{{ $visitData[$time]->timing }}x {{ $visitData[$time]->status }}">
                                                                Заблоковано {{ $visitData[$time]->creator->name }}
                                                            </div>
                                                        @else
                                                            Заблоковано {{ $visitData[$time]->creator->name }}
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($visitData[$time]->status =='new')
                                                    <td class="block">
                                                        <div class="content-block block-{{ $visitData[$time]->timing }}x {{ $visitData[$time]->status }}" data-id="{{ $visitData[$time]->id }}">
                                                            <div class="promo-marker">
                                                                @if($visitData[$time]->visitor)
                                                                    @if($visitData[$time]->visitor->promo->first())
                                                                        @foreach($visitData[$time]->promo as $promo)
                                                                            <span class="promo">{{ $promo->slug }}</span>
                                                                        @endforeach
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="visit-info">
                                                                @if($visitData[$time]->visitor_id)

                                                                    <b>№{{ $visitData[$time]->visitor_id }}, {{ $visitData[$time]->visitor->full_name }}, {{ $visitData[$time]->visitor->phone }},</b>
                                                                @else
                                                                    <b>NEW, {{ json_decode($visitData[$time]->notes->value, true)['full_name'] }}, {{ json_decode($visitData[$time]->notes->value, true)['phone'] }}</b>
                                                                @endif
                                                                @if($visitData[$time]->services->first())
                                                                    {{ $visitData[$time]->services->first()->service_name }}, <b>{{ $visitData[$time]->cost() }}грн.</b>
                                                                @endif
                                                                {{ $visitData[$time]->description }}
                                                            </div>
                                                            <div class="action-block">Записав: <b>{{ $visitData[$time]->creator->name }}</b></div>
                                                        </div>
                                                    </td>
                                                @endif
                                                @if($visitData[$time]['status']=='visited')
                                                    <td class="block">
                                                        <div class="content-block block-{{ $visitData[$time]->timing }}x {{ $visitData[$time]->status }}" data-id="{{ $visitData[$time]->id }}">
                                                            <div class="promo-marker">
                                                                @if($visitData[$time]->visitor)
                                                                    @if($visitData[$time]->visitor->promo->first())
                                                                        @foreach($visitData[$time]->promo as $promo)
                                                                            <span class="promo">{{ $promo->slug }}</span>
                                                                        @endforeach
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="visit-info">
                                                                <b>№{{ $visitData[$time]->visitor_id }}, {{ $visitData[$time]->visitor->full_name }}, {{ $visitData[$time]->visitor->phone }},</b>
                                                                @if($visitData[$time]->services->first())
                                                                    {{ $visitData[$time]->services->first()->service_name }}, <b>{{ $visitData[$time]->cost() }}грн.</b>
                                                                @endif
                                                                {{ $visitData[$time]->description }}
                                                            </div>
                                                            <div class="action-block">Записав: <b>{{ $visitData[$time]->creator->name }}</b></div>
                                                        </div>
                                                    </td>
                                                @endif
                                                @if($visitData[$time]['status']=='payed')
                                                    <td class="block">
                                                        <div class="content-block block-{{ $visitData[$time]->timing }}x {{ $visitData[$time]->status }}" data-id="{{ $visitData[$time]->id }}">
                                                            <div class="promo-marker">
                                                                @if($visitData[$time]->visitor)
                                                                    @if($visitData[$time]->visitor->promo->first())
                                                                        @foreach($visitData[$time]->visitor->promo as $promo)
                                                                            <span class="promo">{{ $promo->promo->slug }}</span>
                                                                        @endforeach
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="visit-info">
                                                                <b>№{{ $visitData[$time]->visitor_id }}, {{ $visitData[$time]->visitor->full_name }}, {{ $visitData[$time]->visitor->phone }},</b>
                                                                @if(isset($visitData[$time]->services))
                                                                    {{ $visitData[$time]->services->first()->service_name }}, <b>{{ $visitData[$time]->cost() }}грн.</b>
                                                                @endif
                                                                {{ $visitData[$time]->description }}
                                                            </div>
                                                            <div class="action-block">Записав: <b>{{ $visitData[$time]->creator->name }}</b></div>
                                                        </div>
                                                    </td>
                                                @endif
                                                @if($visitData[$time]['status']=='partpayed')
                                                    <td class="block">
                                                        <div class="content-block block-{{ $visitData[$time]->timing }}x {{ $visitData[$time]->status }}" data-id="{{ $visitData[$time]->id }}">
                                                            <div class="promo-marker">
                                                                @if($visitData[$time]->visitor)
                                                                    @if($visitData[$time]->visitor->promo->first())
                                                                        @foreach($visitData[$time]->promo as $promo)
                                                                            <span class="promo">{{ $promo->slug }}</span>
                                                                        @endforeach
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="visit-info">
                                                                <b>№{{ $visitData[$time]->visitor_id }}, {{ $visitData[$time]->visitor->full_name }}, {{ $visitData[$time]->visitor->phone }},</b>
                                                                @if($visitData[$time]->services->first())
                                                                    {{ $visitData[$time]->services->first()->service_name }}, <b>{{ $visitData[$time]->cost() }}грн.</b>
                                                                @endif
                                                                {{ $visitData[$time]->description }}
                                                            </div>
                                                            <div class="action-block">Записав: <b>{{ $visitData[$time]->creator->name }}</b></div>
                                                        </div>
                                                    </td>
                                                @endif
                                            @else
                                                <td data-time="{{ $time }}" class="write"></td>
                                            @endif
                                        @endforeach
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $("#date").change(function(){
            var date = $(this).val();
            var cabinet = $("#cabinet").val();
            $.ajax({
                url: "/visits/" + date + "/" + cabinet + "/list",
                type: "GET",
                data: {},
                cache: false,
                success: function(response){
                    $("#resultTable").html(response);
                }
            });
        });

        $("#cabinet").change(function(){
            var date = $("#date").val();
            var cabinet = $(this).val();
            $.ajax({
                url: "/visits/" + date + "/" + cabinet + "/list",
                type: "GET",
                data: {},
                cache: false,
                success: function(response){
                    $("#resultTable").html(response);
                }
            });
        });
        $("#cabinet").change(function(){
            var cabinet = $(this).val();
            $.ajax({
                url: "/likars/" + cabinet,
                type: "GET",
                data: {},
                cache: false,
                success: function(response){
                    $("#likar").html(response);
                }
            });
        });
    });
</script>
@endsection
