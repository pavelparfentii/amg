@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('site.index') }}">Головна</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('calculyations.index') }}">Калькуляції</a></li>
                            <li class="breadcrumb-item active">Створення калькуляції</li>
                        </ol>
                    </nav>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('calculyations.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-2">
                                <label for="date_start" class="form-label">Дата початку:</label>
                                <input type="date" class="form-control" name="date_start" required>
                            </div>
                            <div class="col-md-4">
                                <label for="service" class="form-label">Послуга:</label>
                                <select class="form-control" name="service" id="serviceSearch">
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="group" class="form-label">Група:</label>
                                <input type="text" class="form-control" readonly id="group" name="group" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="name" class="form-label">Назва:</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="col-md-1 form-check form-check-primary mt-4" style="padding-top: 15px">
                                <label for="pf" class="form-label">НПФ:</label>
                                <input type="checkbox" class="form-check-input" name="pf" id="pf">
                            </div>
                            <div class="col-md-2" style="padding-top: 30px">
                                <button type="submit" class="btn btn-primary">Створити</button>
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
            $('#serviceSearch').select2({
                placeholder: 'Почніть вводити назву..',
                language: "uk",
                ajax: {
                    url: '{{ route('select2-service') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.id + '. ' + item.name + '(' + item.article + ')',
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
        $(document).on('change',"#serviceSearch", function () {
            var service = $(this).val();
            if (service > "0") {
                $.ajax({
                    type: "GET",
                    url: "/services/" + service + "/service-info",
                    data: {},
                    cache: false,
                    success: function(response){
                        $("#group").val(response.group_id+"."+response.group);
                        $("#name").val(response.name);
                    }
                });
                $.ajax({
                    type: "GET",
                    url: "/services/"+service+"/get-service-price",
                    data: {},
                    cache: false,
                    success: function(response){
                        $('#price').val(response);
                        $('#summa').val(response);
                    }
                });
                return false;
            } else {
                $('#price').val('');
            }
        });
    </script>
@endsection

