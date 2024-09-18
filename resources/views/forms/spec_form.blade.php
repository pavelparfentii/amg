@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header">
                    <div class="flex justify-content-between">
                        <h4 class="py-3 mb-4" style="display: block">
                            <span class="text-muted fw-light">Налаштування</span> | Друковані форми прийому | {{ $specialist->name }}
                        </h4>
                        <div class="py-9 mb-8">
                            <a class="btn btn-outline-primary" id="add_record">Додати запис</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-datatable table-responsive" id="tableResult">
                        <table class="table border-top" width="100%">
                            <thead>
                            <tr>
                                <th>Назва</th>
                                <th>Псевдонім</th>
                                <th>Спеціаліст</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($forms as $form)
                                <tr>
                                    <td>{{ $form->name }}</td>
                                    <td>{{ $form->slug }}</td>
                                    <td>{{ $form->type }}</td>
                                    <td></td>
                                </tr>
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
                                    <option value="{{ $specialist->alias }}">Форма прийому</option>
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

