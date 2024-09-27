@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="flex justify-content-between">
                <h4 class="py-3 mb-4" style="display: block">
                    <span class="text-muted fw-light">Промо-акції</span> | {{ $promo->name }} | Послуги
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
                            <th>Знижка, %</th>
                            <th>Знижка, грн.</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($promos as $prom)
                                <tr>
                                    <td>{{ $prom->service->name }}</td>
                                    <td>{{ $prom->discount_percent }}</td>
                                    <td>{{ $prom->discount_absolute }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddService" aria-labelledby="offcanvasAddServiceLabel">
                <div class="offcanvas-header">
                    <h5 id="offcanvasAddServiceLabel" class="offcanvas-title">Додати послугу</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0">
                    <form class="add-service-promo pt-0" id="form-add-new-service" onsubmit="return false">
                        @csrf
                        <div class="mb-3">
                            <label for="service" class="form-label">Послуга:</label>
                            <select id="serviceSearch" class="select2 form-select form-select-lg" data-allow-clear="true" name="service"></select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="discount_percent">Знижка, %</label>
                            <input type="text" class="form-control" placeholder="" aria-label="" name="discount_percent" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="discount_absolute">Знижка, грн</label>
                            <input type="text" class="form-control" placeholder="" aria-label="" name="discount_absolute" />
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
        $(document).ready(function() {
            $("#add_record").click(function () {
                $(".offcanvas-end").addClass('show');
            });
            $(".btn-close").click(function () {
                $(".offcanvas-end").removeClass('show');
            });
            $(".btn-primary").click(function () {
                $(".offcanvas-end").removeClass('show');
            });

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
                                    text: item.id + '. ' + item.name,
                                    id: item.id
                                }
                            })
                        };
                        onItemSelect: selectItem();
                    },
                    cache: true
                }
            });
            $("#form-add-new-service").submit(function(e){
               e.preventDefault();
               var form = $(this);
                $.ajax({
                    url: "{{ route('promo.service_add', ['id' => $promo->id]) }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function(response){
                        $("#tableResult").html(response);
                    }
                });
            });
        });
</script>
@endsection
