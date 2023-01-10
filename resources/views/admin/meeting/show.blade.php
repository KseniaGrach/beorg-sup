@extends('layouts.admin_layout')

@section('title', 'Информация о конференции')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Конференция №{{ $meeting['id'] }}</h1>
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
                            <h5>Информация о конференции</h5>
                        </div>
                        <table class="table table-striped mb-0">
                            <tbody>
                                <tr>
                                    <td>Описание</td>
                                    <td>{{$meeting->description}}</td>
                                </tr>
                                <tr>
                                    <td>Место проведения</td>
                                    <td>{{$meeting->venue}}</td>
                                </tr>
                                <tr>
                                    <td>Дата проведения</td>
                                    <td>{{$meeting->meeting_date->format('d.m.Y H:i')}}</td>
                                </tr>
                                <tr>
                                    <td>Проект</td>
                                    <td>{{$meeting->project->name}}</td>
                                </tr>
                                <tr>
                                    <td>Автор</td>
                                    <td>{{$meeting->author->fullName}}</td>
                                </tr>
                                <tr>
                                    <td>Клиент</td>
                                    <td>{{$meeting->client->fullName}}</td>
                                </tr>
                                <tr>
                                    <td>Ответственный</td>
                                    <td>{{$meeting->user->fullName}}</td>
                                </tr>
                                @role('analyst')
                                    <tr>
                                        <td>Согласовано</td>
                                        <td>{{$meeting->approval ? 'Да' : 'Нет'}}</td>
                                    </tr>
                                @endrole
                                @role('super_admin,manager')
                                    <tr>
                                        <td>Согласовано клиентом</td>
                                        <td>{{$meeting->client_approval ? 'Да' : 'Нет'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Согласовано ответственным</td>
                                        <td>{{$meeting->approval ? 'Да' : 'Нет'}}</td>
                                    </tr>
                                @endrole
                            </tbody>
                        </table>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a class="btn btn-info" href="{{ route('meeting.edit', $meeting->id) }}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Редактировать
                            </a>
                            <a href="{{route('meeting.index')}}" class="btn btn-info">Назад</a>
                            @role('super_admin,analyst')
                                @if (!$meeting->approval)
                                    <form action="{{ route('meeting.agreement', $meeting->id) }}" method="POST"
                                        style="display: inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-unlock">
                                            </i>
                                            Согласовать
                                        </button>
                                    </form>
                                @endif
                            @endrole
                            <a href="{{route('project.global.show', $meeting->project_id)}}" class="btn btn-danger">Перейти в проект</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
