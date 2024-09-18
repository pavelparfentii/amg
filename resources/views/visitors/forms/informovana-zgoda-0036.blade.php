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
            margin-top: 7mm;
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
        <div class="empty">

        </div>
        <div class="forma center">
            <p>МЕДИЧНА ДОКУМЕНТАЦІЯ</p>
            <hr>
            <div>Форма первинної облікової документації</div>
            <div>№ 003-6/о</div>
            <p style="font-size:5mm;">ЗАТВЕРДЖЕНО<p>
            <div>Наказ Міністерства охорони здоров'я України<br>
                14 лютого 2012 року №110<br>
                (у редакції наказу Міністерства охорони здоров'я України<br>
                від 09 грудня 2020 року №2837</div>
        </div>
    </div>
    <div class="content zgoda">
        <p class="center"><b>ІНФОРМОВАНА ДОБРОВІЛЬНА ЗГОДА ПАЦІЄНТА НА ПРОВЕДЕННЯ ДІАГНОСТИКИ, ЛІКУВАННЯ ТА НА ПРОВЕДЕННЯ ОПЕРАЦІЇ ТА ЗНЕБОЛЕННЯ</b></p>
        <p class="indent">
            Я, ______________<u><b>{{ $visitor->full_name }}</b></u>_____________________ , одержав(ла)<br>
            у ______________<u><b>ТОВ "АМГ клінік медікал лаб"</b></u>_____________________ <br>
            <br>
            інформацію про характер мого (моєї дитини) захворювання, особливості його перебігу, діагностики та лікування.
        </p>
        <p class="indent" style="font-size: 2.7mm">
            Я ознайомлений(а) з планом обстеження і лікування. Отримав(ла) в повному обсязі роз’яснення про характер, мету, орієнтовну тривалість діагностично-лікувального процесу та про можливі несприятливі наслідки під час його проведення, про необхідність дотримання визначеного лікарем режиму в процесі лікування. Зобов’язуюсь негайно повідомляти лікуючого лікаря про будь-яке погіршення самопочуття (стану здоров’я дитини). Я поінформований(а), що недотримання рекомендацій лікуючого лікаря, режиму прийому призначених препаратів, безконтрольне самолікування можуть ускладнити лікувальний процес та негативно позначитися на стані здоров’я.
        </p>
        <p class="indent" style="font-size: 2.7mm">
            Мене проінформовано що під час повітряної тривоги треба покинути кабінет лікаря і консультація або процедура  буде перервана , якщо її можна перервати. Також мене проінформовано, що я повинен перейти в укриття і мені вказано план евакуації. Мене ознайомлене з правилами поведінки в умовах надзвичайної ситуаціі під час повітряної тривоги. Мені надали в доступній формі інформацію про ймовірний перебіг   і наслідки у разі відмови від евакуаціі.  Претензій до клініки та персоналу в разі відмови від евакуаціі не маю.
        </p>
        <p class="indent" style="font-size: 2.7mm">
            Мені надали в доступній формі інформацію про ймовірний перебіг захворювання і наслідки у разі відмови від лікування.
        </p>
        <p class="indent" style="font-size: 2.7mm">
            Я мав(ла) можливість задавати будь-які питання, які мене цікавлять, стосовно стану здоров’я, перебігу захворювання і лікування та одержав(ла) на них відповіді.
        </p>
        <p class="indent" style="font-size: 2.7mm">
            Я погоджуюсь із використанням та обробкою моїх персональних даних за умови дотримання їх захисту відповідно до вимог Закону України “Про захист персональних даних”.
        </p>
        <div>Інформацію надав лікар <span class="after pib">__________________</span><span class="after date">___<u><b>{{ date("d.m.Y", strtotime($visitor->date_add)) }} року</b></u>___</span><span class="after pidpis">_________________</span></div>
        <div style="padding-top: 15px">
            Я, {{ $visitor->full_name }}, згодний(а) із запропонованим планом лікування <br>
            <span class="after pidpis">_________________</span>    ___<u><b>{{ date("d.m.Y", strtotime($visitor->date_add)) }} року</b></u>___
        </div>
        <p>З правилами знаходження в медичному центрі ознайомлен(а)  ________________________</p>
    </div>
</div>
</body>
</html>
