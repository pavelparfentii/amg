@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header">
                    <h4>Друк картки пацієнта <b>#{{ $visitor->id }}</b>, {{ $visitor->full_name }}</h4>
                </div>
                <div class="card-body">
                    <form target="_blank" method="post" id="printForm" action="{{ route('visitors.reprint', ['visitor' => $visitor->id]) }}">
                        @csrf
                        @foreach($forms as $form)
                            <div class="form-group">
                                <input type="checkbox" class="form-check-input" name="forms[]" value="{{ $form->slug }}">
                                <label for="forms" class="form-check-label">{{ $form->name }}</label>
                            </div>
                        @endforeach
                        <div class="form-group" style="padding-top: 25px">
                            <button class="btn btn-primary cursor-pointer" id="print">Роздрукувати</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
