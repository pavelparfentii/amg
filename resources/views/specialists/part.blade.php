<table class="datatables-basic table border-top" width="100%">
    <thead>
    <tr>
        <th>Назва</th>
        <th>Псевдонім</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($specialists as $specialist)
        <tr>
            <td>{{ $specialist->name }}</td>
            <td>{{ $specialist->alias }}</td>
            <td><a href="{{ route('settings.spec_form', ['specialist' => $specialist->id]) }}" title="Форми прийому пацієнтів"><i class="bx bx-list-ul"></i></a></td>
        </tr>
    @endforeach
    </tbody>
</table>
