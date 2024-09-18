@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header">
                    <div class="flex justify-content-between">
                        <h4 class="py-3 mb-4" style="display: block">
                            <span class="text-muted fw-light">Накладні</span>
                        </h4>
                        <div class="py-9 mb-8">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Створити</button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item income cursor-pointer" href="{{ route("orders.income_create") }}">Приходний</a></li>
                                    <li><a class="dropdown-item cosumption cursor-pointer" href="{{ route("orders.consumption_create") }}">Видатковий</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-header">
                            <form method="post" class="form-group">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="from" class="form-label">Дата з:</label>
                                        <input type="date" class="form-control" name="from" value="{{ $from }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="to" class="form-label">Дата по:</label>
                                        <input type="date" class="form-control" name="to" value="{{ $to }}">
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <button type="submit" class="btn btn-primary">Відібрати</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-datatable table-responsive" id="tableResult">
                        <table class="table border-top dataTable" width="100%" id="list">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Дата</th>
                                <th>Найменування</th>
                                <th>Серія</th>
                                <th>Од.вим.</th>
                                <th>Кіль-сть</th>
                                <th>Ціна</th>
                                <th>Сума</th>
                                <th>Строк придатності</th>
                                <th>Постачальник</th>
                                <th>Отримувач</th>
                                <th>Накладна постачальник</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = 1; @endphp
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ date("d.m.Y", strtotime($item->order->date)) }}</td>
                                    <td>{{ $item->item->name }}</td>
                                    <td>{{ $item->series }}</td>
                                    <td>{{ $item->item->unit }}</td>
                                    <td>{{ $item->count }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ round($item->count * $item->price, 2) }}</td>
                                    <td>{{ $item->exp }}</td>
                                    <td>{{ isset($item->order->provider->name) ? $item->order->provider->name : 'Головний склад' }}</td>
                                    <td>{{ isset($item->order->receiver->name) ? $item->order->receiver->name : 'Головний склад' }}</td>
                                    <td>{{ $item->order->contragent_order }}</td>
                                    <td><span class="fa fa-trash-alt item-delete" data-item="{{ $item->id }}"></span></td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" id="add-new-record">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="exampleModalLabel">Новий запис</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body flex-grow-1">
                    <form class="add-new-record pt-0 row g-2" id="form-add-new-record" onsubmit="return false">
                        <div class="col-sm-12">
                            <label class="form-label" for="name">Назва</label>
                            <div class="input-group input-group-merge">
                                <span id="basicFullname2" class="input-group-text"><i class="bx bx-list-plus"></i></span>
                                <input type="text" id="name" class="form-control dt-full-name" name="name" placeholder="Назва сторінки" aria-label="Назва сторінки" aria-describedby="basicFullname2" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="url">Тип сторінки</label>
                            <div class="input-group input-group-merge">
                                <span id="basicPost2" class="input-group-text"><i class='bx bxs-briefcase'></i></span>
                                <select class="form-select" name="type" id="type" required>
                                    <option value=""> -- Вкажіть тип -- </option>
                                    <option value="kartka">Картка пацієнта</option>
                                    <option value="form">Форма прийому</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Зберегти</button>
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
            $("#add_record").click(function(){
                $(".offcanvas-end").addClass('show');
            });
            $(".btn-close").click(function(){
                $(".offcanvas-end").removeClass('show');
            });


            $("#form-add-new-record").submit(function(){
                var name = $("#name").val();
                var type = $("#type").val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('settings.forms_store') }}",
                    data: {'_token': '{{ csrf_token() }}', 'name': name, 'type': type},
                    cache: false,
                    success: function(response){
                        $("#tableResult").html(response);
                        $("#name").val('');
                        $("#type").val('');
                    }
                });
            });
        });
    </script>
@endsection

