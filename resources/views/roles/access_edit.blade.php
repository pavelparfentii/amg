
    <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-role">

        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="role-title">Редагувати роль</h3>
                    <p>Доступи за замовчуванням для ролі</p>
                </div>
                <!-- Add role form -->
                <form id="addRoleForm" class="row g-3 addRoleForm" method="post" action="{{route('users_role.update_access', ['id' => $role->id])}}" >
                    @csrf
                    <input type="hidden" name="id" value="{{ $role->id }}">
                    <div class="col-12 mb-4">
                        <label class="form-label" for="modalRoleName">Назва ролі</label>
                        <input type="text" id="modalRoleName" name="modalRoleName" class="form-control" placeholder="Enter a role name" tabindex="-1" value="{{ $role->name }}" />
                    </div>
                    <div class="col-12">
                        <h4>Доступ для ролі</h4>
                        <!-- Permission table -->
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody>
                                <tr>
                                    <td class="text-nowrap fw-medium">Адміністративний доступ <i class="bx bx-info-circle bx-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="Надати повні права до програми"></i></td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAll" />
                                            <label class="form-check-label" for="selectAll">
                                                Відмітит все
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                @foreach($pages as $page)
                                    <tr>
                                        <td class="text-nowrap fw-medium">{{ $page->name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="{{ $page->alias }}Read" name="{{ $page->alias }}[]" value="read" @if(isset(json_decode($role->values, true)[$page->alias])) @if(in_array('read', json_decode($role->values, true)[$page->alias])) checked="checked" @endif @endif/>
                                                    <label class="form-check-label" for="{{ $page->alias }}Read">
                                                        Read
                                                    </label>
                                                </div>
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="{{ $page->alias }}Write" name="{{ $page->alias }}[]" value="write" @if(isset(json_decode($role->values, true)[$page->alias])) @if(in_array('write', json_decode($role->values, true)[$page->alias])) checked="checked" @endif @endif/>
                                                    <label class="form-check-label" for="{{ $page->alias }}Write">
                                                        Write
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="{{ $page->alias }}Create" name="{{ $page->alias }}[]" value="create" @if(isset(json_decode($role->values, true)[$page->alias])) @if(in_array('create', json_decode($role->values, true)[$page->alias])) checked="checked" @endif @endif/>
                                                    <label class="form-check-label" for="{{ $page->alias }}Create">
                                                        Create
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Permission table -->
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
{{--                    <input type="hidden">--}}
                </form>
                <!--/ Add role form -->
            </div>
        </div>
        </div>
{{--</div>--}}

    <script>
        // document.addEventListener('click', function(event) {
        //     // Перевіряємо чи клік був на кнопці закриття
        //     if (event.target.classList.contains('btn-close') || event.target.getAttribute('data-bs-dismiss') === 'modal') {
        //
        //         // Закриваємо модальне вікно
        //         const modal = document.getElementById('addRoleModal');
        //         modal.classList.remove('show');
        //         modal.style.display = 'none';
        //
        //         // Видаляємо backdrop вручну
        //         const backdrop = document.querySelector('.modal-backdrop');
        //         if (backdrop) {
        //             backdrop.remove(); // Видаляємо затемнення
        //         }
        //
        //         // Очищаємо вміст модального вікна після закриття
        //         modal.addEventListener('hidden.bs.modal', function () {
        //             modal.innerHTML = ''; // Очищуємо вміст
        //         });
        //     }
        // });
        $(document).ready(function() {
            $(".btn-close").click(function () {
                // $('body').removeClass('modal-open');
                $('#addRoleModal').modal('hide');
                // $('.modal-backdrop').hide();
                $("#addRoleModal").removeClass('show');
            });
            $(".addRoleForm").on('submit', function (e) {
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    url: "{{ route('users_role.update_access') }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function (response) {
                        // $("#addRoleModal").modal('hide');
                        $("#addRoleModal").removeClass('show');
                        // $("#addRoleForm").removeClass('show');
                        // $("#addRoleModal").html(response);
                        // $("#addRoleModal").css('display', 'none');
                        // $("#addRoleModal").removeClass('show');
                        // $("#tableResult").html(response);
                    }
                });
            });
            $("#selectAll").click(function(){
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
            $(".btn-label-secondary").click(function(){
                // $("#addRoleModal").modal('hide');

                // $("#addRoleForm").removeClass('show');
                $("#addRoleModal").removeClass('show');
            });
        });
    </script>
