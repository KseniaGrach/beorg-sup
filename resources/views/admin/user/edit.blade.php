@extends('layouts.admin_layout')

@section('title', 'Редактировать пользователя')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать пользователя: {{ $user['email'] }}</h1>
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
                        <form action="{{ route('user.update', $user['id']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="surname">Фамилия пользователя</label>
                                    <input id="surname" type="text" name="surname" class="form-control" value="{{$user->surname}}"
                                           placeholder="Введите фамилию пользователя" required autofocus>
                                    <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="name">Имя пользователя</label>
                                    <input id="name" type="text" name="name" class="form-control" value="{{$user->name}}"
                                           placeholder="Введите имя пользователя" required>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="middlename">Отчество пользователя</label>
                                    <input id="middlename" type="text" name="middlename" class="form-control" value="{{$user->middlename}}"
                                           placeholder="Введите отчество пользователя">
                                    <x-input-error :messages="$errors->get('middlename')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="email">Почтовый адрес</label>
                                    <input id="email" type="email" name="email" class="form-control" value="{{$user->email}}"
                                           placeholder="Введите email" required>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="phone">Телефон</label>
                                    <input id="phone" type="text" name="phone" class="form-control form-phone" value="{{$user->phone}}"
                                           required>
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Выберите отдел</label>
                                        <select name="department_id" class="form-control" required>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department['id'] }}"
                                                    @if($department['id'] == $user->department_id)
                                                        selected
                                                    @endif
                                                >{{ $department['description'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Выберите роли пользователя</label>
                                        <select name="role_id[]" class="form-control" required multiple>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role['id'] }}"
                                                    @if(in_array($role['id'], array_column($user->roles->toArray(), 'id')))
                                                        selected
                                                    @endif
                                                >{{ $role['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                <a href="{{route('user.index')}}" class="btn btn-info">Назад</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
