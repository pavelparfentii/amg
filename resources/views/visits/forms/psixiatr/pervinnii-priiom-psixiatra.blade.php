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
            <label class="col-md-2 col-form-label" for="vitae">An.Vitae</label>
            <div class="col-md-10">
                <textarea type="text" name="vitae" class="form-control">{{ isset($info) ? json_decode($info->value, true)['vitae'] : ' ' }}</textarea>
            </div>
        </div>
        <div class="row mb-3" style="padding-bottom: 10px">
            <label class="col-md-2 col-form-label" for="morbi">An.Morbi</label>
            <div class="col-md-10">
                <textarea type="text" name="morbi" class="form-control">{{ isset($info) ? json_decode($info->value, true)['morbi'] : ' ' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <h4 class="form_title col-md-2">Анамнез</h4>
            <div class="col-md-10">
                <label for="alergoanamnez">Алергоанамнез</label>
                <input type="text" name="alergoanamnez" class="form-control" value="{{ isset($info) ? json_decode($info->value, true)['alergoanamnez'] : 'не обтяжений' }}">
            </div>
            <div class="col-md-2"></div> <div class="col-md-10">
                <label for="operations">Операції</label>
                <input type="text" name="operations" class="form-control" value="{{ isset($info) ? json_decode($info->value, true)['operations'] : 'заперечує. Аппендектомія заперечує' }}">
            </div>
            <div class="col-md-2"></div> <div class="col-md-10">
                <label for="shk_zv">Шкідливі звички</label>
                <input type="text" name="shk_zv" class="form-control" value="{{ isset($info) ? json_decode($info->value, true)['shk_zv'] : 'не палить, алкоголем не зловживає' }}">
            </div>
            <div class="col-md-2"></div> <div class="col-md-10">
                <label for="spadkovist">Спадковість</label>
                <input type="text" name="spadkovist" class="form-control" value="{{ isset($info) ? json_decode($info->value, true)['spadkovist'] : 'не обтяжена' }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="psst" class="col-md-2 col-form-label">Ps.St</label>
            <div class="col-md-10">
                <textarea name="psst" class="form-control">{{ isset($info) ? json_decode($info->value, true)['psst'] : ' ' }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="pop_diagnoz" class="col-md-2 col-form-label">Попередній діагноз</label>
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
            <label class="col-md-2 col-form-label">Рекомендоване лікування</label>
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
    <div class="row mb-3">
        <div class="col-md-12" style="padding-top: 15px;">
            <a href="@if($info){{ route('visits.form_print', ['specialist' => $specialist, 'form' => $form, 'visit' => $visit]) }}@endif" class="btn btn-primary printForm" target="_blank">Друк</a>
        </div>
    </div>
</div>

