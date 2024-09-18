<html><html>
<style>
    @page{
        size: A4;
        margin: 15mm 20mm 50mm 30mm; /* change the margins as you want them to be. */
        font-family: "Arial";
        font-size: 1pt;
    }
    body{
        padding: 0 0;
        margin: 0 0;
        font-family: Arial;
    }
    .title{
        width: 100%;
        text-align: center;
    }
    .green{
        color: rgb(2,115,10);
    }

    .page-header, .page-header-space {
        height: 139px;
        margin-bottom: 15px;
    }

    .page-footer, .page-footer-space {
        height: 47px;

    }

    .page-footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        border: none;
    }

    .page-header {
        position: fixed;
        top: 0mm;
        width: 100%;
    }

    .page-content{
        position: absolute;
        top: 140px;
        bottom: 50px;
        width: 100%;
    }
    .page {
        page-break-after: always;
    }

    @media print {
        thead {display: table-header-group;}
        tfoot {display: table-footer-group;}

        button {display: none;}

        body {margin: 0;}
    }
    @page:first{
        margin-bottom: 5cm;
    }
    .table > tbody{
        max-height: 25cm;
    }
    table tr td{
        border:none;
        empty-cells: initial;
        height: 6mm;
    }
    .no-border tr td{
        border: 0px;
    }
    tfoot{
        display: table-footer-group;
    }
    thead{
        display: table-header-group;
    }
    .patient_info{
        padding-left: 20mm;
    }
    .patient_info span{
        font-weight: bold;
    }
</style>
<body>
<div class="page-header">
    <img src="{{ asset('images/amg_full_blank.jpg') }}" >
</div>
<div class="page-footer">
    <img src="{{ asset('images/amg_full_blank.jpg') }}" >
</div>
<table width="100%">
    <thead>
    <tr>
        <td style="border: 0;">
            <!--place holder for the fixed-position footer-->
            <div class="page-header-space"></div>
        </td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <div class="page-body">
                <div class="title">
                    <h2 class="green">ПЕРВИННА КОНСУЛЬТАЦІЯ ТРИХОЛОГА</h2>
                </div>
                <div class="patient_info">
                <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                    <span>П.І.Б </span>{{ isset($visit->visitor->full_name) ? $visit->visitor->full_name : '' }}
                </div>
                <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                    <span>Вік </span>{{ isset($visit->visitor) ? \Illuminate\Support\Carbon::createFromDate($visit->visitor->birthday)->diffInYears(\Illuminate\Support\Carbon::now()) : '' }} років, {{ isset($visit->visitor) ? date("d.m.Y", strtotime($visit->visitor->birthday)) : '' }} р.н.
                </div>
                    @if(isset($info->value))
                        <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                            <span>Скарги пацієнта на: </span>{{ json_decode($info->value, true)['skargy'] }}
                        </div>
                        <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                            <span>An.morbi: </span>{{ json_decode($info->value, true)['morbi'] }}
                        </div>
                        <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                            <span>An.vitae: </span> {{ json_decode($info->value, true)['vitae'] }}
                        </div>
                        <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                            Ендокринологічний статус:  {{ json_decode($info->value, true)['endo_status'] }}
                        </div>
                        <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                            ШКТ:  {{ json_decode($info->value, true)['shkt'] }}
                        </div>
                        @if($visit->visitor->male=='female')
                        <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                            Гінекологічний статус:  {{ json_decode($info->value, true)['gin_status'] }}
                        </div>
                        @endif
                        <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                            Інші захворювання:  {{ json_decode($info->value, true)['other'] }}
                        </div>
                        <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                            <span>Шкідливі звички: </span>{{ json_decode($info->value, true)['shk_zv'] }}
                        </div>
                        <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                            <span>Алергоанамнез: </span>{{ json_decode($info->value, true)['alergoanamnez'] }}
                        </div>
                        <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                            <span>Об-но: </span> {{ nl2br(json_decode($info->value, true)['obno']) }}
                        </div>
                        <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                            Загальний стан: {{ json_decode($info->value, true)['zag_stan'] }}
                        </div>
                        <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                            Видимі слизові: {{ json_decode($info->value, true)['vyd_slyzovi'] }}
                        </div>
                        <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                            <span>Status localis: </span>{{ nl2br(json_decode($info->value, true)['localis']) }}
                        </div>
                        <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                            <span>Попередній діагноз: </span> {{ nl2br(json_decode($info->value, true)['pop_diagnoz']) }}
                        </div>
                        <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                            <span>Обстеження: </span> {{ nl2br(json_decode($info->value, true)['obstegennya']) }}
                        </div>
                        <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                            <span>Призначення: </span> {!! nl2br(json_decode($info->value, true)['pruznachennya']) !!}
                        </div>
                    @endif
                <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                    {{ date("d.m.Y", strtotime($visit->date)) }}
                </div>
                <div class="row" style="padding-bottom: 3px; padding-top: 3px">
                    Лікар-консультант: {{ $visit->likars->name }}
                </div>
                </div>
            </div>
        </td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td style="border: 0;">
            <!--place holder for the fixed-position footer-->
            <div class="page-footer-space"></div>
        </td>
    </tr>
    </tfoot>
</table>
