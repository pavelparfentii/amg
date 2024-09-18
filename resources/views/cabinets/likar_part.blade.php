<table class="table border-top dataTable" width="100%">
    <thead>
    <tr>
        <th>Спеціальність</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($cabinet_likars as $clikar)
        <tr>
            <td>{{ $clikar->user->name }}</td>
            <td><span class="item-delete cursor-pointer" data-id="{{ $clikar->id }}"><i class="bx bx-trash"></i> </span> </td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function(){
        $(".item-delete").on('click', function(){
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('settings.cabinets_likar_del') }}",
                type: "POST",
                data: {'_token': '{{ csrf_token() }}', 'id': id},
                cache: false,
                success: function(response){
                    $("#tableResult").html(response);
                }
            });
        });
    });
</script>
