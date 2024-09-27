@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="flex justify-content-between">
                <h4 class="py-3 mb-4" style="display: block">
                    <span class="text-muted fw-light">Промо-акції</span>
                </h4>
                <div class="py-9 mb-8">
                    <a class="btn btn-outline-primary" id="add_record">Додати запис</a>
                </div>
            </div>
            <div class="card">
                <div class="card-datatable table-responsive" id="tableResult">
                    <table class="table border-top" width="100%">
                        <thead>
                        <tr>
                            <th>Назва</th>
                            <th>Службова назва</th>
                            <th>Знижка, %</th>
                            <th>Знижка, грн.</th>
                            <th>Статус</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($promos as $promo)
                        <tr>
                            <td>{{ $promo->name }}</td>
                            <td>{{ $promo->alias }}</td>
                            <td>{{ $promo->discount_percent }}</td>
                            <td>{{ $promo->discount_absolute }}</td>
                            <td>@if($promo->active=='1')<span class="text-success">Активна</span>@endif @if($promo->active=='0')<span class="text-danger">Нективна</span>@endif</td>
                            <td><a href="{{ route('promo.services', ['id' => $promo->id]) }}"><i class="bx bx-list-ul"></i></a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
                <div class="offcanvas-header">
                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Створити користувача</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0">
                    <form class="add-new-user pt-0" id="form-add-new-record" onsubmit="return false">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Назва</label>
                            <input type="text" class="form-control" id="name" placeholder="Назва" name="name" aria-label="Назва" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="slug">Службова назва</label>
                            <input type="text" id="slug" class="form-control" placeholder="" aria-label="" name="slug" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="discount_percent">Знижка, %</label>
                            <input type="text" id="discount_percent" class="form-control" placeholder="" aria-label="" name="discount_percent" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="discount_absolute">Знижка, грн</label>
                            <input type="text" id="discount_absolute" class="form-control" placeholder="" aria-label="" name="discount_absolute" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="active">Статус</label>
                            <select id="active" class="select2 form-select">
                                <option value="1">Активна</option>
                                <option value="0">Неактивна</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Створити</button>
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
            $(".btn-primary").click(function () {
                $(".offcanvas-end").removeClass('show');
            });
            $("#form-add-new-record").submit(function(){
                var name = $("#name").val();
                var slug = $("#slug").val();
                var active = $("#active").val();
                var discount_percent = $("#discount_percent").val();
                var discount_absolute = $("#discount_absolute").val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('promo.store') }}",
                    data: {'_token': '{{ csrf_token() }}', 'name': name, 'slug': slug, 'active' : active, 'discount_percent' : discount_percent, 'discount_absolute' : discount_absolute},
                    cache: false,
                    success: function(response){
                        $("#tableResult").html(response);
                        $("#name").val('');
                        $("#slug").val('');
                        $("#discount_percent").val('');
                        $("#discount_absolute").val('');
                        $(".offcanvas-end").removeClass('show');
                    }
                });
            });
        });
    </script>
@endsection
