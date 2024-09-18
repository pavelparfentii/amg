<table class="table border-top" width="100%">
    <thead>
    <tr>
        <th>Назва</th>
        <th>Службова назва</th>
        <th>Знижка, %</th>
        <th>Знижка, грн.</th>
        <th>Статус</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($promos as $promo)
        <tr>
            <td>{{ $promo->name }}</td>
            <td>{{ $promo->alias }}</td>
            <td>{{ $promo->discount_percent }}</td>
            <td>{{ $promo->discount_absolute }}</td>
            <td></td>
            <td><a href="{{ route('promo.services', ['id' => $promo->id]) }}"><i class="bx bx-list-ul"></i></a></td>
        </tr>
    @endforeach
    </tbody>
</table>
