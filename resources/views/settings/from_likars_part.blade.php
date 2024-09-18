<table class="table border-top" width="100%">
    <thead>
    <tr>
        <th>ПІБ</th>
        <th>Місто</th>
        <th>Внутрішній лікар</th>
        <th>Статус</th>
        <th>Дата створення</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($likars as $likar)
        <tr>
            <td>{{ $likar->name }}</td>
            <td>{{ $likar->address }}</td>
            <td>@if($likar->user_id) {{ $likar->user->name }} @endif</td>
            <td>@if($likar->active=='1') <span class="badge bg-label-success">ACTIVE</span> @else <span class="badge bg-label-warning">INACTIVE</span> @endif</td>
            <td>{{ date("d.m.Y", strtotime($likar->date_add)) }}</td>
            <td><a href="{{ route('settings.likars.edit', ['id' => $likar->id]) }}"><button class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button></a></td>
        </tr>
    @endforeach
    </tbody>
</table>
