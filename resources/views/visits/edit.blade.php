@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light"><a href="{{ route('visitors.index') }}">Візит</a> / Зміна статуса </span>
            </h4>
            <div class="card">
                <div class="card-header">Зміна статуса візиту <b>#{{ $visit->id }}</b> від <b>{{ date("d.m.Y", strtotime($visit->date)) }}</b> / <b>{{ $visit->time }}</b>, пацієнт <b>{{ isset($visit->visitor_id) ? $visit->visitor->full_name : json_decode($visit->note->value, true)['full_name'] }}</b></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <a href="{{ route('visits.to_visited', ['visit' => $visit->id]) }}" class="btn btn-success">Відмітити візит</a>
                        </div>
                        <div class="col-md-3 col-12">
                            <a href="{{ route('visits.to_date', ['visit' => $visit->id]) }}" class="btn btn-warning">Перенести візит</a>
                        </div>
                        <div class="col-md-3 col-12">
                            <a href="{{ route('visits.destroy', ['visit' => $visit->id]) }}" class="btn btn-danger">Відмінити візит</a>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <form method="post" action="{{ route('visits.update', ['visit' => $visit->id]) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <h5 class="card-header">Час прийому</h5>
                                    <div class="timeResult"></div>
                                    <div class="card-body pb-5">
                                        <div class="my-3" id="slider-pips"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="likar" class="form-label">Лікар, що веде прийом</label>
                                        <select name="likar" class="form-select" id="likar" required>
                                            <option value=""> -- Виберіть лікаря -- </option>
                                            @foreach($likars as $likar)
                                                <option value="{{ $likar->id }}" @if($likar->id == $visit->likar) selected @endif>{{ $likar->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="patient" class="form-label">Пацієнт / співробітник</label>
                                        <select name="patient" class="form-select" id="patient">
                                            <option value="1" @if($visit->patient == '1') selected @endif> Пацієнт </option>
                                            <option value="0" @if($visit->patient == '0') selected @endif> Співробітник </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="from_likar" class="form-label">Хто направив</label>
                                        <select name="from_likar" class="form-select" id="from_likar" required>
                                            @foreach($from_likars as $from_likar)
                                                <option value="{{ $from_likar->id }}" @if($from_likar->id == $visit->from_likar) selected @endif>{{ $from_likar->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" style="padding-top: 25px">
                                        <label class="switch switch-info">
                                            <input type="checkbox" class="switch-input" name="refferal" />
                                            <span class="switch-toggle-slider">
                                        <span class="switch-on">
                                            <i class="bx bx-check"></i>
                                        </span>
                                        <span class="switch-off">
                                            <i class="bx bx-x"></i>
                                        </span>
                                    </span>
                                            <span class="switch-label">Зовнішнє направлення</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="form-label">Примітка</label>
                                        <textarea name="description" id="description" class="form-control" rows="6">{{ $visit->description }}</textarea>
                                    </div>
                                    <div class="form-group" style="padding-top: 25px">
                                        <button type="submit" class="btn btn-info">Оновити</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
