@extends('layouts.admin_layout')

@section('title', 'Все сроки проектов')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Сроки проектов</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-secondary btn-md float-right" href="{{ route('duration.add') }}">
                        <i class="fas fa-history">
                        </i>
                        Добавить срок проекта
                    </a>
                </div>
            </div><!-- /.row -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fa fa-check"></i>{{ session('success') }}</h5>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fa fa-window-close"></i>{{ session('error') }}</h5>
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
                                    Период
                                </th>
                                <th style="width: 30%">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($durations as $duration)
                                <tr>
                                    <td>
                                        {{ $duration->id }}
                                    </td>
                                    <td>
                                        {{ $duration->name }}
                                    </td>
                                    <td>
                                        {{ $duration->period }}
                                    </td>

                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{ route('duration.edit', $duration->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Редактировать
                                        </a>
                                        <form action="{{ route('duration.destroy', $duration->id) }}" method="POST"
                                            style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                                <i class="fas fa-trash">
                                                </i>
                                                Удалить
                                            </button>
                                        </form>
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
