<table class="table table-bordered">
    <thead>
    <th>Час/Кабінет</th>
    <th>{{ $cabinets->name }}</th>
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
