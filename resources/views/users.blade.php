@extends('layout/layout')

@section('content')
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-users'></i> Список пользователей
        </h1>
    </div>
    <div class="row">
        <div class="col-xl-12">

            @if(!$role === 'user')
                <a class="btn btn-success" href="create_user.html">Добавить</a>
            @endif

            <div class="border-faded bg-faded p-3 mb-g d-flex mt-3">
                <input type="text" id="js-filter-contacts" name="filter-contacts" class="form-control shadow-inset-2 form-control-lg" placeholder="Найти пользователя">
                <div class="btn-group btn-group-lg btn-group-toggle hidden-lg-down ml-3" data-toggle="buttons">
                    <label class="btn btn-default active">
                        <input type="radio" name="contactview" id="grid" checked="" value="grid"><i class="fas fa-table"></i>
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="contactview" id="table" value="table"><i class="fas fa-th-list"></i>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="js-contacts">

        @foreach($users as $user)
            @foreach($user->userData as $data)

                <?php
                switch ($data['status']) {
                    case 0:
                        $data['status'] = "warning";
                        break;
                    case 1:
                        $data['status'] = "success";
                        break;
                    case 2:
                        $data['status'] = "danger";
                        break;
                }
                ?>

                <div class="col-xl-4">
                    <div id="c_{{$user['id']}}" class="card border shadow-0 mb-g shadow-sm-hover"
                         data-filter-tags="{{$user['name']}}">
                        <div class="card-body border-faded border-top-0 border-left-0 border-right-0 rounded-top">
                            <div class="d-flex flex-row align-items-center">
                                <span class="status status-{{$data['status']}} mr-3">
                                    <span class="rounded-circle profile-image d-block "
                                          style="background-image:url({{$data['img']}}); background-size: cover;"></span>
                                </span>
                                <div class="info-card-text flex-1">
                                    @if($role === 'admin' OR $user['id'] === $id)
                                        <a href="javascript:void(0);"
                                           class="fs-xl text-truncate text-truncate-lg text-info"
                                           data-toggle="dropdown" aria-expanded="false">
                                            {{$user['name']}}
                                            <i class="fal fas fa-cog fa-fw d-inline-block ml-1 fs-md"></i>
                                            <i class="fal fa-angle-down d-inline-block ml-1 fs-md"></i>
                                        </a>
                                    @else
                                        <p class="fs-xl text-truncate text-truncate-lg text-secondary"
                                           data-toggle="dropdown" aria-expanded="false">
                                            {{$user['name']}}
                                        </p>
                                    @endif

                                    @if($role === 'admin' OR $user['id'] === $id)
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/user/edit/id={{$user['id']}}">
                                                <i class="fa fa-edit"></i>
                                                Редактировать</a>
                                            <a class="dropdown-item" href="/user/security/id={{$user['id']}}">
                                                <i class="fa fa-lock"></i>
                                                Безопасность</a>
                                            <a class="dropdown-item" href="status.html">
                                                <i class="fa fa-sun"></i>
                                                Установить статус</a>
                                            <a class="dropdown-item" href="media.html">
                                                <i class="fa fa-camera"></i>
                                                Загрузить аватар
                                            </a>
                                            <a href="#" class="dropdown-item"
                                               onclick="return confirm('are you sure?');">
                                                <i class="fa fa-window-close"></i>
                                                Удалить
                                            </a>
                                        </div>
                                    @endif

                                    <span class="text-truncate text-truncate-xl">{{$data['position']}}</span>
                                </div>
                                <button class="js-expand-btn btn btn-sm btn-default d-none" data-toggle="collapse"
                                        data-target="#c_{{$user['id']}} > .card-body + .card-body"
                                        aria-expanded="false">
                                    <span class="collapsed-hidden">+</span>
                                    <span class="collapsed-reveal">-</span>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0 collapse show">
                            <div class="p-3">
                                <a href="tel:{{$data['phone']}}" class="mt-1 d-block fs-sm fw-400 text-dark">
                                    <i class="fas fa-mobile-alt text-muted mr-2"></i> {{$data['phone']}}</a>
                                <a href="mailto:{{$user['email']}}"
                                   class="mt-1 d-block fs-sm fw-400 text-dark">
                                    <i class="fas fa-mouse-pointer text-muted mr-2"></i>
                                    {{$user['email']}}</a>
                                <address class="fs-sm fw-400 mt-4 text-muted">
                                    <i class="fas fa-map-pin mr-2"></i> {{$data['address']}}
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        @endforeach

    </div>
@endsection
