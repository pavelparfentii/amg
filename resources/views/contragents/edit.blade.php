<div class="offcanvas-header">
    <h5 id="offcanvasAddGroupsLabel" class="offcanvas-title">Редагувати контрагента</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body mx-0 flex-grow-0">
    <form class="add-new-user pt-0" id="form-edit-record" onsubmit="return false">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Назва контрагента:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $item->name }}">
        </div>
        <div class="mb-3">
            <label for="group" class="form-label">Група</label>
            <select class="select-2 form-select" id="group" name="group">
                <option>-- Оберіть --</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}" @if($item->group == $group->id) selected @endif>{{ $group->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="active">Статус</label>
            <select id="active" class="select2 form-select">
                <option value="1" @if($item->active == '1') selected @endif>Активна</option>
                <option value="0" @if($item->active == '0') selected @endif>Неактивна</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1">Оновити</button>
    </form>
</div>
<script>
    $(document).ready(function(){
        $("#form-edit-record").submit(function(){
            var name = $("#name").val();
            var group = $("#group").val();
            var active = $("#active").val();
            $.ajax({
                type: "POST",
                url: "{{ route('contragents.update', ['id' => $item->id]) }}",
                data: {'_token': '{{ csrf_token() }}', 'name': name, 'active' : active, 'group': group},
                cache: false,
                success: function(response){
                    $("#tableResult").html(response);
                    $("#name").val('');
                    $("#groupSearch").html('');
                    $(".offcanvas-end").removeClass('show');
                }
            });
        });
        $(".btn-close").click(function () {
            $(".offcanvas-end").removeClass('show');
        });

    })
</script>
