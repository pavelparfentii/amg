@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header">
                    Інформація по візиту
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Пацієнт <b>{{ $visit->visitor->full_name }}</b>, візит {{ date("d.m.Y", strtotime($visit->date)) }}, {{ $visit->time }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="nav-align-top mb-4">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-info" aria-controls="navs-info" aria-selected="true">Інформація про пацієнта</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-history" aria-controls="navs-history" aria-selected="false" tabindex="-1">Історія відвідувань</button>
                                </li>
                                @foreach($user->likarSpecialist as $specialist)
                                    <li class="nav-item" role="presentation">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-{{ $specialist->specialist->alias }}" aria-controls="navs-{{ $specialist->specialist->alias }}" aria-selected="false" tabindex="-1">{{ $specialist->specialist->name }}</button>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="navs-info" role="tabpanel">
                                    <div class="card-datatable table-responsive">
                                        <table class="table-bordered table">
                                            <tr>
                                                <td>ПІБ</td>
                                                <td>{{ $visit->visitor->full_name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Стать</td>
                                                <td>{{ $visit->visitor->male }}</td>
                                            </tr>
                                            <tr>
                                                <td>Дата народження</td>
                                                <td>{{ date("d.m.Y", strtotime($visit->visitor->birthday)) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Телефон</td>
                                                <td>{{ $visit->visitor->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td>Адреса</td>
                                                <td>{{ $visit->visitor->adress }}</td>
                                            </tr>
                                            <tr>
                                                <td>E-mail</td>
                                                <td>{{ $visit->visitor->email }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="navs-history" role="tabpanel">
                                    <div class="card-datatable table-responsive">
                                        <table class="table-bordered-top table">
                                            <thead>
                                            <th>Дата</th>
                                            <th>Час</th>
                                            <th>Лікар</th>
                                            <th>Дії</th>
                                            </thead>
                                            <tbody>
                                                @foreach($visit->visitor->histories as $history)
                                                <tr>
                                                    <td>{{ date("d.m.Y", strtotime($history->date)) }}</td>
                                                    <td>{{ $history->time }}</td>
                                                    <td>{{ $history->likars->name }}</td>
                                                    <td><a href="{{ route('visits.history_show', ['visit' => $history->id]) }}" target="_blank"><i class="bx bx-sm bx-search-alt-2"></i> </a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @foreach($user->likarSpecialist as $specialist)
                                    <div class="tab-pane fade" id="navs-{{ $specialist->specialist->alias }}" role="tabpanel">
                                        <form method="post" class="form-group" data-specialist="{{ $specialist->specialist->alias }}">
                                            @csrf
                                        <div class="row mb-3">
                                            <div class="col-md-9">
                                                <input type="hidden" name="specialist" value="{{ $specialist->specialist->alias }}">
                                                <input type="hidden" name="visit" value="{{ $visit->id }}">
                                                <div class="form-group">
                                                    <select name="form" class="form-select form_name">
                                                        @foreach($specialist->specialist->forms as $form)
                                                        <option value="{{ $form->slug }}">{{ $form->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-outline-primary">Обрати</button>
                                            </div>
                                        </div>
                                        </form>
                                        <div id="{{ $specialist->specialist->alias }}_result"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
           $(".form-group").submit(function(e){
               var specialist = $(this).data('specialist');
               e.preventDefault();
               var form = $(this);
               $.ajax({
                   type: 'POST',
                   url: '/visits/form_select',
                   data: form.serialize(),
                   cache: false,
                   success: function (response) {
                       $("#" + specialist + "_result").html(response);
                   }
               });
           });
           $("body").on("submit", "#saveForm", function(e){
               e.preventDefault();
               var result_form = $(this);
               $.ajax({
                   url: "{{ route('visits.info_store') }}",
                   type: "POST",
                   data: result_form.serialize(),
                   success: function(response){
                       $(".printForm").attr('href', response);
                   }
               });
           });
        });
    </script>
@endsection
