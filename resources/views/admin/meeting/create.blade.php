@extends('layouts.admin_layout')

@section('title', 'Создание конференции')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Создание конференции</h1>
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
                        <form action="{{ route('meeting.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <textarea id="description" name="description" class="form-control" :value="old('description')"
                                              placeholder="Введите описание встречи" rows="5" required autofocus></textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="venue">Место проведения</label>
                                    <input id="venue" type="text" name="venue" class="form-control" :value="old('venue')"
                                           placeholder="Укажите место проведения" required>
                                    <x-input-error :messages="$errors->get('venue')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="meeting_date">Дата встречи</label>
                                    <input id="meeting_date" type="datetime-local" name="meeting_date" class="form-control" :value="old('meeting_date')">
                                    <x-input-error :messages="$errors->get('meeting_date')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Выберите клиента</label>
                                        <select name="client_id" class="form-control" required>
                                            <option value="">- Укажите клиента -</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->fullName }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Выберите ответственного</label>
                                        <select name="user_id" class="form-control" required>
                                            <option value="">- Укажите ответственного -</option>
                                            @foreach ($analysts as $analyst)
                                                <option value="{{ $analyst->id }}">{{ $analyst->fullName }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Выберите проект</label>
                                        <select name="project_id" class="form-control" required>
                                            <option value="">- Укажите проект -</option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('project_id')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Создать</button>
                                <a href="{{route('meeting.index')}}" class="btn btn-info">Назад</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
