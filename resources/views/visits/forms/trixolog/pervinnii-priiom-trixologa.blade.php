<div class="card-body">
    <form id="saveForm">
        @csrf
        <input type="hidden" value="{{ $specialist }}" name="specialist">
        <input type="hidden" value="{{ $form }}" name="form">
        <input type="hidden" value="{{ $visit->id }}" name="visit">
        <div class="row mb-2">
            <label class="col-form-label col-md-2" for="skargy">Скарги при зверненні</label>
            <div class="col-md-10">
                <textarea name="skargy" id="skargy" class="form-control">{{ isset($info) ? json_decode($info->value, true)['skargy'] : '' }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-form-label col-md-2" for="morbi">An.morbi</label>
            <div class="col-md-10">
                <textarea name="morbi" id="morbi" class="form-control">{{ isset($info) ? json_decode($info->value, true)['morbi'] : '' }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-form-label col-md-2" for="vitae">An.vitae</label>
            <div class="col-md-10">
                <textarea name="vitae" class="form-control">{{ isset($info) ? json_decode($info->value, true)['vitae'] : 'цукровий діабет, гепатит В, С, tbc , Lues , інші інфекційні захворювання, виразкову хворобу шлунка, дванадцятипалої кишки – заперечує' }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-form-label col-md-2" for="endo_status">Ендокринологічний статус</label>
            <div class="col-md-10">
                <textarea name="endo_status" class="form-control">{{ isset($info) ? json_decode($info->value, true)['endo_status'] : '' }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-form-label col-md-2" for="shkt">ШКТ</label>
            <div class="col-md-10">
                <textarea name="shkt" class="form-control">{{ isset($info) ? json_decode($info->value, true)['shkt'] : '' }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-form-label col-md-2" for="gin_status">Гінекологічний статус</label>
            <div class="col-md-10">
                <textarea name="gin_status" class="form-control" id="gin_status">{{ isset($info) ? json_decode($info->value, true)['gin_status'] : '' }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-form-label col-md-2" for="other">Інші захорювання</label>
            <div class="col-md-10">
                <textarea name="other" class="form-control">{{ isset($info) ? json_decode($info->value, true)['other'] : '' }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-form-label col-md-2" for="shk_zv">Шкідливі звички</label>
            <div class="col-md-10">
                <textarea name="shk_zv" class="form-control">{{ isset($info) ? json_decode($info->value, true)['shk_zv'] : '' }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-form-label col-md-2" for="alergoanamnez">Алергоанамнез</label>
            <div class="col-md-10">
                <textarea name="alergoanamnez" class="form-control">{{ isset($info) ? json_decode($info->value, true)['alergoanamnez'] : '' }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-form-label col-md-2" for="obno">Об'єктивно</label>
            <div class="col-md-10">
                <textarea name="obno" class="form-control">{{ isset($info) ? nl2br(json_decode($info->value, true)['obno']) : '' }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-form-label col-md-2" for="zag_stan">Загальний стан</label>
            <div class="col-md-10">
                <textarea name="zag_stan" class="form-control">{{ isset($info) ? json_decode($info->value, true)['zag_stan'] : 'задовільний' }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-form-label col-md-2" for="vyd_slyzovi">Видимі слизові</label>
            <div class="col-md-10">
                <textarea name="vyd_slyzovi" class="form-control">{{ isset($info) ? json_decode($info->value, true)['vyd_slyzovi'] : 'без особливостей. Фізіологічні відправлення без особливостей' }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-form-label col-md-2" for="localis">Status localis</label>
            <div class="col-md-10">
                <textarea name="localis" class="form-control">{{ isset($info) ? nl2br(json_decode($info->value, true)['localis']) : '' }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-form-label col-md-2" for="pop_diagnoz">Попередній діагноз</label>
            <div class="col-md-10">
                <textarea name="pop_diagnoz" class="form-control">{{ isset($info) ? nl2br(json_decode($info->value, true)['pop_diagnoz']) : '' }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-form-label col-md-2" for="obstegennya">Обстеження</label>
            <div class="col-md-10">
                <textarea name="obstegennya" class="form-control">{{ isset($info) ? nl2br(json_decode($info->value, true)['obstegennya']) : '' }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-form-label col-md-2" for="pruznachennya">Призначення</label>
            <div class="col-md-10">
                <textarea name="pruznachennya" class="form-control">{{ isset($info) ? nl2br(json_decode($info->value, true)['pruznachennya']) : '' }}</textarea>
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

