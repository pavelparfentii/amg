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
            <label class="col-md-2 col-form-label" for="anamnez">Анамнез</label>
            <div class="col-md-10">
                <input type="text" name="anamnez" class="form-control" value="{{ isset($info) ? json_decode($info->value, true)['anamnez'] : ' ' }}">
            </div>
        </div>
        <div class="row mb-3">
            <labe for="pop_diagnoz" class="col-md-2 col-form-label">Попередній діагноз</labe>
            <div class="col-md-10">
                <textarea name="pop_diagnoz" class="form-control" rows="3">{{ isset($info) ? json_decode($info->value, true)['pop_diagnoz'] : ' ' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="recom_doobst" class="col-md-2 col-form-label">Рекомендоване дообстеження</label>
            <div class="col-md-10">
                <textarea name="recom_doobst" class="form-control" id="recom_doobst" rows="5">{{ isset($info) ? json_decode($info->value, true)['recom_doobst'] : ' ' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="vysnovok" class="col-md-2 col-form-label">Висновок</label>
            <div class="col-md-10">
                <textarea name="vysnovok" class="form-control" rows="4">{{ isset($info) ? json_decode($info->value, true)['vysnovok'] : ' ' }}</textarea>
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

