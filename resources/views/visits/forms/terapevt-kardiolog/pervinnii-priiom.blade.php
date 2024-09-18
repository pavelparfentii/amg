<div class="card-body">
    <form id="saveForm">
        @csrf
        <input type="hidden" value="{{ $specialist }}" name="specialist">
        <input type="hidden" value="{{ $form }}" name="form">
        <input type="hidden" value="{{ $visit->id }}" name="visit">
        <div class="row mb-3">
            <label for="skargy" class="col-md-2 col-form-label">Скарги при зверненні</label>
            <div class="col-md-10">
                <textarea name="skargy" class="form-control" rows="5">{{ isset($info) ? json_decode($info->value, true)['skargy'] : ' ' }}</textarea>
            </div>
        </div>
        <div class="row mb-3" style="padding-bottom: 10px">
            <label class="col-md-2 col-form-label" for="morbi">An.morbi</label>
            <div class="col-md-10">
                <input type="text" name="morbi" class="form-control" value="{{ isset($info) ? json_decode($info->value, true)['morbi'] : ' ' }}">
            </div>
        </div>
        <div class="row mb-3" style="padding-bottom: 10px">
            <label class="col-md-2 col-form-label" for="vitae">An.vitae</label>
            <div class="col-md-10">
                <input type="text" name="vitae" class="form-control" value="{{ isset($info) ? json_decode($info->value, true)['vitae'] : 'Гепатити, туберкульоз, цукровий діабет, виразкову хворобу заперечує' }}">
            </div>
        </div>
        <div class="row mb-3" style="padding-bottom: 10px">
            <div class="col-md-2">
                <label class="col-form-label">Анамнез</label>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <label class="col-md-2 col-form-label" for="alergoanamnez">Алергоанамнез</label>
                    <div class="col-md-10">
                        <input type="text" name="alergoanamnez" class="form-control" value="{{ isset($info) ? json_decode($info->value, true)['alergoanamnez'] : 'не обтяжений' }}">
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-2 col-form-label" for="operation">Операції</label>
                    <div class="col-md-10">
                        <input type="text" name="operation" class="form-control" value="{{ isset($info) ? json_decode($info->value, true)['operation'] : 'заперечує. Аппендектомія заперечує' }}">
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-2 col-form-label" for="zvychki">Шкідливі звички</label>
                    <div class="col-md-10">
                        <input type="text" name="zvychki" class="form-control" value="{{ isset($info) ? json_decode($info->value, true)['zvychki'] : 'не палить, алкоголем не зловживає' }}">
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-2 col-form-label" for="spadkovist">Спадковість</label>
                    <div class="col-md-10">
                        <input type="text" name="spadkovist" class="form-control" value="{{ isset($info) ? json_decode($info->value, true)['spadkovist'] : 'не обтяжена' }}">
                    </div>
                </div>
            </div>


        </div>
        <div class="row mb-3" style="padding-bottom: 10px">
            <label class="col-md-2 col-form-label" for="epidanamnez">Епіданамнез</label>
            <div class="col-md-10">
                <input type="text" name="epidanamnez" class="form-control" value="{{ isset($info) ? json_decode($info->value, true)['epidanamnez'] : 'підвищення  температури  тіла за останні 14 діб заперечує,   контакт   з лихорадячими хворими заперечує' }}">
            </div>
        </div>
        <div class="row mb-3" style="padding-bottom: 10px">
            <label class="col-md-2 col-form-label" for="obno">Об-но</label>
            <div class="col-md-10">
                <textarea rows="5" name="obno" class="form-control">{!! isset($info) ? nl2br(json_decode($info->value, true)['obno']) : 'Стан пацієнта задовільний. Свідомість ясна. Правильної статури, достатнього харчування, ІМТ - __кг/м2. Шкіра і видимі слизові оболонки чисті, бліді, ціанозу губ немає. Набряків немає. Периферичні лімфовузли не збільшені. Щитовидна залоза без патологічних ущільнень. Грудні залози без патологічних ущільнень. Аускультативно над легенями- дихання везикулярне, ЧДР = 16 в хв. Тони серця ритмічні, чіткі, АТ dex ____мм рт ст, АТ  sin  __ мм рт см  ЧСС = __ уд. за хв. РS = __ уд. за хв. Живіт м\'який, безболісний. Печінка не виступає з-під краю реберної дуги. Фізіологічні відправлення, сечовипускання, зі слів, без особливостей.' !!}</textarea>
            </div>
        </div>
        <div class="row mb-3" style="padding-bottom: 10px">
            <label class="col-md-2 col-form-label" for="ekg">ЕКГ Висн</label>
            <div class="col-md-10">
                <textarea rows="5" name="ekg" class="form-control">{!! isset($info) ? nl2br(json_decode($info->value, true)['ekg']) : 'Ритм синусовий, правильний. гострої вогнищевої патології немає' !!}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <labe for="pop_diagnoz" class="col-md-2 col-form-label">Попередній діагноз</labe>
            <div class="col-md-10">
                <textarea name="pop_diagnoz" class="form-control" rows="3">{!! isset($info) ? nl2br(json_decode($info->value, true)['pop_diagnoz']) : ' ' !!}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="recom_doobst" class="col-md-2 col-form-label">Рекомендоване дообстеження</label>
            <div class="col-md-10">
                <textarea name="recom_doobst" class="form-control" id="recom_doobst" rows="5">{{ isset($info) ? json_decode($info->value, true)['recom_doobst'] : ' ' }}</textarea>
            </div>
        </div>
        <div class="row mb-3" style="padding-bottom: 10px">
            <label class="col-md-2 col-form-label" for="recom">Рекомендації</label>
            <div class="col-md-10">
                <textarea name="recom" class="form-control" rows="5">{{ isset($info) ? nl2br(json_decode($info->value, true)['recom']) : 'дієта із обмеженням солі до 5 грам на добу, обмеження вживання тваринних жирів, та продуктів, які містять холестерин. Рекомендується дієта збагачена ω-3 поліненасиченими жирними кислотами (морська риба). При зайвій вазі обмежується енергетична цінність їжі.' }}</textarea>
            </div>
        </div>
        <div class="row mb-3" style="padding-bottom: 10px">
            <label class="col-md-2 col-form-label" for="pryzn">Призначення</label>
            <div class="col-md-10">
                <textarea rows="5" name="pryzn" class="form-control">{{ isset($info) ? nl2br(json_decode($info->value, true)['pryzn']) : ' ' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="new_oglyad" class="col-md-2 col-form-label">Повторний огляд: </label>
            <div class="col-md-10">
                <input type="text" name="new_oglyad" class="form-control" value="{{ isset($info) ? json_decode($info->value, true)['new_oglyad'] : '' }}">
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

