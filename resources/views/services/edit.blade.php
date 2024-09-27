<div class="offcanvas-header">
    <h5 id="offcanvasAddServicesLabel" class="offcanvas-title">Додати послугу</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body mx-0 flex-grow-0">
    <form class="add-new-user pt-0" id="form-edit-service" onsubmit="return false">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Назва послуги:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $service->name }}">
        </div>
        <div class="mb-3">
            <label for="parent" class="form-label">Батьківська група:</label>
            <select name="parent" class="form-select">
                @foreach($groups as $parent)
                    <option value="{{ $parent->id }}" @if($service->group_id == $parent->id) selected @endif>{{ $parent->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Ціна для клієнтів:</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ $service->price }}">
        </div>
        <div class="mb-3">
            <label for="cost" class="form-label">Собівартість:</label>
            <input type="text" name="cost" id="cost" class="form-control" value="{{ $service->cost }}">
        </div>
        <div class="mb-3">
            <label for="doctor_price" class="form-label">Бонус лікаря:</label>
            <input type="text" name="doctor_price" id="doctor_price" class="form-control" value="{{ $service->doctor_price }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Примітка:</label>
            <textarea name="description" id="description" class="form-control" rows="5">{{ $service->description }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label" for="active">Статус</label>
            <select id="active" class="select2 form-select">
                <option value="1" @if($service->active == '1') selected @endif>Активна</option>
                <option value="0" @if($service->active == '0') selected @endif>Неактивна</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1">Зберегти</button>
    </form>
</div>
<script>
    $(document).ready(function(){
        $("#form-edit-service").submit(function(e){
            e.preventDefault();
            var form = $(this);
            $.ajax({
                url: "{{ route('services.update', ['service' => $service->id]) }}",
                type: "POST",
                data: form.serialize(),
                success: function(response){
                    $("#tableResult").html(response);
                    $("#offcanvasAddServices").removeClass('show');
                }
            });
            return false;
        });
        $(".btn-close").click(function () {
            $("#offcanvasAddServices").removeClass('show');
        });

    });
</script>
