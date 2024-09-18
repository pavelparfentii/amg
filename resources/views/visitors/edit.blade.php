@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light"><a href="{{ route('visitors.index') }}">Пацієнти</a> / Перегляд </span>
            </h4>
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="user-avatar-section">
                                <div class=" d-flex align-items-center flex-column">
                                    <img class="img-fluid rounded my-4" src="{{ asset('images/user_icon.jpg') }}" height="110" width="110" alt="User avatar" />
                                    <div class="user-info text-center">
                                        <h4 class="mb-2">{{ $visitor->full_name }}</h4>
                                        <span class="badge bg-label-secondary">{{ date("d.m.Y", strtotime($visitor->birthday)) }}</span>
                                    </div>
                                </div>
                            </div>
                            <h5 class="pb-2 border-bottom mb-4">Деталі</h5>
                            <div class="info-container">
                                <ul class="list-unstyled">
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Баланс:</span>
                                        <span class="balance_result">{{ $visitor->balances() }} грн.</span>
                                        <span class="balance-add cursor-pointer" data-bs-toggle="modal" data-bs-target="#smallModal"><i class="bx bxs-plus-circle" title="Поповнити баланс"></i> </span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Ім'я:</span>
                                        <span>{{ $visitor->full_name }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Email:</span>
                                        <span>{{ $visitor->email }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Телефон:</span>
                                        <span>{{ $visitor->phone }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Адреса:</span>
                                        <span>{{ $visitor->adress }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Примітка:</span>
                                        <span>{{ $visitor->descriotion }}</span>
                                    </li>
                                </ul>
                                <div class="d-flex justify-content-center pt-3">
                                    <a href="" class="btn btn-primary me-3" data-id="{{ $visitor->id }}" data-bs-target="#editVisitor" data-bs-toggle="modal">Редагувати</a>
                                </div>
                                <div class="d-flex justify-content-center pt-3">
                                    <a href="{{ route('visitors.print', ['visitor' => $visitor->id]) }}" class="bx bx-lg bx-printer" title="Друк"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-promo" aria-controls="navs-promo" aria-selected="true">Промоакції</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-history" aria-controls="navs-history" aria-selected="false" tabindex="-1">Історія відвідувань</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="navs-promo" role="tabpanel">
                                <div class="card-header">
                                    <h5 class="card-title">Промоакція</h5>
                                </div>
                                <form method="post" id="promoAdd" style="padding-bottom: 25px">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label for="promo" class="form-label">Промоакція</label>
                                            <select name="promo" class="form-select" id="promo">
                                                @foreach($promos as $promo)
                                                    <option value="{{ $promo->id }}">{{ $promo->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3" style="padding-top: 30px">
                                            <button type="submit" class="btn btn-primary">Додати</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive" id="tableResult">
                                    <table class="table border-top table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-nowrap">Промоакція</th>
                                                <th class="text-nowrap text-center">Дата додавання</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($visitor->promo as $promo)
                                            <tr>
                                                <td>{{ $promo->promo->name }}</td>
                                                <td>{{ date("d.m.Y", strtotime($promo->date_add)) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-history" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table border-top table-striped">
                                        <thead>
                                            <th>#</th>
                                            <th>Дата візиту / Час</th>
                                            <th>Лікар</th>
                                            <th>Сума візиту</th>
                                            <th>Сума оплати</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                        @foreach($visitor->histories as $history)
                                            <tr>
                                                <td>{{ $history->id }}</td>
                                                <td>{{ date("d.m.Y", strtotime($history->date)) }} / {{ $history->time }}</td>
                                                <td>{{ $history->likars->name }}</td>
                                                <td>{{ $history->cost() }}</td>
                                                <td>{{ $history->pays->sum('summa') }}</td>
                                                <td><a href="{{ route('visits.show', ['visit' => $history->id]) }}" class="bx bx-show"></a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editVisitor" tabindex="-1" aria-modal="true" role="dialog" >
                <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3>Змінити дані користувача</h3>
                            </div>
                            <form id="editVisitorForm" method="post" action="{{ route('visitors.update', ['visitor' => $visitor->id]) }}" class="row g-3 fv-plugins-bootstrap5 fv-plugins-framework">
                                @csrf
                                <div class="col-12 col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="name">Ім'я</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="" value="{{ $visitor->first_name }}" required>
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <div class="col-12 col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="name">Прізвище</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="" value="{{ $visitor->last_name }}" required>
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <div class="col-12 col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="middle_name">По-батькові</label>
                                    <input type="text" id="middle_name" name="middle_name" class="form-control" placeholder="" value="{{ $visitor->middle_name }}" >
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <div class="col-12 col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="middle_name">Дата народження</label>
                                    <input type="date" id="birthday" name="birthday" class="form-control" placeholder="" value="{{ $visitor->birthday }}" required>
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <div class="col-12 col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" value="{{ $visitor->email }}">
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="male">Стать</label>
                                    <select id="male" name="male" class="form-select" required>
                                        <option value="male" @if($visitor->male == 'male') selected @endif>-- Чол --</option>
                                        <option value="female" @if($visitor->male == 'female') selected @endif>-- Жін --</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="phone">Телефон</label>
                                    <input type="@phone" id="phone" name="phone" class="form-control" value="{{ $visitor->phone }}" required>
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <div class="col-12 col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="second_phone">Додатковий телефон</label>
                                    <input type="@phone" id="second_phone" name="second_phone" class="form-control" value="{{ $visitor->second_phone }}">
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <div class="col-12 col-md-12 fv-plugins-icon-container">
                                    <label class="form-label" for="adress">Адреса</label>
                                    <input type="text" id="adress" name="adress" class="form-control" value="{{ $visitor->adress }}">
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <div class="col-12 col-md-12 fv-plugins-icon-container">
                                    <label class="form-label" for="description">Примітка</label>
                                    <textarea id="description" name="description" class="form-control">{{ $visitor->description }}</textarea>
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Оновити</button>
                                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                                <input type="hidden">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Поповнення балансу</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="summa" class="form-label">Сума поповнення</label>
                            <input type="text" id="summa" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary balance_add" data-bs-dismiss="modal">Поповнити</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#promoAdd").on('submit', function(e){
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    url: "{{ route('visitors.promo_add', ['visitor' => $visitor->id]) }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function (response) {
                        $("#tableResult").html(response);
                    }
                });
            });
            $("#editVisitorForm").on("submit", function(e){
               e.preventDefault();
               var forms = $(this);
               $.ajax({
                   url: "{{ route('visitors.update', ['visitor' => $visitor->id]) }}",
                   type: "POST",
                   data: forms.serialize(),
                   success: function(response){
                       if(response){
                           window.open("{{ route('visitors.edit', ['id' => $visitor->id]) }}");
                       }
                   }
               });
            });

            $(".balance_add").click(function(){
                var summa = $("#summa").val();
                $.ajax({
                   url: "{{ route('visitors.balance_add', ['visitor' => $visitor->id]) }}",
                   type: "POST",
                   data: {'_token': '{{ csrf_token() }}', 'summa': summa},
                   cache: false,
                   success: function(response){
                       $(".balance_result").html(response);
                       $("#summa").val('')
                   }
                });
            });
        });
    </script>
@endsection
