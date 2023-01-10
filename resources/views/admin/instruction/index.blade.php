@extends('layouts.admin_layout')

@section('title', 'Список инструкций')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Инструкции по закрытию месяца</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-secondary btn-md float-right" href="{{ route('instruction.add') }}">
                        <i class="fas fa-cogs">
                        </i>
                        Создать инструкцию
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
                                    Описание
                                </th>
                                <th>
                                    Дата сдачи отчёта (Крайняя)
                                </th>
                                <th>
                                    Временной период
                                </th>
                                <th>
                                    Проект
                                </th>
                                <th style="width: 15%">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($instructions as $instruction)
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
                                    <td>
                                        {{ $instruction->project->name}}
                                    </td>

                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{ route('instruction.show', $instruction->id) }}">
                                            <i class="fas fa-search">
                                            </i>
                                            Просмотр
                                        </a>
                                        @role('super_admin')
                                        <form action="{{ route('instruction.destroy', $instruction->id) }}" method="POST"
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
