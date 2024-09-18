<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page{
            width: 21cm;
            height: 29.7cm;
        }
        body {
            font-family: "Times New Roman", DejaVu Sans, sans-serif;
            font-size: 3.5mm;
            line-height: 1;
            color: #444;
            box-sizing: border-box;
            margin: 0;
        }
        body *{
            box-sizing: border-box;
        }
        p{
            margin-block-start: 1.5mm;
            margin-block-end: 1.5mm;
        }
        .block {
            width: 100%;
            height: 29.7cm;
            background: url('/images/100-2.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: top;
            position: relative;
        }
        .med_name{
            position: absolute;
            top: 2cm;
            left: 1.5cm;
            width: 8cm;
            text-align: center;
            font-size: 5mm;
        }
        .edrpou{
            display:flex;
            position: absolute;
            top: 6.1cm;
            left: 4cm;
            padding-left: 2mm;
        }
        .edrpou span{
            display:inline-block;
            padding: 1mm 1.6mm;
            font-size: 7mm;
        }
        .number{
            position: absolute;
            top: 9.4cm;
            left: 8cm;
            font-size: 5mm;
        }
        .date_oglyad{
            position: absolute;
            top: 10.2cm;
            left: 5.5cm;
            padding-left: 2.5mm;
        }
        .date_oglyad span{
            display:inline-block;
            padding: 1mm 0.9mm;
            font-size: 6mm;
        }
        .time_oglyad{
            position: absolute;
            top: 10.2cm;
            left: 17.7cm;
            padding-left: 2.5mm;
        }
        .time_oglyad span{
            display:inline-block;
            padding: 1mm 0.9mm;
            font-size: 6mm;
        }
        .name{
            position: absolute;
            top: 12cm;
            left: 1cm;
            font-size: 6mm;
        }
        .birthday{
            position: absolute;
            top: 12.9cm;
            left: 5.5cm;
            padding-left: 2.5mm;
        }
        .birthday span{
            display:inline-block;
            padding: 1mm 0.9mm;
            font-size: 6mm;
        }
        .male{
            position: absolute;
            top: 13.1cm;
            left: 19.2cm;
            font-size: 6mm;
        }
        .address{
            position: absolute;
            top: 14.7cm;
            left: 1cm;
            font-size: 5mm;
        }
    </style>
</head>
<body>
<div class="block">
    <div class="med_name">
        <b><u>ТОВ "АМГ клінік медікал лаб"
                м.Харків, вул.Юри Зофера, 6</u></b>
    </div>
    <div class="edrpou">
        <span>4</span>
        <span>5</span>
        <span>2</span>
        <span>8</span>
        <span>3</span>
        <span>4</span>
        <span>9</span>
        <span>4</span>
    </div>
    <div class="number"><b>{{ $visitor->id }}</b></div>
    <div class="date_oglyad">
        <span>0</span>
        <span>2</span>
        <span>0</span>
        <span>4</span>
        <span>2</span>
        <span>0</span>
        <span>2</span>
        <span>4</span>
    </div>
    <div class="time_oglyad">
        <span>0</span>
        <span>9</span>
        <span>1</span>
        <span>5</span>
    </div>
    <div class="name">
        {{ $visitor->full_name }}
    </div>
    <div class="birthday">
        <span>{{ substr(date("dmY", strtotime($visitor->birthday)), 0, 1) }}</span>
        <span>{{ substr(date("dmY", strtotime($visitor->birthday)), 1, 1) }}</span>
        <span>{{ substr(date("dmY", strtotime($visitor->birthday)), 2, 1) }}</span>
        <span>{{ substr(date("dmY", strtotime($visitor->birthday)), 3, 1) }}</span>
        <span>{{ substr(date("dmY", strtotime($visitor->birthday)), 4, 1) }}</span>
        <span>{{ substr(date("dmY", strtotime($visitor->birthday)), 5, 1) }}</span>
        <span>{{ substr(date("dmY", strtotime($visitor->birthday)), 6, 1) }}</span>
        <span>{{ substr(date("dmY", strtotime($visitor->birthday)), 7, 1) }}</span>
    </div>
    <div class="male">
        @if($visitor->male == 'male') 1 @endif
        @if($visitor->male == 'female') 2 @endif
    </div>
    <div class="address">
        {{ $visitor->adress }}
    </div>
</div>
</body>
</html>
