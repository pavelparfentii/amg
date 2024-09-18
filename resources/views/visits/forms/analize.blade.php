<html>
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
        border:1px solid #d9dee3;
        empty-cells: initial;
        height: 6mm;
        padding: 5px 15px;
    }
    .table th{
        padding: 5px 15px
    }
    .no-border{
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
<table width="100%" class="table table-responsive table-bordered" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <td style="border: 0;">
            <!--place holder for the fixed-position footer-->
            <div class="page-header-space"></div>
        </td>
    </tr>
    <tr>
        <td colspan="5">
            <h3 align="center">{{ $visit->visitor->full_name }}</h3>
            <div align="center">Дата народження: {{ date("d.m.Y", strtotime($visit->visitor->birthday)) }}</div>
            <h5 align="center">Картка № {{ $visit->visitor_id }}</h5>
        </td>
    </tr>
    <th>№ з/п</th>
    <th>Код послуги</th>
    <th>Назва послуги</th>
    <th>Кількість</th>
    <th>Ціна</th>
    </thead>
    <tbody>
    <div class="page-body">
    @php $i = 1; @endphp
    @foreach($visit->services as $service)
    <tr>
        <td>{{ $i }}</td>
        <td>{{ $service->service->article }}</td>
        <td>{{ $service->service->name }}</td>
        <td>{{ $service->count }}</td>
        <td>{{ $service->price }}</td>
    </tr>
        @php $i++; @endphp
    @endforeach
        <tr>
            <td colspan="2">Усього:</td>
            <td colspan="3">{{ $visit->cost() }}грн.</td>
        </tr>
    </div>
    </tbody>
    <tfoot>
    <tr>
        <td style="border: 0;">
            <!--place holder for the fixed-position footer-->
            <div class="page-footer-space"></div>
        </td>
    </tr>
    <tr class="no-border">
        <td colspan="5" class="no-border">
            <div>Пацієнт <b>{{ $visit->visitor->full_name }}</b></div>
            <div style="display: flex"><div style="width: 50%">Телефон <b>{{ $visit->visitor->phone }}</b></div><div style="width: 50%">Дата <b>{{ date("d.m.Y", strtotime($visit->date)) }}</b></div></div>
            <div>E-mail <b>{{ $visit->visitor->email }}</b></div>
        </td>
    </tr>
    <tr>
        <td colspan="5" class="no-border">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="5" class="no-border">
            Даю згоду на обробку моїх персональних даних в електронній базі (згідно Закону України "Про захист персональних даних")<br><br>
            Підпис__________________________
        </td>
    </tr>
    </tfoot>
</table>
