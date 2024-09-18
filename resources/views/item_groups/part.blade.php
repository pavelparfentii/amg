<table class="table border-top dataTable" width="100%">
    <thead>
    <tr>
        <th>Назва</th>
        <th>Батьківстка група</th>
        <th>Ціна</th>
        <th>Статус</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->parent->name }}</td>
            <td>{{ $item->price }}</td>
            <td>@if($item->active == '1')<span class="text-success">Активна</span> @endif @if($item->active == '0')<span class="text-danger">Нективна</span> @endif </td>
            <td>
                <button class="btn btn-sm btn-icon edit-service cursor-pointer" title="Редагувати" data-id="{{ $item->id }}"><i class="bx bx-edit"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
