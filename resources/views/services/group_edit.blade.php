<div class="offcanvas-header">
    <h5 id="offcanvasAddGroupsLabel" class="offcanvas-title">Додати групу</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body mx-0 flex-grow-0">
    <form class="add-new-user pt-0" id="form-edit-record" data-id="{{ $group->id }}" onsubmit="return false">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Назва групи:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $group->name }}">
        </div>
        <div class="mb-3">
            <div class="inwrap">
                <label for="parent" class="form-label">Батьківська група:</label>
                <select id="groupSearch" class="select2 form-select form-select-lg" data-allow-clear="true" name="parent">
                    @if($group->parent)
                        <option value="{{ $group->parent_id }}">{{ $group->parent->name }}</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="active">Статус</label>
            <select id="active" class="select2 form-select">
                <option value="1" @if($group->active == '1') selected @endif>Активна</option>
                <option value="0" @if($group->active == '0') selected @endif>Неактивна</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1">Зберегти</button>
    </form>
</div>
<script>
    $(document).ready(function(){
        $("#form-edit-record").submit(function(){
            var name = $("#name").val();
            var parent = $("#groupSearch").val();
            var active = $("#active").val();
            var group = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "/services/" + group + "/group_update",
                data: {'_token': '{{ csrf_token() }}', 'name': name, 'parent': parent, 'active' : active},
                cache: false,
                success: function(response){
                    $("#offcanvasAddGroups").removeClass('show');
                    $("#tableResult").html(response);
                }
            });
        });
    });
</script>
