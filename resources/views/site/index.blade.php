@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <h5 class="card-header">Календар запису на {{ date("d.m.Y", strtotime($date)) }}</h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Час/Кабінет</th>
                                @foreach($cabinets as $cabinet)
                                    <td>{{ $cabinet->name }}</td>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Нотатки</td>
                                    @foreach($cabinets as $cabinet)
                                        @if(isset($visitData['00:00'][$cabinet->id]))
                                        @if($visitData['00:00'][$cabinet->id]->status == 'block')
                                            <td data-time="00:00" data-cabinet="{{ $cabinet->id }}" class="block">
                                                @if($visitData['00:00'][$cabinet->id]->block + 600 < time() && $visitData['00:00'][$cabinet->id]->creater_id != Auth::user()->id)
                                                    <div class="content-block block-{{ $visitData['00:00'][$cabinet->id]->timing }}x {{ $visitData['00:00'][$cabinet->id]->status }}">
                                                        <a href="{{ route('visits.precreate', ['date' => $date, 'cabinet' => $cabinet->id, 'time' => '00:00']) }}">Перехопити</a>
                                                    </div>
                                                @elseif($visitData['00:00'][$cabinet->id]->block + 600 < time() && $visitData['00:00'][$cabinet->id]->creater_id == Auth::user()->id)
                                                    <div class="content-block block-{{ $visitData['00:00'][$cabinet->id]->timing }}x {{ $visitData['00:00'][$cabinet->id]->status }}">
                                                        <a href="{{ route('visits.precreate', ['date' => $date, 'cabinet' => $cabinet->id, 'time' => '00:00']) }}">Повернутися до редагування</a>
                                                    </div>
                                                @else
                                                    Заблоковано {{ $visitData['00:00'][$cabinet->id]->creater->name }}
                                                @endif
                                            </td>
                                        @endif
                                            @if($visitData['00:00'][$cabinet->id]->status =='new')
                                                <td class="block">
                                                    <div class="content-block block-{{ $visitData['00:00'][$cabinet->id]->timing }}x {{ $visitData['00:00'][$cabinet->id]->status }}" data-id="{{ $visitData['00:00'][$cabinet->id]->id }}" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="
                                                    @if($visitData['00:00'][$cabinet->id]->visitor_id)

                                                        <b>№{{ $visitData['00:00'][$cabinet->id]->visitor_id }}, {{ $visitData['00:00'][$cabinet->id]->visitor->full_name }}, {{ $visitData['00:00'][$cabinet->id]->visitor->phone }},</b>
                                                    @else
                                                        <b>NEW, {{ json_decode($visitData['00:00'][$cabinet->id]->notes->value, true)['full_name'] }}, {{ json_decode($visitData['00:00'][$cabinet->id]->notes->value, true)['phone'] }}</b>
                                                    @endif
                                                    @if($visitData['00:00'][$cabinet->id]->services->first())
                                                        {{ $visitData['00:00'][$cabinet->id]->services->first()->service_name }}, <b>{{ $visitData['00:00'][$cabinet->id]->cost() }}грн.</b>
                        @endif
                        {{ $visitData['00:00'][$cabinet->id]->description }}
                    ">
                                                        <div class="promo-marker">
                                                            @if($visitData['00:00'][$cabinet->id]->visitor)
                                                                @if($visitData['00:00'][$cabinet->id]->visitor->promo->first())
                                                                    @foreach($visitData['00:00'][$cabinet->id]->promo as $promo)
                                                                        <span class="promo">{{ $promo->slug }}</span>
                                                                    @endforeach
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="visit-info">
                                                            @if($visitData['00:00'][$cabinet->id]->visitor_id)

                                                                <b>№{{ $visitData['00:00'][$cabinet->id]->visitor_id }}, {{ $visitData['00:00'][$cabinet->id]->visitor->full_name }}, {{ $visitData['00:00'][$cabinet->id]->visitor->phone }},</b>
                                                            @else
                                                                <b>NEW, {{ json_decode($visitData['00:00'][$cabinet->id]->notes->value, true)['full_name'] }}, {{ json_decode($visitData['00:00'][$cabinet->id]->notes->value, true)['phone'] }}</b>
                                                            @endif
                                                            @if($visitData['00:00'][$cabinet->id]->services->first())
                                                                {{ $visitData['00:00'][$cabinet->id]->services->first()->service_name }}, <b>{{ $visitData['00:00'][$cabinet->id]->cost() }}грн.</b>
                                                            @endif
                                                            {{ $visitData['00:00'][$cabinet->id]->description }}
                                                        </div>
                                                        <div class="action-block">Записав: <b>{{ $visitData['00:00'][$cabinet->id]->creator->name }}</b></div>
                                                    </div>
                                                </td>
                                            @endif
                                        @else
                                            <td data-time="00:00" data-cabinet="{{ $cabinet->id }}" class="write"></td>
                                        @endif
                                    @endforeach
                                </tr>
                                @foreach($timeGrid as $time)
                                    <tr>
                                        <td>{{ $time }}</td>
                                        @foreach($cabinets as $cabinet)
                                            @if(isset($visitData[$time][$cabinet->id]))
                                                @if($visitData[$time][$cabinet->id]->status == 'block')
                                                    <td data-time="{{ $time }}" data-cabinet="{{ $cabinet->id }}" class="block">
                                                        @if($visitData[$time][$cabinet->id]->block + 600 < time() && $visitData[$time][$cabinet->id]->creater_id != Auth::user()->id)
                                                            <div class="content-block block-{{ $visitData[$time][$cabinet->id]->timing }}x {{ $visitData[$time][$cabinet->id]->status }}">
                                                                <a href="{{ route('visits.precreate', ['date' => $date, 'cabinet' => $cabinet->id, 'time' => $time]) }}">Перехопити</a>
                                                            </div>
                                                        @elseif($visitData[$time][$cabinet->id]->block + 600 < time() && $visitData[$time][$cabinet->id]->creater_id == Auth::user()->id)
                                                            <div class="content-block block-{{ $visitData[$time][$cabinet->id]->timing }}x {{ $visitData[$time][$cabinet->id]->status }}">
                                                                <a href="{{ route('visits.precreate', ['date' => $date, 'cabinet' => $cabinet->id, 'time' => $time]) }}">Повернутися до редагування</a>
                                                            </div>
                                                        @else
                                                            Заблоковано {{ $visitData[$time][$cabinet->id]->creater->name }}
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($visitData[$time][$cabinet->id]->status =='new')
                                                    <td class="block">
                                                    <div class="content-block block-{{ $visitData[$time][$cabinet->id]->timing }}x {{ $visitData[$time][$cabinet->id]->status }}" data-id="{{ $visitData[$time][$cabinet->id]->id }}">
                                                        <div class="promo-marker">
                                                            @if($visitData[$time][$cabinet->id]->visitor)
                                                                @if($visitData[$time][$cabinet->id]->visitor->promo->first())
                                                                    @foreach($visitData[$time][$cabinet->id]->promo as $promo)
                                                                        <span class="promo">{{ $promo->slug }}</span>
                                                                    @endforeach
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="visit-info">
                                                            @if($visitData[$time][$cabinet->id]->visitor_id)

                                                                <b>№{{ $visitData[$time][$cabinet->id]->visitor_id }}, {{ $visitData[$time][$cabinet->id]->visitor->full_name }}, {{ $visitData[$time][$cabinet->id]->visitor->phone }},</b>
                                                                @else
                                                                <b>NEW, {{ json_decode($visitData[$time][$cabinet->id]->notes->value, true)['full_name'] }}, {{ json_decode($visitData[$time][$cabinet->id]->notes->value, true)['phone'] }}</b>
                                                            @endif
                                                            @if($visitData[$time][$cabinet->id]->services->first())
                                                                {{ $visitData[$time][$cabinet->id]->services->first()->service_name }}, <b>{{ $visitData[$time][$cabinet->id]->cost() }}грн.</b>
                                                            @endif
                                                            {{ $visitData[$time][$cabinet->id]->description }}
                                                        </div>
                                                        <div class="action-block">Записав: <b>{{ $visitData[$time][$cabinet->id]->creator->name }}</b></div>
                                                    </div>
                                                    </td>
                                                @endif
                                                @if($visitData[$time][$cabinet->id]['status']=='visited')
                                                        <td class="block">
                                                            <div class="content-block block-{{ $visitData[$time][$cabinet->id]->timing }}x {{ $visitData[$time][$cabinet->id]->status }}" data-id="{{ $visitData[$time][$cabinet->id]->id }}">
                                                                <div class="promo-marker">
                                                                    @if($visitData[$time][$cabinet->id]->visitor)
                                                                        @if($visitData[$time][$cabinet->id]->visitor->promo->first())
                                                                            @foreach($visitData[$time][$cabinet->id]->promo as $promo)
                                                                                <span class="promo">{{ $promo->slug }}</span>
                                                                            @endforeach
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="visit-info">
                                                                        <b>№{{ $visitData[$time][$cabinet->id]->visitor_id }}, {{ $visitData[$time][$cabinet->id]->visitor->full_name }}, {{ $visitData[$time][$cabinet->id]->visitor->phone }},</b>
                                                                    @if($visitData[$time][$cabinet->id]->services->first())
                                                                        {{ $visitData[$time][$cabinet->id]->services->first()->service_name }}, <b>{{ $visitData[$time][$cabinet->id]->cost() }}грн.</b>
                                                                    @endif
                                                                    {{ $visitData[$time][$cabinet->id]->description }}
                                                                </div>
                                                                <div class="action-block">Записав: <b>{{ $visitData[$time][$cabinet->id]->creator->name }}</b></div>
                                                            </div>
                                                        </td>
                                                @endif
                                                @if($visitData[$time][$cabinet->id]['status']=='payed')
                                                        <td class="block">
                                                            <div class="content-block block-{{ $visitData[$time][$cabinet->id]->timing }}x {{ $visitData[$time][$cabinet->id]->status }}" data-id="{{ $visitData[$time][$cabinet->id]->id }}">
                                                                <div class="promo-marker">
                                                                    @if($visitData[$time][$cabinet->id]->visitor)
                                                                        @if($visitData[$time][$cabinet->id]->visitor->promo->first())
                                                                            @foreach($visitData[$time][$cabinet->id]->visitor->promo as $promo)
                                                                                <span class="promo">{{ $promo->promo->slug }}</span>
                                                                            @endforeach
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="visit-info">
                                                                    <b>№{{ $visitData[$time][$cabinet->id]->visitor_id }}, {{ $visitData[$time][$cabinet->id]->visitor->full_name }}, {{ $visitData[$time][$cabinet->id]->visitor->phone }},</b>
                                                                    @if($visitData[$time][$cabinet->id]->services->first())
                                                                        {{ $visitData[$time][$cabinet->id]->services->first()->service_name }}, <b>{{ $visitData[$time][$cabinet->id]->cost() }}грн.</b>
                                                                    @endif
                                                                    {{ $visitData[$time][$cabinet->id]->description }}
                                                                </div>
                                                                <div class="action-block">Записав: <b>{{ $visitData[$time][$cabinet->id]->creator->name }}</b></div>
                                                            </div>
                                                        </td>
                                                @endif
                                                @if($visitData[$time][$cabinet->id]['status']=='partpayed')
                                                        <td class="block">
                                                            <div class="content-block block-{{ $visitData[$time][$cabinet->id]->timing }}x {{ $visitData[$time][$cabinet->id]->status }}" data-id="{{ $visitData[$time][$cabinet->id]->id }}">
                                                                <div class="promo-marker">
                                                                    @if($visitData[$time][$cabinet->id]->visitor)
                                                                        @if($visitData[$time][$cabinet->id]->visitor->promo->first())
                                                                            @foreach($visitData[$time][$cabinet->id]->promo as $promo)
                                                                                <span class="promo">{{ $promo->slug }}</span>
                                                                            @endforeach
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="visit-info">
                                                                    <b>№{{ $visitData[$time][$cabinet->id]->visitor_id }}, {{ $visitData[$time][$cabinet->id]->visitor->full_name }}, {{ $visitData[$time][$cabinet->id]->visitor->phone }},</b>
                                                                    @if($visitData[$time][$cabinet->id]->services->first())
                                                                        {{ $visitData[$time][$cabinet->id]->services->first()->service_name }}, <b>{{ $visitData[$time][$cabinet->id]->cost() }}грн.</b>
                                                                    @endif
                                                                    {{ $visitData[$time][$cabinet->id]->description }}
                                                                </div>
                                                                <div class="action-block">Записав: <b>{{ $visitData[$time][$cabinet->id]->creator->name }}</b></div>
                                                            </div>
                                                        </td>
                                                @endif
                                            @else
                                                <td data-time="{{ $time }}" data-cabinet="{{ $cabinet->id }}" class="write"></td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $(".write").dblclick(function(){
                var time = $(this).data('time');
                var cabinet = $(this).data('cabinet');
                var date = '{{ $date }}';

                window.open("visits/" + date + "/" + cabinet + "/" + time + "/precreate", "_self");

            });
            $(".new").dblclick(function(){
                var visit = $(this).data('id');

                window.open("visits/" + visit + "/edit", "_self");

            });

            $(".visited").dblclick(function(){
                var visit = $(this).data('id');

                window.open("visits/" + visit + "/add_services", "_self");

            });

            $(".payed").dblclick(function(){
                var visit = $(this).data('id');

                window.open("visits/" + visit + "/show", "_self");
            });

            $(".partpayed").dblclick(function(){
                var visit = $(this).data('id');

                window.open("visits/" + visit + "/add_services", "_self");
            });
        });
    </script>
@endsection
