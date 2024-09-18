<table class="datatables-basic table border-top dataTable" width="100%">
    <thead>
    <tr>
        <th>Назва</th>
        <th>Псевдонім</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($cabinets as $cabinet)
        <tr>
            <td>{{ $cabinet->name }}</td>
            <td>{{ $cabinet->alias }}</td>
            <td><a href="{{ route('settings.cabinet_edit', ['id' => $cabinet->id]) }}"><button class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button></a></td>
        </tr>
    @endforeach
    </tbody>
</table>
