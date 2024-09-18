<div class="offcanvas-header">
    <h5 id="offcanvasAddServicesLabel" class="offcanvas-title">Редагування ТМЦ</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body mx-0 flex-grow-0">
    <form class="add-new-user pt-0" id="form-edit-record" onsubmit="return false">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Назва ТМЦ:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $item->name }}">
        </div>
        <div class="mb-3">
            <label for="parent" class="form-label">Батьківська група:</label>
            <select name="parent" class="form-select">
                @foreach($groups as $group)
                    <option value="{{ $group->id }}" @if($item->group_id == $group->id) selected @endif>{{ $group->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="active">Статус</label>
            <select id="active" class="select2 form-select" name="active">
                <option value="1" @if($item->ative == '1') selected @endif>Активна</option>
                <option value="0" @if($item->ative == '0') selected @endif>Неактивна</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1">Оновити</button>
    </form>
</div>
<script>
    $(document).ready(function(){
        $(".btn-close").click(function () {
            $("#offcanvasAddServices").removeClass('show');
        });

        $("#form-edit-record").submit(function(e){
            e.preventDefault();
            var form = $(this);
            $.ajax({
                type: "POST",
                url: "{{ route('items.update', ['id' => $item->id]) }}",
                data: form.serialize(),
                cache: false,
                success: function(response){
                    $("#tableResult").html(response);
                    $("#offcanvasAddServices").removeClass('show');
                    $("#name").val('');
                    $("#groupSearch").html('');
                    $("#cost").val('');
                }
            });
        });
    });
</script>
