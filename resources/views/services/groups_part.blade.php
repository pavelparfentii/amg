<table class="table border-top dataTable" width="100%">
    <thead>
    <tr>
        <th>Назва</th>
        <th>Батьківстка група</th>
        <th>Послуг в групі</th>
        <th>Статус</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($groups as $group)
        <tr>
            <td><a href="{{ route('services.groupsBy', ['id' => $group->id]) }}">{{ $group->name }}</a></td>
            <td>{{ isset($group->parent) ? $group->parent->name : '' }}</td>
            <td>{{ $group->count_service() }}</td>
            <td>@if($group->active == '1')<span class="text-success">Активна</span> @endif @if($group->active == '0')<span class="text-danger">Нективна</span> @endif </td>
            <td>
                <a href="{{ route('services.groupsBy', ['id' => $group->id]) }}"><i class="bx bx-list-ol" title="До послуг"></i></a>
                <button class="btn btn-sm btn-icon edit-group cursor-pointer" title="Редагувати" data-id="{{ $group->id }}"><i class="bx bx-edit"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
