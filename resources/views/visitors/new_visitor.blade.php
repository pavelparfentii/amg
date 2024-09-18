@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header">
                    <h4>Новий пацієнт</h4>
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <a href="{{ route('visits.destroy', ['visit' => $visit->id]) }}" class="btn btn-danger">Відмінити візит</a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('visitors.new_store', ['visit' => $visit]) }}" method="post">
                    @csrf
                <div class="card-body row">
                        <div class="col-md-4">
                        <div class="form-group">
                            <label for="last_name" class="form-label">Прізвище</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ isset(json_decode($visit->notes->value, true)['last_name']) ? json_decode($visit->notes->value, true)['last_name']  :  '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="first_name" class="form-label">Ім'я</label>
                            <input type="text" name="first_name" id="first_name" class="form-control"  value="{{ isset(json_decode($visit->notes->value, true)['first_name']) ? json_decode($visit->notes->value, true)['first_name']  :  '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="middle_name" class="form-label">По-батькові</label>
                            <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ isset(json_decode($visit->notes->value, true)['middle_name']) ? json_decode($visit->notes->value, true)['middle_name']  :  '' }}">
                        </div>
                        <div class="form-group">
                            <label for="birthday" class="form-label">Дата народження</label>
                            <input type="date" name="birthday" id="birthday" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="male" class="form-label">Пол</label>
                            <select name="male" class="form-select" id="male" required>
                                <option value="male" @if(json_decode($visit->notes->value, true)['male'] == 'male') select @endif> Чол </option>
                                <option value="female" @if(json_decode($visit->notes->value, true)['male'] == 'female') select @endif> Жін </option>
                            </select>
                        </div>
                        <div class="form-group" style="padding-top: 25px">
                            <button type="submit" class="btn btn-primary">Зберегти та відмітити візит</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phone" class="form-label">Телефон:</label>
                            <input type="text" name="phone" id="phone" class="form-control"  value="{{ isset(json_decode($visit->notes->value, true)['phone']) ? json_decode($visit->notes->value, true)['phone']  :  '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="second_phone" class="form-label">Додатковий телефон:</label>
                            <input type="text" name="second_phone" id="second_phone" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="adress" class="form-label">Адреса:</label>
                            <input type="text" name="adress" id="adress" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Примітка</label>
                            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
