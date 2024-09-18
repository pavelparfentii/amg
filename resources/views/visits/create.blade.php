@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header border-bottom">Створення візиту на дату {{ date("d.m.Y", strtotime($visit->date)) }} у {{ $visit->cabinets->name }} на {{ $visit->time }}</div>
                <div class="card-body">
                    <form method="post" action="{{ route('visits.store', ['visit' => $visit->id]) }}">
                        @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="card-header">Час прийому</h5>
                            <div class="timeResult"></div>
                            <div class="card-body pb-5">
                                <div class="my-3" id="slider-pips"></div>
                            </div>
                            <div class="form-group">
                                <label for="likar" class="form-label">Лікар, що веде прийом</label>
                                <select name="likar" class="form-select" id="likar" required>
                                    <option value=""> -- Виберіть лікаря -- </option>
                                    @foreach($likars as $likar)
                                        <option value="{{ $likar->id }}">{{ $likar->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="service" class="form-label">Послуги</label>
                                <select name="service" class="form-select" id="service">
                                    <option value=""> -- Виберіть послугу -- </option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="patient" class="form-label">Пацієнт / співробітник</label>
                                <select name="patient" class="form-select" id="patient">
                                    <option value="1"> Пацієнт </option>
                                    <option value="0"> Співробітник </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="nav-align-top mb-4">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-new" aria-controls="navs-new" aria-selected="true">Новий пацієнт</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-isset" aria-controls="navs-isset" aria-selected="false" tabindex="-1">Існуючий</button>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="navs-new" role="tabpanel">
                                        <div class="form-group">
                                            <label for="last_name" class="form-label">Прізвище</label>
                                            <input type="text" name="last_name" id="last_name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name" class="form-label">Ім'я</label>
                                            <input type="text" name="first_name" id="first_name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="middle_name" class="form-label">По-батькові</label>
                                            <input type="text" name="middle_name" id="middle_name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name" class="form-label">Телефон</label>
                                            <input type="text" name="phone" id="phone" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="male" class="form-label">Пол</label>
                                            <select name="male" class="form-select" id="male">
                                                <option value="male"> Чол </option>
                                                <option value="female"> Жін </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show active" id="navs-isset" role="tabpanel">
                                        <div class="inwrap" id="CreditResult"></div>
                                        <div class="inwrap">
                                            <label for="visitor" class="form-label">Відвідувач:</label>
                                            <select id="visitorSearch" class="select2 form-select form-select-lg" data-allow-clear="true" name="visitor"></select>
                                        </div>
                                        <p>Пошук по ПІБ або по № картки</p>
                                        <div id="creditTable"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="from_likar" class="form-label">Хто направив</label>
                                <select name="from_likar" class="form-select" id="from_likar" required>
                                    @foreach($from_likars as $from_likar)
                                        <option value="{{ $from_likar->id }}">{{ $from_likar->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="padding-top: 25px">
                                <label class="switch switch-info">
                                    <input type="checkbox" class="switch-input" name="refferal" />
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on">
                                            <i class="bx bx-check"></i>
                                        </span>
                                        <span class="switch-off">
                                            <i class="bx bx-x"></i>
                                        </span>
                                    </span>
                                    <span class="switch-label">Зовнішнє направлення</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="description" class="form-label">Примітка</label>
                                <textarea name="description" id="description" class="form-control" rows="6"></textarea>
                            </div>
                            <div class="form-group" style="padding-top: 25px">
                                <button type="submit" class="btn btn-info">Зберегти</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        const o=document.getElementById("slider-pips");
        o&&noUiSlider.create(o,{
            start:[{{ $visit->timing * 15 }}],
            behaviour:"tap-drag",
            step:15,
            tooltips:!0,
            range:{
                min:15,max:60},
            pips:{
                mode:"steps",stepped:!0,density:5
            },
            direction:isRtl?"rtl":"ltr"
        });
       $(".noUi-target").on("mouseup", function(){
           var pips = $(".noUi-handle").attr('aria-valuenow');
           $.ajax({
              type: "POST",
               url: "{{ route('visits.pretiming', ['visit' => $visit->id]) }}",
               data: {'_token': '{{ csrf_token() }}', 'pips': pips},
               cache: false,
               success: function(response){
                    $(".timeResult").html(response);
               }
           });
       });
        $('#visitorSearch').select2({
            placeholder: 'Начните вводить имя..',
            language: "uk",
            ajax: {
                url: '{{ route('select2-ajax') }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.id + '. ' + item.full_name + ', др:' + item.birthday + ', тел:' + item.phone,
                                id: item.id
                            }
                        })
                    };
                    onItemSelect: selectItem();
                },
                cache: true
            }
        });

    });
</script>
@endsection
