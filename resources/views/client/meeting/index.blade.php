@extends('layouts.client_layout')

@section('title', 'Встречи')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Мои встречи</h1>
                </div>
            </div><!-- /.row -->
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
                                    Автор
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
                                        <a class="btn btn-info btn-sm" href="{{ route('client.meeting.show', $meeting->id) }}">
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
            </div>
        </div>
    </section>
@endsection
