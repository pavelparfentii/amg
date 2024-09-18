@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('site.index') }}">Головна</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('items.orders_index') }}">Накладні</a></li>
                            <li class="breadcrumb-item active">Створення видаткової накладної</li>
                        </ol>
                    </nav>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('orders.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-2">
                                <label for="date" class="form-label">Дата:</label>
                                <input type="date" class="form-control" name="date" required>
                            </div>
                            <div class="col-md-1">
                                <input type="hidden" name="order_type" value="out">
                            </div>
                            <div class="col-md-2" style="padding-top: 30px">
                                <button type="submit" class="btn btn-primary">Створити</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){


        });
    </script>
@endsection

