@extends('layouts.admin_layout')

@section('title', 'Конференции')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Все конференции</h1>
                </div>
                @role('super_admin,manager')
                    <div class="col-sm-6">
                        <a class="btn btn-secondary btn-md float-right" href="{{ route('meeting.add') }}">
                            <i class="fas fa-sitemap">
                            </i>
                            Создать конференцию
                        </a>
                    </div>
                @endrole
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
                            @foreach ($meetings as $meeting)
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
                                        @role('super_admin,manager')
                                            <form action="{{ route('meeting.destroy', $meeting->id) }}" method="POST"
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
