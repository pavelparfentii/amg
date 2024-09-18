<div class="card-body">
    <form id="saveForm">
        @csrf
        <input type="hidden" value="{{ $specialist }}" name="specialist">
        <input type="hidden" value="{{ $form }}" name="form">
        <input type="hidden" value="{{ $visit->id }}" name="visit">
        <div class="row mb-3">
            <label for="skargy" class="col-md-2 col-form-label">Скарги при зверненні</label>
            <div class="col-md-10">
                <textarea name="skargy" class="form-control" rows="10">{{ isset($info) ? json_decode($info->value, true)['skargy'] : 'прийшов(ла) на плановий огляд, турбують' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="vitae" class="col-md-2 col-form-label">An.vitae</label>
            <div class="col-md-10">
                <textarea name="vitae" class="form-control" id="vitae" rows="4">{{ isset($info) ? json_decode($info->value, true)['vitae'] : 'Хворобу Боткіна, туберкульоз, цукровий діабет, виразкову хворобу заперечує' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="morbi" class="col-md-2 col-form-label">An.morbi</label>
            <div class="col-md-10">
                <textarea name="morbi" id="morbi" class="form-control" rows="4">{{ isset($info) ? json_decode($info->value, true)['morbi'] : ' ' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <h4 class="form_title col-md-2">Анамнез</h4>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="alergoanamnez" class="form-label">Алергоанамнез</label>
                    <input type="text" name="alergoanamnez" class="form-control" value="{{ isset($info) ? json_decode($info->value, true)['alergoanamnez'] : 'не обтяжений' }}">
                </div>
                <div class="col-md-6">
                    <label for="operations">Операції</label>
                    <input type="text" name="operations" class="form-control" value="{{ isset($info) ? json_decode($info->value, true)['operations'] : 'заперечує. Аппендектомія заперечує' }}">
                </div>
                <div class="col-md-6">
                    <label for="shk_zv">Шкідливі звички</label>
                    <input type="text" name="shk_zv" class="form-control" value="{{ isset($info) ? json_decode($info->value, true)['shk_zv'] : 'не палить, алкоголем не зловживає' }}">
                </div>
                <div class="col-md-6">
                    <label for="spadkovist">Спадковість</label>
                    <input type="text" name="spadkovist" class="form-control" value="{{ isset($info) ? json_decode($info->value, true)['spadkovist'] : 'не обтяжена' }}">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="psst" class="col-md-2 col-form-label">Об-но</label>
            <div class="col-md-10">
                <textarea name="obno" class="form-control" id="obno" rows="6">{{ isset($info) ? json_decode($info->value, true)['obno'] : 'Стан пацієнта задовільний. Свідомість ясна. Правильної статури, достатнього харчування ІМТ ___кг/м2. Шкіра і видимі слизові оболонки чисті, блідо-рожеві, ціанозу губ немає. Периферичних набряків немає. АТ dex ___мм рт ст, АТ sin ___мм рт см ЧСС = ___уд. за хв. РS= ___уд. за хв. Фізіологічні відправлення, сечовипускання, зі слів, без особливостей.' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="pop_diagnoz" class="col-md-2 col-form-label">Неврологічний статус</label>
            <div class="col-md-10">
                <textarea name="status" class="form-control" rows="6">{!! isset($info) ? nl2br(json_decode($info->value, true)['status']) : 'Голова рухається вільно, немає менінгізму. Немає болючості супра- та інфраорбітальних точок.'."\r\n".'Каротидна пульсація достатня з обох боків. Рухи очними яблуками в повному обсязі та координовані. Патологічного ністагму немає; очні щілини однакові, птозу немає'."\r\n".'Зіниці однакові, круглі, середнього розміру, симетричні, з швидкою реакцією на освітлення та конвергенцію. Чутливість на обличчі не порушена. Слух суб’єктивно нормальний.'."\r\n".'М\'яке піднебіння симетричне у спокої, піднімається симетрично. Глотковий рефлекс не порушений. Ковтання суб’єктивно не порушене. Сила грудино-ключично-сосцевидного м’язу достатня, симетрична'."\r\n".'Язик симетричний, висувається по середній лінії, вільно рухається, атрофій та фібрилярних посіпувань м’язів язика немає. Мова (вимовляння, артикуляція) не порушена, чітка.'."\r\n".'Обсяг  кінцівок нормальний. Тонус м’язів нормальний з обох боків. Пальце-носову пробу виконує точно, немає інтенційного тремтіння. Немає тремтіння пальців у спокої. Хребет без зауважень, не болючий при перкусії в будь-якому відділі. Чутливість тулуба не порушена'."\r\n".'Шкірні черевні рефлекси викликаються симетрично'."\r\n".'Рефлекси: колінний рефлекс симетричний, середньої сили'."\r\n".'рефлекс Ахілова сухожилка симетричний, середньої сили'."\r\n".'підошовний (згинальний) рефлекс симетричний'."\r\n".'рефлекси Бабінського, Опенгейма, Гордона, Россолімо, Бехтєрєва,'."\r\n".'Больова чутливість з обох боків не порушена'."\r\n".'Тест Ромберга негативний (при різних положеннях голови)' !!}
                </textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="recom_doobst" class="col-md-2 col-form-label">Психічний стан</label>
            <div class="col-md-10">
                <textarea name="stan" class="form-control">{{ isset($info) ? json_decode($info->value, true)['stan'] : 'в цілому не порушений (без додаткового тестування).' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="recom_doobst" class="col-md-2 col-form-label">Діагноз</label>
            <div class="col-md-10">
                <textarea name="diagnoz" class="form-control">{{ isset($info) ? json_decode($info->value, true)['diagnoz'] : '' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="recom_doobst" class="col-md-2 col-form-label">Рекомендації</label>
            <div class="col-md-10">
                <textarea name="recom_doobst" class="form-control" id="recom_doobst">{{ isset($info) ? json_decode($info->value, true)['recom_doobst'] : ' ' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="recom_doobst" class="col-md-2 col-form-label">Призначення</label>
            <div class="col-md-10">
                <textarea name="pryznachennya" class="form-control">{{ isset($info) ? json_decode($info->value, true)['pryznachennya'] : '' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3">
                <button class="btn btn-outline-primary saveForm" type="submit">Зберегти</button>
            </div>
        </div>
    </form>
    <div class="row mb-3">
        <div class="col-md-12" style="padding-top: 15px;">
            <a href="@if($info){{ route('visits.form_print', ['specialist' => $specialist, 'form' => $form, 'visit' => $visit]) }}@endif" class="btn btn-primary printForm" target="_blank">Друк</a>
        </div>
    </div>
</div>

