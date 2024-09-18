@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header">
                    <div class="flex justify-content-between">
                        <h4 class="py-3 mb-4" style="display: block">
                            <span class="text-muted fw-light">Калькуляції</span>
                        </h4>
                        <div class="py-9 mb-8">
                            <div class="btn-group">
                                <a href="{{ route('calculyations.create') }}" class="btn btn-primary">Створити</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-datatable table-responsive" id="tableResult">
                        <table class="table border-top dataTable" width="100%" id="list">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Назва</th>
                                <th>Група</th>
                                <th>Собівартість</th>
                                <th>Вартість</th>
                                <th>Дії</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i=1; @endphp
                            @foreach($items as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->service->parent->name }}</td>
                                <td>{{ $item->summa() }}</td>
                                <td>{{ $item->service->price }}</td>
                                <td><a href="{{ route('calculyations.edit', ['id' => $item->id]) }}">Edit</a></td>
                                @php $i++; @endphp
                                @endforeach
                            </tr>
                            </tbody>
                        </table>
                    </div>
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

