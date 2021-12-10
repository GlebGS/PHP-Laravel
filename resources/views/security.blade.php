@extends('layout/layout')

@section('content')
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-lock'></i> Безопасность
            </h1>

        </div>

        @if(\Illuminate\Support\Facades\Session::has('error'))
            <div class="alert alert-danger text-dark" role="alert">
                <strong>Уведомление!</strong> {{\Illuminate\Support\Facades\Session::get('error')}}
            </div>
        @endif

        @if(\Illuminate\Support\Facades\Session::has('success'))
            <div class="alert alert-success text-dark" role="alert">
                <strong>Уведомление!</strong> {{\Illuminate\Support\Facades\Session::get('success')}}
            </div>
        @endif


        <form method="post" action="/security/id={{$id}}">

            @csrf

            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Обновление эл. адреса и пароля</h2>
                            </div>
                            <div class="panel-content">
                                <!-- email -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Email</label>
                                    <input type="text" name="email" id="simpleinput" class="form-control"
                                           value="{{$user->email}}">
                                </div>

                                <!-- password -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Пароль</label>
                                    <input type="password" name="password" id="simpleinput" class="form-control">
                                </div>

                                <!-- password confirmation-->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Подтверждение пароля</label>
                                    <input type="password" name="new_password" id="simpleinput"
                                           class="form-control">
                                </div>


                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning">Изменить</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>

    </main>

@endsection
