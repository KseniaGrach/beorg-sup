@extends('layouts.admin_layout')

@section('title', 'Информация о проекте')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Проект: {{ $project['name'] }}</h1>
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
                        <div class="card-body">
                            <h5>Информация о проекте</h5>
                        </div>
                        <table class="table table-striped mb-0">
                            <tbody>
                                <tr>
                                    <td>Наименование</td>
                                    <td>{{$project->name}}</td>
                                </tr>
                                <tr>
                                    <td>Рентабельность</td>
                                    <td>{{$project->profitability}}</td>
                                </tr>
                                <tr>
                                    <td>Стоимость</td>
                                    <td>{{$project->cost}} тыс. руб.</td>
                                </tr>
                                <tr>
                                    <td>Клиент</td>
                                    <td>{{$project->client->fullName}}</td>
                                </tr>
                                <tr>
                                    <td>Тип проекта</td>
                                    <td>{{$project->type->name}} ({{$project->type->document_type}})</td>
                                </tr>
                                <tr>
                                    <td>Продолжительность</td>
                                    <td>{{$project->duration->name}} ({{$project->duration->period}})</td>
                                </tr>
                                <tr>
                                    <td>Активен</td>
                                    <td>{{ $project->activity ? 'Да' : 'Нет'}}</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a class="btn btn-info" href="{{ route('project.self.edit', $project->id) }}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Редактировать
                            </a>
                            <a href="{{route('project.self.index')}}" class="btn btn-info">Назад</a>
                            <form action="{{ route('project.self.change.status', $project->id) }}" method="POST"
                                style="display: inline-block">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-wrench">
                                    </i>
                                    Изменить статус
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h5 class="m-0">Ответственные</h5>
                                </div>
                                <div class="col-sm-3 inline-block">
                                    <form action="{{ route('project.self.add.user', $project->id) }}" method="POST">
                                        @csrf
                                        <select name="user_id" class="form-control d-inline w-auto" required>
                                            <option value="">- Укажите ответственного -</option>
                                            @foreach ($users as $user)
                                                @if(!in_array($user->id, array_column($project->users()->get()->toArray(), 'id')))
                                                    <option value="{{ $user->id }}">{{ $user->fullName }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-secondary btn-md float-right inline-block">
                                            <i class="fas fa-plus">
                                            </i>
                                            Назначить
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>ФИО</th>
                                    <th>Должность</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($project->users as $user)
                                    <tr>
                                        <td>{{$user->fullName}}</td>
                                        <td>{{$user->roles[0]->name}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($project->meetings)
                        <div class="card card-primary">
                            <div class="card-body">
                                <h5>Конференции</h5>
                            </div>
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">
                                            №
                                        </th>
                                        <th>
                                            Описание
                                        </th>
                                        <th>
                                            Место проведения
                                        </th>
                                        <th>
                                            Дата проведения
                                        </th>
                                        <th>
                                            Автор
                                        </th>
                                        <th style="width: 15%">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($project->meetings as $meeting)
                                        <tr>
                                            <td>
                                                {{ $meeting->id }}
                                            </td>
                                            <td>
                                                {{ $meeting->description }}
                                            </td>
                                            <td>
                                                {{ $meeting->venue }}
                                            </td>
                                            <td>
                                                {{ $meeting->meeting_date->format('d.m.Y H:i')}}
                                            </td>
                                            <td>
                                                {{ $meeting->author->fullName}}
                                            </td>
                                            <td class="project-actions text-right">
                                                <a class="btn btn-info btn-sm" href="{{ route('meeting.show', $meeting->id) }}">
                                                    <i class="fas fa-search">
                                                    </i>
                                                    Просмотр
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    @role('super_admin,analyst')
                        @if($project->instructions)
                            <div class="card card-primary">
                                <div class="card-body">
                                    <h5>Инструкции</h5>
                                </div>
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%">
                                            №
                                        </th>
                                        <th>
                                            Описание
                                        </th>
                                        <th>
                                            Дата сдачи отчёта (Крайняя)
                                        </th>
                                        <th>
                                            Временной период
                                        </th>
                                        <th style="width: 15%">
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($project->instructions as $instruction)
                                            <tr>
                                                <td>
                                                    {{ $instruction->id }}
                                                </td>
                                                <td>
                                                    {{ $instruction->description }}
                                                </td>
                                                <td>
                                                    {{ $instruction->report_date->format('d.m.Y H:i') }}
                                                </td>
                                                <td>
                                                    {{ $instruction->interval}}
                                                </td>
                                                <td class="project-actions text-right">
                                                    <a class="btn btn-info btn-sm" href="{{ route('instruction.show', $instruction->id) }}">
                                                        <i class="fas fa-search">
                                                        </i>
                                                        Просмотр
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                       @endif
                    @endrole
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
