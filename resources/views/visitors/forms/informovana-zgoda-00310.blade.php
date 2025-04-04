<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page{
            width: 21cm;
            height: 14cm;
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
            max-height: 14.2cm;
        }
        .second_block{
            margin-top: 3mm;
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
            width:55%;
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

<div class="block second_block">
    <div class="head flex">
        <div class="gov center">
            <div>Найменування міністерства, іншого органу виконавчої влади, підприємства, установи, організації, до сфери управління якого належитьзаклад охорони здоров’я</div>
            <div><b><u>Міністерство охорони здоров’я України</u></b></div>
            <div>Найменування та місцезнаходження (повна поштова адреса) закладу охорони здоров'я, де заповнюється форма</div>
            <div><b><u>ТОВ "АМГ клінік медікал лаб"
                        м.Харків, вул.Юри Зофера, 6</u></b></div>
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
        <div class="forma center">
            <p>МЕДИЧНА ДОКУМЕНТАЦІЯ</p>
            <hr>
            <div>Форма первинної облікової документації</div>
            <div>№ 003-10/о</div>
            <p style="font-size:5mm;">ЗАТВЕРДЖЕНО<p>
            <div>Наказ Міністерства охорони здоров'я України<br>
                від 15 вересня 2016 року №970</div>
        </div>
    </div>
    <div class="content zgoda">
        <p class="center"><b>УСВІДОМЛЕНА ЗГОДА ОСОБИ
                НА ЛІКУВАННЯ У ПСИХІАТРИЧНОМУ ЗАКЛАДІ</b></p>
        <p class="indent">
            Я, <u><b>{{ $visitor->full_name }}</b></u>, одержав(ла) у <u><b>ТОВ "АМГ клінік медікал лаб"</b></u></p>
        <p style="font-size: 3mm">
            інформацію щодо методів лікування та лікарських засобів, що можуть застосовуватися в процесі надання мені психіатричної допомоги, їх побічних ефектів, а також альтернативних методів лікування. Мені повідомлено, що при наданні мені психіатричної допомоги дозволено використовувати виключно методи лікування та ліки з доведеною ефективністю, допустимим рівнем безпеки, використання яких є економічно прийнятним, та відповідно до вимог клінічного протоколу. Мені повідомлено, що використання методів лікування та лікарських засобів з недоведеною ефективністю можливе виключно після отримання моєї письмової згоди та після отримання мною інформації про цілі, побічні ефекти, можливий ризик та очікувані результати. Мені повідомлено, що всі лікарські засоби потенційно можуть спричинити алергічні реакції. Мені повідомлено, що методи лікування і лікарські засоби, що становлять підвищений ризик для мого здоров’я, застосовуються за призначенням і під контролем комісії лікарів-психіатрів після погодження зі мною. Мені повідомлено, що я маю право на участь в обговоренні методів лікування та лікарських засобів, на вільний вибір методів лікування та лікарських засобів відповідно до рекомендацій лікаря. Мені повідомлено, що лікар зобов’язаний надати мені достовірну та своєчасну інформацію про особливості застосування та побічні ефекти методів лікування і лікарських засобів, що мною обрані для мого лікування. Мені повідомлено, що я зобов’язаний(а) дотримуватись рекомендацій лікаря, надавати повну та правдиву інформацію щодо історії мого захворювання, повідомляти про всі лікарські засоби, які приймав(ла) або приймаю, відомі мені алергічні реакції, розповідати про будь-які зміни у моєму стані. Мені повідомлено, що лікар не несе відповідальності за моє здоров'я у разі моєї відмови від медичних приписів або порушення встановленого для мене режиму. Мені повідомлено про моє право відмовитись від лікування в будь-який момент. Мені повідомлено, що фахівцям, яких залучено до мого лікування, заборонено розголошувати інформацію щодо методів лікування і лікарських засобів, що були до мене застосовані, а також про інші відомості, крім випадків, передбачених законом.
        </p>
        <p class="indent" style="font-size: 3mm">
            Підписуючи цей документ, я надаю усвідомлену згоду на лікування у психіатричному закладі.
        </p>
        <p class="indent" style="font-size: 3mm">
            Підписуючи цей документ, я повідомляю, що моє рішення не було прийнято під тиском з боку фахівця, родини або інших осіб.
        </p>
        <div style="padding-top: 2mm; padding-bottom: 2mm">
            Я, {{ $visitor->full_name }}, згоден(на) на лікування у психіатричному закладі. <br>
            <span class="after pidpis">_________________</span>    ___<u><b>{{ date("d.m.Y", strtotime($visitor->date_add)) }} року</b></u>___
        </div>
        <div>Інформацію надав лікар <span class="after pib">__________________</span><span class="after date">___<u><b>{{ date("d.m.Y", strtotime($visitor->date_add)) }} року</b></u>___</span><span class="after pidpis">_________________</span></div>
    </div>
</div>
</body>
</html>
