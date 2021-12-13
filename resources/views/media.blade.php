@extends('layout/layout')

@section('content')


    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-image'></i> Загрузить аватар
            </h1>
        </div>

        @if(\Illuminate\Support\Facades\Session::has('success'))
            <div class="alert alert-success text-dark" role="alert">
                <strong>Уведомление!</strong> {{\Illuminate\Support\Facades\Session::get('success')}}
            </div>
        @endif

        <form method="post" action="/media/id={{$id}}" enctype="multipart/form-data">

            @csrf

            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Текущий аватар</h2>
                            </div>
                            <div class="panel-content">

                                <div class="form-group">
                                    <img src="{{$user->img}}" alt="" class="img-responsive" width="70">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="example-fileinput">Выберите аватар</label>
                                    <input type="file" name="file" id="example-fileinput" class="form-control-file">
                                </div>


                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning">Загрузить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </main>

@endsection
