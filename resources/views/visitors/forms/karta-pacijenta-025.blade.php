<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page{
            width: 21cm;
            height: 14cm;
            margin: 2cm 2cm;
        }
        body {
            font-family: "Times New Roman", DejaVu Sans, sans-serif;
            font-size: 3.5mm;
            line-height: 1;
            color: #444;
            box-sizing: border-box;
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
            border: .3mm solid #444;
            max-height: 14cm;
        }
        u{
            position: relative;
            top: .3mm;
        }
        .center{
            text-align: center;
        }
        .flex{
            flex-wrap: wrap;
            display:flex;
            flex-direction: row;
            justify-content: space-between;
        }
        .head {
            border-bottom: .3mm solid #444;
            width: 100%;
            align-items: stretch;
        }
        .gov{
            width:35%;
            border-right: .3mm solid #444;
            padding: 3mm;
        }
        .empty{
            width:18%;
            border-right: .3mm solid #444;
        }

        .forma{
            width:35%;
            padding: 3mm;
            border-left: .3mm solid #444;
        }
        .content{
            padding:3mm;
            min-height: 97.5mm;
        }
        .line{
            line-height: 1.5;
        }
        .after{
            position:relative;
        }
        .after:after{
            width: 100%;
            position: absolute;
            top: 100%;
            left: 0;
            font-size: 2.5mm;
            text-align: center;
        }
        .chislo:after{
            content:"(число, місяць, рік)";
        }
        .pib:after{
            content:"(П.І.Б.)";
        }
        .date:after{
            content:"Дата";
        }
        .pidpis:after{
            content:"Пiдпис";
        }
        .second_chislo{
            display:inline-block;
            margin-left: 30mm;
        }
        .edrpou{
            display:flex;
        }
        .edrpou span{
            display:inline-block;
            padding: 1mm 2mm;
            border:.3mm solid #444;
            margin-left: -.3mm;
            font-size: 5mm;
        }
    </style>
</head>
<body>
<div class="block">
    <div class="head flex">
        <div class="gov center">
            <div>Найменування міністерства, іншого органу виконавчої влади, підприємства, установи, організації, до сфери управління якого належитьзаклад охорони здоров’я</div>
            <div><b><u>Міністерство охорони здоров’я України</u></b></div>
            <div>Найменування та місцезнаходження (повна поштова адреса) закладу охорони здоров'я, де заповнюється форма</div>
            <div><b><u>ТОВ "АМГ клінік медікал лаб"
                        м.Харків, вул.Юри Зойфера, 6</u></b></div>
            <div style="text-align: left;">Код за ЄДРПОУ</div>
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
        </div>
        <div class="barcode">
            <p style="text-align: center; margin-top:10px; font-size: 18px"></p>
        </div>
        <div class="forma center">
            <p>МЕДИЧНА ДОКУМЕНТАЦІЯ</p>
            <hr>
            <div>Форма первинної облікової документації</div>
            <div>№ 025/о</div>
            <p style="font-size:5mm;">ЗАТВЕРДЖЕНО<p>
            <div>Наказ МОЗ України<br>
                14 лютого 2012 року №110</div>
        </div>
    </div>
    <div class="content zgoda">
        <p class="center"><b>МЕДИЧНА КАРТА АМБУЛАТОРНОГО ХВОРОГО № <span style="font-size: 5mm"> {{ $visitor->id }}</span></b></p>
        <div class="flex line">
            <div>1.Код хворого_______</div>
            <div>Дата заповнення карти  ___<u><b>{{ date("d.m.Y", strtotime($visitor->date_add)) }}</b></u>___</div>
        </div>
        <div class="line">. Прізвище, ім’я, по батькові ________<u><b>{{ $visitor->full_name }}</b></u>________</div>
        <div class="flex line">
            <div>2. Стать: чол. – 1 , жін. – 2
                @if($visitor->male == 'male'){ <b><u>1</u></b> } @endif
                @if($visitor->male == 'female'){ <b><u>2</u></b> } @endif
                @if($visitor->male == '') { _ } @endif
            </div>
            <div>3. Дата народження ___<b><u>{{ \Carbon\Carbon::parse($visitor->birthday)->format("d.m.Y") }}</u></b>___ </div>
            <div>4. Телефон дом. ___<b><u>{{ $visitor->phone }}</u></b>___ служб.____________</div>
        </div>
        <div class="line">5. Адреса ____<u><b>{{ $visitor->adress }}</b></u>_____</div>
        <div class="line">6. Місце роботи, посада________________________________________</div>
        <div class="line">7. Диспансерна група (так – 1, ні – 2) □</div>
        <div class="line">8. Контингенти: інваліди війни – 1; учасники війни – 2; учасники бойових дій – 3; інші інваліди – 4; ліквідатори аварії на ЧАЕС – 5; евакуйовані – 6; жителі, які проживають  на території радіоекологічного контролю – 7; діти, які народилися від батьків 1-3 груп, постраждалих від аварії на ЧАЕС – 8; інші пільгові категорії – 9 (вписати)__________________ □</div>
        <div class="line">9. Номер пільгового посвідчення___________________</div>
        <div class="line flex">
            <div>
                10. Взятий(а) на облік<span class="after chislo">_________________</span>  з приводу___________
                <br>
                <br>
                <span class="after chislo second_chislo">_________________</span>  з приводу___________

            </div>
            <div>
                11. Знятий(а) з обліку<span class="after chislo">_________________</span> (причина )_______
                <br>
                <br>
                <span class="after chislo second_chislo">_________________</span> (причина )_______
            </div>
        </div>
        <br>
    </div>
</div>
</body>
</html>
