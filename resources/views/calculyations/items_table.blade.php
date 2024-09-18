<table class="table mb-0" id="i_list">
    <thead class="table-light">
    <tr>
        <th>#</th>
        <th>Найменування</th>
        <th>Кіль-сть</th>
        <th>Ціна</th>
        <th>Сума</th>
        <th>Дії</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->item->name }}</td>
            <td class="visible_count count-{{ $item->id }}" data-id="{{ $item->id }}">{{ $item->count }}</td>
            <td class="price-{{ $item->id }}">{{ $item->price }}</td>
            <td class="visible_summa summa-{{ $item->id }}" data-id="{{ $item->id }}">
                {{ round($item->count * $item->price, 2) }}
            </td>
            <td><span class="del_item cursor-pointer" data-item="{{ $item->id }}"><i class="bx bx-minus"></i></span></td>
        </tr>
    @endforeach
    </tbody>
</table>
