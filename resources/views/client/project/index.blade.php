@extends('layouts.client_layout')

@section('title', 'Мои проекты')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Мои проекты</h1>
                </div>
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
            <div class="card">
                <div class="card-body p-3">
                    <table class="table table-striped table-bordered data-table">
                        <thead>
                            <tr>
                                <th style="width: 5%">
                                    №
                                </th>
                                <th>
                                    Наименование
                                </th>
                                <th>
                                    Стоимость
                                </th>
                                <th>
                                    Активен
                                </th>
                                <th style="width: 15%">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>
                                        {{ $project->id }}
                                    </td>
                                    <td>
                                        {{ $project->name }}
                                    </td>
                                    <td>
                                        {{ $project->cost}} тыс. руб.
                                    </td>
                                    <td>
                                        {{ $project->activity ? 'Да' : 'Нет'}}
                                    </td>

                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{ route('client.project.show', $project->id) }}">
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
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
