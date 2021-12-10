@extends('layout/layout')

@section('content')

    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-sun'></i> Установить статус
            </h1>

        </div>

        @if(\Illuminate\Support\Facades\Session::has('success'))
            <div class="alert alert-success text-dark" role="alert">
                <strong>Уведомление!</strong> {{\Illuminate\Support\Facades\Session::get('success')}}
            </div>
        @endif

        <form method="post" action="/status/id={{$id}}">

            @csrf

            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Установка текущего статуса</h2>
                            </div>
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- status -->
                                        <div class="form-group">
                                            <label class="form-label" for="example-select">Выберите статус</label>

                                            <select class="form-control" id="example-select" name="option">

                                                <option value="0" @if($user->status === 0) {{'selected'}} @endif>Не
                                                    беспокоить
                                                </option>
                                                <option value="1" @if($user->status === 1) {{'selected'}} @endif>
                                                    Онлайн
                                                </option>
                                                <option value="2" @if($user->status === 2) {{'selected'}} @endif>
                                                    Отошёл
                                                </option>

                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                        <button class="btn btn-warning">Set Status</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>

    </main>

@endsection
