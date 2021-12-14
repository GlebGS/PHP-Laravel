@extends('layout/layout')

@section('content')

    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-plus-circle'></i> Добавить пользователя
            </h1>
        </div>

        <form method="post" action="/create_user/id={{$id}}" enctype="multipart/form-data">

            @csrf

            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Общая информация</h2>
                            </div>
                            <div class="panel-content">
                                <!-- username -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Имя</label>
                                    <input type="text" name="name" id="simpleinput" class="form-control">
                                </div>

                                <!-- title -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Место работы</label>
                                    <input type="text" name="position" id="simpleinput" class="form-control">
                                </div>

                                <!-- tel -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Номер телефона</label>
                                    <input type="text" name="phone" id="simpleinput" class="form-control">
                                </div>

                                <!-- address -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Адрес</label>
                                    <input type="text" name="address" id="simpleinput" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Безопасность и Медиа</h2>
                            </div>
                            <div class="panel-content">
                                <!-- email -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Email</label>
                                    <input type="text" name="email" id="simpleinput" class="form-control">
                                </div>

                                <!-- password -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Пароль</label>
                                    <input type="password" name="password" id="simpleinput" class="form-control">
                                </div>


                                <!-- status -->
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Выберите статус</label>
                                    <select class="form-control" name="status" id="example-select">
                                        <option value='1'>Онлайн</option>
                                        <option value='2'>Отошел</option>
                                        <option value='0'>Не беспокоить</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="example-fileinput">Загрузить аватар</label>
                                    <input type="file" name="file" id="example-fileinput" class="form-control-file">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                            <button class="btn btn-success">Добавить</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>

    </main>

@endsection
