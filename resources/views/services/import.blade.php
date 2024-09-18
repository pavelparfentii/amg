@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="flex justify-content-between">
                <h4 class="py-3 mb-4" style="display: block">
                    <span class="text-muted fw-light">Послуги</span> | Імпорт послуг
                </h4>
            </div>
                <div class="card">
                    <div style="margin:35px;">
                    {!! Form::open(['route' => 'services.import', 'method' =>'POST', 'files' => true, 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group col-md-6">
                        {!! Form::label('group', 'Група послуг:') !!}
                        {!! Form::select('group', ['' => 'Укажите']+$service_groups, null, ['class' => 'form-control'.($errors->has('group') ? ' is-invalid' : '')]) !!}
                        @if ($errors->has('group'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('group') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        {!! Form::label('import_file', 'Файл:') !!}
                        {!! Form::file('import_file', ['class' => 'form-control'.($errors->has('import_file') ? ' is-invalid' : ''), 'required']) !!}
                        @if ($errors->has('import_file'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('import_file') }}</strong></span>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
