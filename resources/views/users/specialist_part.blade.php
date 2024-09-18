<table class="table border-top" width="100%">
    <thead>
    <tr>
        <th>Спеціальність</th>
        <th>Таймінг</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($specialists as $likar)
        <tr>
            <td>{{ $likar->specialist->name }}</td>
            <td>{{ $likar->timing }}хв</td>
            <td><span class="item-delete" data-id="{{ $likar->id }}"><i class="bx bx-trash"></i> </span> </td>
        </tr>
    @endforeach
    </tbody>
</table>
