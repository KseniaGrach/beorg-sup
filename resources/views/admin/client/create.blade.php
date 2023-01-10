@extends('layouts.admin_layout')

@section('title', 'Добавление клиента')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавление клиента</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fa fa-check"></i>{{ session('success') }}</h5>
                </div>
            @endif
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- form start -->
                        <form action="{{ route('client.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="surname">Фамилия</label>
                                    <input id="surname" type="text" name="surname" class="form-control" :value="old('surname')"
                                        placeholder="Введите фамилию клиента" required autofocus>
                                    <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="name">Имя</label>
                                    <input id="name" type="text" name="name" class="form-control" :value="old('name')"
                                           placeholder="Введите имя клиента" required>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="middlename">Отчество</label>
                                    <input id="middlename" type="text" name="middlename" class="form-control" :value="old('middlename')"
                                           placeholder="Введите отчество клиента">
                                    <x-input-error :messages="$errors->get('middlename')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="email">Почтовый адрес</label>
                                    <input id="email" type="email" name="email" class="form-control" :value="old('email')"
                                           placeholder="Введите email" required>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="phone">Телефон</label>
                                    <input id="phone" type="text" name="phone" class="form-control form-phone" :value="old('phone')"
                                           required>
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="password">Пароль</label>
                                    <input id="password" type="password" name="password" class="form-control"
                                           required autocomplete="new-password">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Подтвердите пароль</label>
                                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"
                                           required>
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                                <a href="{{route('client.index')}}" class="btn btn-info">Назад</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
