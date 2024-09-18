<table class="table mb-0" id="list">
    <thead class="table-light">
    <tr>
        <th>#</th>
        <th>Найменування</th>
        <th>Кіль-сть</th>
        <th>Ціна</th>
        <th>Сума</th>
        <th>EXP</th>
        <th>Дії</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $itemm)
        <tr>
            <td>{{ $itemm->id }}</td>
            <td>{{ $itemm->item->name }}</td>
            <td class="visible_count count-{{ $itemm->id }}" data-id="{{ $itemm->id }}">{{ $itemm->count }}</td>
            <td class="price-{{ $itemm->id }}">{{ $itemm->price }}</td>
            <td class="visible_summa summa-{{ $itemm->id }}" data-id="{{ $itemm->id }}">
                {{ round($itemm->count * $itemm->price, 2) }}
            </td>
            <td>{{ $itemm->exp }}</td>
            <td><span class="del_item cursor-pointer" data-item="{{ $itemm->id }}" data-order="{{ $itemm->order_id }}"><i class="bx bx-minus"></i></span></td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5">Всього:</td>
        <td colspan="2" style="font-weight: bold" id="itogo"></td>
    </tr>
    </tfoot>
</table>
