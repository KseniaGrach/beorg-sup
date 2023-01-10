@extends('layouts.admin_layout')

@section('title', 'Редактирование конференции')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактирование конференции №{{ $meeting['id'] }}</h1>
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
                        <form action="{{ route('meeting.update', $meeting['id']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Описание</label>
                                    <textarea id="description" rows="5" name="description" class="form-control"
                                              required autofocus>{{$meeting->description}}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="venue">Место проведения</label>
                                    <input id="venue" type="text" name="venue" class="form-control" value="{{$meeting->venue}}"
                                           placeholder="Укажите место встречи" required>
                                    <x-input-error :messages="$errors->get('venue')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="meeting_date">Дата проведения</label>
                                    <input id="meeting_date" type="datetime-local" name="meeting_date" class="form-control" value="{{$meeting->meeting_date}}">
                                    <x-input-error :messages="$errors->get('meeting_date')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Выберите клиента</label>
                                        <select name="client_id" class="form-control" required>
                                            <option value="">- Укажите клиента -</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}"
                                                    @if($meeting['client_id'] == $client->id)
                                                        selected
                                                    @endif
                                                >{{ $client->fullName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Выберите ответственного</label>
                                        <select name="user_id" class="form-control" required>
                                            <option value="">- Укажите ответственного -</option>
                                            @foreach ($analysts as $analyst)
                                                <option value="{{ $analyst->id }}"
                                                        @if($meeting['user_id'] == $analyst->id)
                                                            selected
                                                        @endif
                                                >{{ $analyst->fullName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Выберите проект</label>
                                        <select name="project_id" class="form-control" required>
                                            <option value="">- Укажите проект -</option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}"
                                                        @if($meeting['project_id'] == $project->id)
                                                            selected
                                                        @endif
                                                >{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                <a href="{{route('meeting.show', $meeting)}}" class="btn btn-info">Назад</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
