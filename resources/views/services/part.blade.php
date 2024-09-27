<table class="table border-top dataTable" width="100%">
    <thead>
    <tr>
        <th>Назва</th>
        <th>Батьківстка група</th>
        <th>Ціна</th>
        <th>Собівартість</th>
        <th>Статус</th>
        <th>Action</th>

    </tr>
    </thead>
    <tbody>
    @foreach($services as $service)
        <tr>
            <td>{{ $service->name }}</td>
            <td>{{ $service->parent->name }}</td>
            <td>{{ $service->price }}</td>
            <td>{{ $service->cost }}</td>
            <td>@if($service->active == '1')<span class="text-success">Активна</span> @endif @if($service->active == '0')<span class="text-danger">Нективна</span> @endif </td>
            <td>
                <button class="btn btn-sm btn-icon edit-service cursor-pointer" title="Редагувати" data-id="{{ $service->id }}"><i class="bx bx-edit"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
