@foreach($roles as $role)
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h6 class="fw-normal">Всього {{ $role->list->count() }} користувачів</h6>
                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                        @foreach($role->list as $item)
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="{{ $item->name }}" class="avatar avatar-sm pull-up">
                                <img class="rounded-circle" src="{{ asset('images/user_icon.jpg') }}" alt="Avatar">
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="d-flex justify-content-between align-items-end">
                    <div class="role-heading">
                        <h4 class="mb-1">{{ $role->name }}</h4>
                        <a href="" data-bs-toggle="modal" class="role-edit-modal" data-id="{{ $role->id }}"><small>Редагувати роль</small></a>
                    </div>
                    <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                </div>
            </div>
        </div>
    </div>
@endforeach
