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
                                <th>Відвідувач</th>
                                <th>Послуга</th>
                                <th>Примітка</th>
                                <th>Статус</th>
                                <th>Дії</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Нотатки</td>
                                <td>@if(isset($visitData['00:00']))
                                        @if($visitData['00:00']->visitor_id)#{{ $visitData['00:00']->visitor_id }}, {{ $visitData['00:00']->visitor->full_name }}@endif
                                    @endif
                                </td>
                                <td>
                                    @if(isset($visitData['00:00']))
                                        @if($visitData['00:00']->services->first())
                                            {{ $visitData['00:00']->services->first()->service_name }}
                                        @endif
                                    @endif
                                </td>
                                <td>@if(isset($visitData['00:00'])) {{ $visitData['00:00']->description }}@endif</td>
                                <td>@if(isset($visitData['00:00']))<span class="badge {{ $visitData['00:00']->status }} me-1">{{ $visitData['00:00']->status }}</span>@endif</td>
                                <td></td>
                            </tr>
                            @foreach($timeGrid as $time)
                                <tr>
                                    <td>{{ $time }}</td>
                                    <td>
                                        @if(isset($visitData[$time]))
                                            @if($visitData[$time]->visitor_id)#{{ $visitData[$time]->visitor_id }}, {{ $visitData[$time]->visitor->full_name }}@endif
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($visitData[$time]))
                                            @if($visitData[$time]->services->first())
                                                {{ $visitData[$time]->services->first()->service_name }}
                                            @endif
                                        @endif
                                    </td>
                                    <td>@if(isset($visitData[$time])) {{ $visitData[$time]->description }}@endif</td>
                                    <td>@if(isset($visitData[$time]))<span class="badge {{ $visitData[$time]->status }} me-1">{{ $visitData[$time]->status }}</span>@endif</td>
                                    <td>@if(isset($visitData[$time]))<a href="{{ route('visits.priem', ['visit' => $visitData[$time]->id]) }}" title="Заповнити прийом"><i class="bx bx-sm bxs-pen"></i></a>@endif</td>
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
