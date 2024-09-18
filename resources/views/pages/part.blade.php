<table class="datatables-basic table border-top" width="100%">
    <thead>
    <tr>
        <th>Назва</th>
        <th>Псевдонім</th>
        <th>Посилання</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pages as $page)
        <tr>
            <td>{{ $page->name }}</td>
            <td>{{ $page->alias }}</td>
            <td>{{ $page->url }}</td>
            <td></td>
        </tr>
    @endforeach
    </tbody>
</table>
