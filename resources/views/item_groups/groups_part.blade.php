<table class="table border-top" width="100%">
    <thead>
    <tr>
        <th>Назва</th>
        <th>ТМЦ в групі</th>
        <th>Статус</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($groups as $group)
        <tr>
            <td><a href="{{ route('items.groupsBy', ['id' => $group->id]) }}">{{ $group->name }}</a></td>
            <td>{{ $group->count_items() }}</td>
            <td>@if($group->active == '1')<span class="text-success">Активна</span> @endif @if($group->active == '0')<span class="text-danger">Нективна</span> @endif </td>
            <td>
                <a href="{{ route('items.groupsBy', ['id' => $group->id]) }}"><i class="bx bx-list-ol" title="До послуг"></i></a>
                <button class="btn btn-sm btn-icon edit-group cursor-pointer" title="Редагувати" data-id="{{ $group->id }}"><i class="bx bx-edit"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
