

<div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-role">
    <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-4">
                <h3 class="role-title">Створити нову роль</h3>
                <p>Доступи за замовчуванням для ролі</p>
            </div>
            <!-- Add role form -->
            <form id="addRoleForm" class="row g-3" method="post">
                @csrf
                <div class="col-12 mb-4">
                    <label class="form-label" for="modalRoleName">Назва ролі</label>
                    <input type="text" id="modalRoleName" name="modalRoleName" class="form-control" placeholder="Enter a role name" tabindex="-1" />
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
                                                <input class="form-check-input" type="checkbox" id="{{ $page->alias }}Read" name="{{ $page->alias }}[]" value="read"/>
                                                <label class="form-check-label" for="{{ $page->alias }}Read">
                                                    Read
                                                </label>
                                            </div>
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox" id="{{ $page->alias }}Write" name="{{ $page->alias }}[]" value="write"/>
                                                <label class="form-check-label" for="{{ $page->alias }}Write">
                                                    Write
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="{{ $page->alias }}Create" name="{{ $page->alias }}[]" value="create"/>
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
                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
            </form>
            <!--/ Add role form -->
        </div>
    </div>
</div>

<script>
    document.addEventListener('click', function(event) {
        // Перевіряємо чи клік був на кнопці закриття
        if (event.target.classList.contains('btn-close') || event.target.getAttribute('data-bs-dismiss') === 'modal') {

            // Закриваємо модальне вікно
            const modal = document.getElementById('addRoleModal');
            modal.classList.remove('show');
            modal.style.display = 'none';

            // Видаляємо backdrop вручну
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove(); // Видаляємо затемнення
            }

            // Очищаємо вміст модального вікна після закриття
            modal.addEventListener('hidden.bs.modal', function () {
                modal.innerHTML = ''; // Очищуємо вміст
            });
        }
    });
    $(document).ready(function() {

        $("#addRoleForm").on('submit', function (e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                url: "{{ route('users_role.store_access') }}",
                type: "POST",
                data: form.serialize(),
                success: function (response) {
                    $("#addRoleModal").css('display', 'none');
                    $("#addRoleModal").removeClass('show');
                }
            });
        });
        $("#selectAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

    });
</script>

