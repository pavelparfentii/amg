<table class="table border-top" width="100%">
    <thead>
    <tr>
        <th>Користувач</th>
        <th>Роль</th>
        <th>Статус</th>
        <th>Дата створення</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->role->name }}</td>
            <td></td>
            <td></td>
            <td><a href="{{ route('users.edit', ['id' => $user->id]) }}"><button class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button></a></td>
        </tr>
    @endforeach
    </tbody>
</table>
