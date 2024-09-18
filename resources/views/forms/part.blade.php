<table class="table border-top" width="100%">
    <thead>
    <tr>
        <th>Назва</th>
        <th>Псевдонім</th>
        <th>Тип</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($forms as $form)
        <tr>
            <td>{{ $form->name }}</td>
            <td>{{ $form->slug }}</td>
            <td>{{ $form->type }}</td>
            <td></td>
        </tr>
    @endforeach
    </tbody>
</table>
