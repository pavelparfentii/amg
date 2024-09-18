<div class="card-body">
    <form id="saveForm">
        @csrf
        <input type="hidden" value="{{ $specialist }}" name="specialist">
        <input type="hidden" value="{{ $form }}" name="form">
        <input type="hidden" value="{{ $visit->id }}" name="visit">
        <div class="row mb-3">
            <label for="zakl_diagnoz" class="col-md-2 col-form-label">Заключний діагноз</label>
            <div class="col-md-10">
                <textarea name="zakl_diagnoz" class="form-control" row="4">{{ isset($info) ? json_decode($info->value, true)['zakl_diagnoz'] : ' ' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="recomendation" class="col-md-2 col-form-label">Рекомендовано</label>
            <div class="col-md-10">
                <textarea name="recomendation" class="form-control" id="recom_doobst" rows="4">{{ isset($info) ? json_decode($info->value, true)['recomendation'] : ' ' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="vysnovok" class="col-md-2 col-form-label">Висновок</label>
            <div class="col-md-10">
                <textarea name="vysnovok" class="form-control" rows="4">{{ isset($info) ? json_decode($info->value, true)['vysnovok'] : ' ' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3">
            <button class="btn btn-outline-primary saveForm" type="submit">Зберегти</button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12" style="padding-top: 15px;">
            <a href="@if($info){{ route('visits.form_print', ['specialist' => $specialist, 'form' => $form, 'visit' => $visit]) }}@endif" class="btn btn-primary printForm" target="_blank">Друк</a>
        </div>
    </div>
</div>

