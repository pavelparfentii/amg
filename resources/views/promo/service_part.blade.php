<table class="table border-top" width="100%">
    <thead>
    <tr>
        <th>Назва</th>
        <th>Знижка, %</th>
        <th>Знижка, грн.</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($promo as $prom)
        <tr>
            <td>{{ $prom->service->name }}</td>
            <td>{{ $prom->discount_percent }}</td>
            <td>{{ $prom->discount_absolute }}</td>
            <td></td>
        </tr>
    @endforeach
    </tbody>
</table>
