<div class="card-body">
    <form id="saveForm">
        @csrf
        <input type="hidden" value="{{ $specialist }}" name="specialist">
        <input type="hidden" value="{{ $form }}" name="form">
        <input type="hidden" value="{{ $visit->id }}" name="visit">
        <div class="row mb-3">
            <label class="col-form-label col-md-2">Скарги при зверненні</label>
            <div class="col-md-10">
                <textarea name="skargy" class="form-control" rows="10">{{ isset($info) ? json_decode($info->value, true)['skargy'] : ' ' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-form-label col-md-2">Ps.St</label>
            <div class="col-md-10">
                <textarea name="psst" class="form-control">{{ isset($info) ? json_decode($info->value, true)['psst'] : ' ' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-form-label col-md-2">Попередній діагноз</label>
            <div class="col-md-10">
                <textarea name="pop_diagnoz" class="form-control">{{ isset($info) ? json_decode($info->value, true)['pop_diagnoz'] : ' ' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-form-label col-md-2">Рекомендоване дообстеження</label>
            <div class="col-md-10">
                <textarea name="recom_doobst" class="form-control" id="recom_doobst">{{ isset($info) ? json_decode($info->value, true)['recom_doobst'] : ' ' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-form-label col-md-2">Рекомендоване лікування</label>
            <div class="col-md-10">
                <textarea name="recomendation" class="form-control" >{{ isset($info) ? json_decode($info->value, true)['recomendation'] : ' ' }}</textarea>
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

