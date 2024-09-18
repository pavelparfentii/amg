<table class="table border-top table-striped">
    <thead>
    <tr>
        <th class="text-nowrap">Промоакція</th>
        <th class="text-nowrap text-center">Дата додавання</th>
    </tr>
    </thead>
    <tbody>
    @foreach($promos as $promo)
        <tr>
            <td>{{ $promo->promo->name }}</td>
            <td>{{ date("d.m.Y", strtotime($promo->date_add)) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
