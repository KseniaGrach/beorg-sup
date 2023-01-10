@extends('layouts.admin_layout')

@section('title', 'Мои проекты')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Мои проекты</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-secondary btn-md float-right" href="{{ route('project.self.add') }}">
                        <i class="fas fa-sitemap">
                        </i>
                        Создать проект
                    </a>
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
                            @foreach ($projects as $project)
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
                                        {{ $project->cost}} тыс. руб.
                                    </td>
                                    <td>
                                        {{ $project->client->fullName}}
                                    </td>
                                    <td>
                                        {{ $project->activity ? 'Да' : 'Нет'}}
                                    </td>

                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{ route('project.self.show', $project->id) }}">
                                            <i class="fas fa-search">
                                            </i>
                                            Просмотр
                                        </a>
                                        @role('super_admin')
                                        <form action="{{ route('project.global.destroy', $project->id) }}" method="POST"
                                              style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                                <i class="fas fa-trash">
                                                </i>
                                                Удалить
                                            </button>
                                        </form>
                                        @endrole
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
