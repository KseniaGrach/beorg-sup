@extends('layouts.admin_layout')

@section('title', 'Информация о закрытии месяца')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Инструкция №{{ $instruction['id'] }}</h1>
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
                            <h5>Информация о закрытии месяца</h5>
                        </div>
                        <table class="table table-striped mb-0">
                            <tbody>
                                <tr>
                                    <td>Описание</td>
                                    <td>{{$instruction->description}}</td>
                                </tr>
                                <tr>
                                    <td>Дата сдачи отчета (крайняя)</td>
                                    <td>{{$instruction->report_date->format('d.m.Y H:i')}}</td>
                                </tr>
                                <tr>
                                    <td>Временной период</td>
                                    <td>{{$instruction->interval}}</td>
                                </tr>
                                <tr>
                                    <td>SQL-запросы</td>
                                    <td><code>{{$instruction->queries}}</code></td>
                                </tr>
                                <tr>
                                    <td>Проект</td>
                                    <td>{{$instruction->project->name}}</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a class="btn btn-info" href="{{ route('instruction.edit', $instruction->id) }}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Редактировать
                            </a>
                            <a href="{{route('instruction.index')}}" class="btn btn-info">Назад</a>
                            <a href="{{route('project.global.show', $instruction->project_id)}}" class="btn btn-danger">Перейти в проект</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
