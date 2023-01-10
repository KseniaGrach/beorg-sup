@extends('layouts.admin_layout')

@section('title', 'Информация о клиенте')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Клиент: {{ $client->fullName }}</h1>
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
                            <h5>Информация о клиенте</h5>
                        </div>
                        <table class="table table-striped mb-0">
                            <tbody>
                                <tr>
                                    <td>ФИО</td>
                                    <td>{{$client->fullName}}</td>
                                </tr>
                                <tr>
                                    <td>Почтовый адрес</td>
                                    <td>{{$client->email}}</td>
                                </tr>
                                <tr>
                                    <td>Телефон</td>
                                    <td>{{$client->phone}}</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a class="btn btn-info" href="{{ route('client.edit', $client->id) }}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Редактировать
                            </a>
                            <a href="{{route('client.index')}}" class="btn btn-info">Назад</a>
                        </div>
                    </div>
                    @if (!$client->clientProjects->isEmpty())
                        <div class="card card-primary">
                            <div class="card-body">
                                <h5>Проекты</h5>
                            </div>
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">
                                            №
                                        </th>
                                        <th>
                                            Наименование
                                        </th>
                                        <th>
                                            Рентабельность
                                        </th>
                                        <th>
                                            Стоимость
                                        </th>
                                        <th>
                                            Клиент
                                        </th>
                                        <th>
                                            Активен
                                        </th>
                                        <th style="width: 15%">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($client->clientProjects as $project)
                                        <tr>
                                            <td>
                                                {{ $project->id }}
                                            </td>
                                            <td>
                                                {{ $project->name }}
                                            </td>
                                            <td>
                                                {{ $project->profitability }}
                                            </td>
                                            <td>
                                                {{ $project->cost}}
                                            </td>
                                            <td>
                                                {{ $project->client->fullName}}
                                            </td>
                                            <td>
                                                {{ $project->activity ? 'Да' : 'Нет'}}
                                            </td>

                                            <td class="project-actions text-right">
                                                <a class="btn btn-info btn-sm" href="{{ route('project.global.show', $project->id) }}">
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
                    @if(!$client->clientMeetings->isEmpty())
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
                                            Создатель
                                        </th>
                                        <th>
                                            Проект
                                        </th>
                                        <th style="width: 15%">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($client->clientMeetings as $meeting)
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
                                            <td>
                                                {{ $meeting->project->name}}
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
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
